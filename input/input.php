<?php
// Ambil data dari form
$kecamatan = isset($_POST['kecamatan']) ? trim($_POST['kecamatan']) : '';
$longitude = isset($_POST['longitude']) ? trim($_POST['longitude']) : '';
$latitude = isset($_POST['latitude']) ? trim($_POST['latitude']) : '';
$luas = isset($_POST['luas']) ? trim($_POST['luas']) : '';
$jumlah_penduduk = isset($_POST['jumlah_penduduk']) ? trim($_POST['jumlah_penduduk']) : '';

// Validasi server-side (PENTING!)
$errors = array();

if (empty($kecamatan)) {
    $errors[] = "Kecamatan tidak boleh kosong";
}

if (empty($longitude) || !is_numeric($longitude)) {
    $errors[] = "Longitude harus berupa angka";
}

if (empty($latitude) || !is_numeric($latitude)) {
    $errors[] = "Latitude harus berupa angka";
}

if (empty($luas) || !is_numeric($luas) || $luas <= 0) {
    $errors[] = "Luas harus berupa angka positif";
}

if (empty($jumlah_penduduk) || !is_numeric($jumlah_penduduk) || $jumlah_penduduk <= 0) {
    $errors[] = "Jumlah penduduk harus berupa angka positif";
}

// Jika ada error, tampilkan dan stop
if (!empty($errors)) {
    echo "<!DOCTYPE html>
    <html>
    <head>
        <title>Error Validasi</title>
        <style>
            body {
                font-family: Arial, sans-serif;
                background: linear-gradient(135deg, #EDAFB8 0%, #F7E1D7 30%, #DEDBD2 60%, #B0C4B1 100%);
                min-height: 100vh;
                display: flex;
                align-items: center;
                justify-content: center;
                padding: 20px;
            }
            .error-container {
                background: rgba(222, 219, 210, 0.9);
                padding: 40px;
                border-radius: 20px;
                border: 2px solid #EDAFB8;
                max-width: 500px;
                text-align: center;
            }
            h2 {
                color: #4A5759;
                margin-bottom: 20px;
            }
            ul {
                text-align: left;
                color: #4A5759;
                margin: 20px 0;
            }
            li {
                margin: 10px 0;
            }
            a {
                display: inline-block;
                margin-top: 20px;
                padding: 12px 30px;
                background: linear-gradient(135deg, #EDAFB8 0%, #F7E1D7 100%);
                color: #4A5759;
                text-decoration: none;
                border-radius: 10px;
                font-weight: 600;
            }
            a:hover {
                opacity: 0.8;
            }
        </style>
    </head>
    <body>
        <div class='error-container'>
            <h2>⚠️ Error Validasi</h2>
            <ul>";
    
    foreach ($errors as $error) {
        echo "<li>$error</li>";
    }
    
    echo "</ul>
            <a href='index.html'>← Kembali ke Form</a>
        </div>
    </body>
    </html>";
    exit;
}

// Koneksi Database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "Latihan_8";

// Membuat Koneksi
$conn = new mysqli($servername, $username, $password, $dbname);

// Cek Koneksi
if ($conn->connect_error) {
    die("Koneksi Gagal: " . $conn->connect_error);
}

// Gunakan prepared statement untuk keamanan (mencegah SQL injection)
$stmt = $conn->prepare("INSERT INTO data_kecamatan (kecamatan, longitude, latitude, luas, jumlah_penduduk) VALUES (?, ?, ?, ?, ?)");
$stmt->bind_param("sdddi", $kecamatan, $longitude, $latitude, $luas, $jumlah_penduduk);

if ($stmt->execute()) {
    // Sukses - redirect dengan pesan
    echo "<!DOCTYPE html>
    <html>
    <head>
        <title>Berhasil</title>
        <style>
            body {
                font-family: Arial, sans-serif;
                background: linear-gradient(135deg, #EDAFB8 0%, #F7E1D7 30%, #DEDBD2 60%, #B0C4B1 100%);
                min-height: 100vh;
                display: flex;
                align-items: center;
                justify-content: center;
                padding: 20px;
            }
            .success-container {
                background: rgba(222, 219, 210, 0.9);
                padding: 40px;
                border-radius: 20px;
                border: 2px solid #B0C4B1;
                max-width: 500px;
                text-align: center;
            }
            h2 {
                color: #4A5759;
                margin-bottom: 20px;
            }
            p {
                color: #4A5759;
                margin: 15px 0;
            }
            .button-group {
                margin-top: 30px;
                display: flex;
                gap: 15px;
                justify-content: center;
            }
            a {
                padding: 12px 25px;
                color: #4A5759;
                text-decoration: none;
                border-radius: 10px;
                font-weight: 600;
            }
            .btn-home {
                background: linear-gradient(135deg, #EDAFB8 0%, #F7E1D7 100%);
            }
            .btn-add {
                background: rgba(176, 196, 177, 0.7);
            }
            a:hover {
                opacity: 0.8;
            }
        </style>
    </head>
    <body>
        <div class='success-container'>
            <h2>✅ Data Berhasil Disimpan!</h2>
            <p>Data kecamatan <strong>$kecamatan</strong> telah ditambahkan ke database.</p>
            <div class='button-group'>
                <a href='../index.php' class='btn-home'>Lihat Data</a>
                <a href='index.html' class='btn-add'>Tambah Data Lagi</a>
            </div>
        </div>
    </body>
    </html>";
} else {
    echo "<!DOCTYPE html>
    <html>
    <head>
        <title>Error</title>
        <style>
            body {
                font-family: Arial, sans-serif;
                background: linear-gradient(135deg, #EDAFB8 0%, #F7E1D7 30%, #DEDBD2 60%, #B0C4B1 100%);
                min-height: 100vh;
                display: flex;
                align-items: center;
                justify-content: center;
                padding: 20px;
            }
            .error-container {
                background: rgba(222, 219, 210, 0.9);
                padding: 40px;
                border-radius: 20px;
                border: 2px solid #EDAFB8;
                max-width: 500px;
                text-align: center;
            }
            h2 {
                color: #4A5759;
                margin-bottom: 20px;
            }
            p {
                color: #4A5759;
            }
            a {
                display: inline-block;
                margin-top: 20px;
                padding: 12px 30px;
                background: linear-gradient(135deg, #EDAFB8 0%, #F7E1D7 100%);
                color: #4A5759;
                text-decoration: none;
                border-radius: 10px;
                font-weight: 600;
            }
        </style>
    </head>
    <body>
        <div class='error-container'>
            <h2>❌ Error</h2>
            <p>Terjadi kesalahan: " . $stmt->error . "</p>
            <a href='index.html'>Kembali ke Form</a>
        </div>
    </body>
    </html>";
}

$stmt->close();
$conn->close();
?>