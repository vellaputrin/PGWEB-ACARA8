<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
    //Koneksi Databasse
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "Latihan_8";

    //Membuat Koneksi
    $conn = new mysqli($servername, $username, $password, $dbname);

    //Cek Koneksi
    if ($conn->connect_error) {
        die("Koneksi Gagal: " . $conn->connect_error);
    }

    $sql = "SELECT * FROM data_kecamatan";
    $result = $conn->query($sql);
        echo "<a href='input/index.html'>Input</a>";

    if ($result->num_rows > 0) {
        echo "<table border='1px'><tr>
                <th>Kecamatan</th>
                <th>Luas</th>
                <th>Jumlah Penduduk</th>";

        // output data of each row
        while($row = $result->fetch_assoc()) {
            echo "<tr><td>" . $row["kecamatan"] . "</td><td>"
                . $row["luas"] . "</td><td align='right'>"
                . $row["jumlah_penduduk"] . "</td></tr>";
        }
        echo "</table>";
    } else {
        echo "0 results";
    }

    $conn->close();
    ?>
</body>
</html>