<?php
// Memulai sesi PHP
session_start();

// Menyertakan file konfigurasi untuk koneksi database atau pengaturan lainnya
include('../config.php');

// Mengecek apakah sesi username kosong, jika kosong pengguna akan diarahkan ke halaman login
if(empty($_SESSION['username'])){
  header("location:../index.php");
  exit;
}

// Mengecek apakah parameter 'file' ada dalam URL
if (isset($_GET['file'])) {
  // Mendapatkan nama file dari URL dan mengamankannya dengan fungsi basename
  $file = basename($_GET['file']);
  // Menentukan path lengkap file yang akan didownload
  $filepath = 'F:/xampp/htdocs/kriptografi-aes/dashboard/file_decrypt/' . $file;

  // Mengecek apakah file ada di path yang ditentukan
  if (file_exists($filepath)) {
    // Mengatur header HTTP untuk memulai proses download
    header('Content-Type: application/octet-stream'); // Menentukan jenis file yang akan didownload
    header('Content-Description: File Transfer'); // Memberikan deskripsi singkat mengenai transfer file
    header('Content-Disposition: attachment; filename=' . basename($filepath)); // Menentukan nama file yang didownload
    header('Expires: 0'); // Mengatur agar file tidak di-cache
    header('Cache-Control: must-revalidate'); // Mengatur agar browser melakukan validasi cache sebelum menggunakan file
    header('Pragma: public'); // Mengatur agar file dapat diakses publik
    header('Content-Length: ' . filesize($filepath)); // Mengatur panjang konten file
    flush(); // Membersihkan output buffer sistem
    readfile($filepath); // Membaca dan mengirimkan konten file ke output buffer
    exit; // Menghentikan eksekusi skrip setelah file didownload
  } else {
    // Menampilkan pesan jika file tidak ditemukan
    echo "File not found.";
  }
} else {
  // Menampilkan pesan jika parameter file tidak ada di URL
  echo "No file specified.";
}
?>
