<?php
// Koneksi Database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "latihan_8"; // PASTIKAN NAMA DATABASE SAMA PERSIS (case-sensitive di Linux)

// Membuat Koneksi
$conn = new mysqli($servername, $username, $password, $dbname);

// Cek Koneksi
if ($conn->connect_error) {
    die("Koneksi Gagal: " . $conn->connect_error);
}

// Cek apakah ID ada di parameter URL
if (isset($_GET['id']) && !empty($_GET['id'])) {
    $id = intval($_GET['id']); // Konversi ke integer untuk keamanan
    
    // Query DELETE
    $sql = "DELETE FROM data_kecamatan WHERE id = $id";
    
    if ($conn->query($sql) === TRUE) {
        // Cek apakah ada baris yang terhapus
        if ($conn->affected_rows > 0) {
            // Berhasil menghapus data
            $conn->close();
            header("Location: index.php?message=success&deleted=true");
            exit();
        } else {
            // ID tidak ditemukan
            $conn->close();
            header("Location: index.php?message=error&reason=not_found");
            exit();
        }
    } else {
        // Query gagal dieksekusi
        $conn->close();
        header("Location: index.php?message=error&reason=query_failed");
        exit();
    }
} else {
    // Tidak ada ID
    $conn->close();
    header("Location: index.php?message=error&reason=no_id");
    exit();
}
?>