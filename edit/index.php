<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Edit</title>
</head>
<body>
    <h2>Form Edit Data Kecamatan</h2>
    <?php
    // Koneksi Database
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "Latihan_8";

    // Membuat Koneksi
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Cek koneksi
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $id = $_GET['id'];
    $sql = "SELECT * FROM data_kecamatan WHERE id = $id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo "<form action='edit.php' onsubmit='return validateForm(event)' method='post'>";
        while($row = $result->fetch_assoc()) {
            echo "<input type='hidden' name='id' value='".$row['id']."'><br>";
            
            echo "<label for='kecamatan'>Kecamatan:</label><br>";
            echo "<input type='text' id='kec' name='kecamatan' value='".$row['kecamatan']."' required><br>";
            
            echo "<label for='longitude'>Longitude:</label><br>";
            echo "<input type='text' id='long' name='longitude' value='".$row['longitude']."' required><br>";
            
            echo "<label for='latitude'>Latitude:</label><br>";
            echo "<input type='text' id='lat' name='latitude' value='".$row['latitude']."' required><br>";
            
            echo "<label for='luas'>Luas:</label><br>";
            echo "<input type='text' id='luas' name='luas' value='".$row['luas']."' required><br>";
            
            echo "<label for='jumlah_penduduk'>Jumlah Penduduk:</label><br>";
            echo "<input type='text' id='jml_pddk' name='jumlah_penduduk' value='".$row['jumlah_penduduk']."' required><br><br>";
        }
        echo "<input type='submit' value='Submit'>";
        echo "</form>";
    } else {
        echo "Data tidak ditemukan";
    }
    
    $conn->close();
    ?>

    <p id="informasi" style="color: red;"></p>

    <script>
        function validateForm(event) {
            let luas = document.getElementById("luas").value.trim();
            let text = "";

            // Validasi angka positif
            if (isNaN(luas) || luas <= 0) {
                text = "⚠️ Data luas harus berupa angka positif!";
                document.getElementById("informasi").innerText = text;
                event.preventDefault(); // menghentikan pengiriman form
                return false;
            }

            // Jika validasi lolos
            document.getElementById("informasi").innerText = "";
            return true;
        }
    </script>
</body>
</html>