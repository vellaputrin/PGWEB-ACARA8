<?php
$id = $_POST['id'];
$kecamatan = $_POST['kecamatan'];
$longitude = $_POST['longitude'];
$latitude = $_POST['latitude'];
$luas = $_POST['luas'];
$jumlah_penduduk = $_POST['jumlah_penduduk'];

// Koneksi ke database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "Latihan_8";

// Membuat koneksi
$conn = new mysqli($servername, $username, $password, $dbname);

// Cek koneksi
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Query UPDATE
$sql = "UPDATE data_kecamatan SET 
        kecamatan='$kecamatan', 
        longitude='$longitude', 
        latitude='$latitude', 
        luas='$luas', 
        jumlah_penduduk='$jumlah_penduduk' 
        WHERE id=$id";

if ($conn->query($sql) === TRUE) {
    echo "✅ Record edited successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();

// Redirect kembali ke halaman utama
header("Location: ../index.php");
exit();
?>