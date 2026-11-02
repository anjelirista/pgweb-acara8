Tabel Penduduk
<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "tabel_penduduk";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM `tabel penduduk`";
$result = $conn->query($sql);

echo "<a href='input/index.html'>Input</a>";
if ($result->num_rows > 0) {

    echo "<table border='1'>";
    echo "<tr>
            <th>Id</th>
            <th>Kecamatan</th>
            <th>Luas</th>
            <th>Jumlah Penduduk</th>
            <th>Longitude</th>
            <th>Latitude</th>
          </tr>";

    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row["id"] . "</td>";
        echo "<td>" . $row["kecamatan"] . "</td>";
        echo "<td>" . $row["luas"] . "</td>";
        echo "<td align='right'>" . $row["jumlah_penduduk"] . "</td>";
        echo "<td>" . $row["longitude"] . "</td>";
        echo "<td>" . $row["latitude"] . "</td>";
        echo "</tr>";
    }

    echo "</table>";

} else {
    echo "0 results";
}

$conn->close();
?>