<?php
// Memulai sesi PHP
session_start();

// Menyertakan file konfigurasi untuk koneksi database atau pengaturan lainnya
include('../config.php');

// Mengecek apakah sesi username kosong, jika kosong pengguna akan diarahkan ke halaman login
if (empty($_SESSION['username'])) {
    header("location:../index.php");
    exit();
}

// Mengecek apakah parameter 'file' ada dalam URL, jika tidak ada menampilkan pesan dan menghentikan eksekusi skrip
if (!isset($_GET['file'])) {
    echo "No file specified.";
    exit();
}

// Mengambil nama file dari URL dan mengamankannya dengan fungsi urldecode
$file = urldecode($_GET['file']);
// Menentukan path lengkap file yang akan didownload
$filePath = 'F:/xampp/htdocs/kriptografi-aes/dashboard/file_encrypt/' . $file;

// Mengecek apakah file ada di path yang ditentukan, jika tidak ada menampilkan pesan dan menghentikan eksekusi skrip
if (!file_exists($filePath)) {
    echo "File not found.";
    exit();
}

// Mengatur header HTTP untuk memulai proses download
header('Content-Description: File Transfer'); // Memberikan deskripsi singkat mengenai transfer file
header('Content-Type: application/octet-stream'); // Menentukan jenis file yang akan didownload
header('Content-Disposition: attachment; filename="' . basename($filePath) . '"'); // Menentukan nama file yang didownload
header('Expires: 0'); // Mengatur agar file tidak di-cache
header('Cache-Control: must-revalidate'); // Mengatur agar browser melakukan validasi cache sebelum menggunakan file
header('Pragma: public'); // Mengatur agar file dapat diakses publik
header('Content-Length: ' . filesize($filePath)); // Mengatur panjang konten file
flush(); // Membersihkan output buffer sistem
readfile($filePath); // Membaca dan mengirimkan konten file ke output buffer
exit(); // Menghentikan eksekusi skrip setelah file didownload
?>
