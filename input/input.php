<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "tabel_penduduk";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

$kecamatan = $_POST['kecamatan'];
$luas = $_POST['luas'];
$jumlah_penduduk = $_POST['jumlah_penduduk'];
$longitude = $_POST['longitude'];
$latitude = $_POST['latitude'];

// Menentukan ID baru berdasarkan ID terbesar
$result = $conn->query(
    "SELECT COALESCE(MAX(id), 0) + 1 AS id_baru FROM `tabel penduduk`"
);

$row = $result->fetch_assoc();
$id_baru = $row['id_baru'];

// Menambahkan data baru dengan ID yang berbeda
$sql = "INSERT INTO `tabel penduduk`
        (id, kecamatan, luas, jumlah_penduduk, longitude, latitude)
        VALUES (?, ?, ?, ?, ?, ?)";

$stmt = $conn->prepare($sql);

$stmt->bind_param(
    "isiddd",
    $id_baru,
    $kecamatan,
    $luas,
    $jumlah_penduduk,
    $longitude,
    $latitude
);

if ($stmt->execute()) {
    $stmt->close();
    $conn->close();

    header("Location: ../index.php");
    exit();
} else {
    die("Gagal menambahkan data: " . $stmt->error);
}
?>