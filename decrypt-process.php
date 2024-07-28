<?php
session_start(); // Memulai sesi PHP
include "../config.php";   // Memasukkan file konfigurasi untuk koneksi database
include "AES.php"; // Memasukkan file AES untuk dekripsi

$awal = microtime(true); // Mencatat waktu mulai eksekusi
$idfile = ($_POST['fileid']); // Mengambil ID file dari input POST
$pwdfile = (substr(md5($_POST["pwdfile"]), 0, 16)); // Menghasilkan kunci dekripsi 16 karakter dari MD5 hash password
$query = "SELECT password FROM file WHERE id_file='$idfile' AND password='$pwdfile'"; // Query untuk memeriksa password
$sql = mysqli_query($koneksi, $query); // Menjalankan query

if (mysqli_num_rows($sql) > 0) { // Memeriksa apakah password sesuai
    $query1 = "SELECT * FROM file WHERE id_file='$idfile'"; // Query untuk mengambil data file
    $sql1 = mysqli_query($koneksi, $query1); // Menjalankan query
    $data = mysqli_fetch_assoc($sql1); // Mengambil hasil query sebagai array asosiatif

    $file_path = $data["file_url"]; // Mendapatkan path file
    $key = $data["password"]; // Mendapatkan password file
    $file_name = $data["file_name_source"]; // Mendapatkan nama asli file
    $size = $data["file_size"]; // Mendapatkan ukuran file

    $file_size = filesize($file_path); // Mengambil ukuran file dari sistem

    $query2 = "UPDATE file SET status='2' WHERE id_file='$idfile'"; // Query untuk memperbarui status file
    $sql2 = mysqli_query($koneksi, $query2); // Menjalankan query

    $mod = $file_size % 16; // Menghitung sisa pembagian ukuran file dengan 16

    $aes = new AES($key); // Membuat instance AES dengan kunci dekripsi
    $fopen1 = fopen($file_path, "rb"); // Membuka file terenkripsi dalam mode baca biner
    $plain = ""; // Menginisialisasi variabel untuk teks asli
    $cache = "file_decrypt/$file_name"; // Menentukan lokasi file hasil dekripsi
    $fopen2 = fopen($cache, "wb"); // Membuka file output dalam mode tulis biner

    if ($mod == 0) { // Memeriksa apakah ukuran file kelipatan 16
        $banyak = $file_size / 16; // Menghitung banyaknya blok 16-byte
    } else {
        $banyak = ($file_size - $mod) / 16; // Menghitung banyaknya blok 16-byte ditambah satu blok sisa
        $banyak = $banyak + 1;
    }

    ini_set('max_execution_time', -1); // Mengatur waktu eksekusi maksimum tak terbatas
    ini_set('memory_limit', -1); // Mengatur batas memori tak terbatas
    for ($bawah = 0; $bawah < $banyak; $bawah++) { // Melakukan dekripsi blok demi blok
        $filedata = fread($fopen1, 16); // Membaca 16 byte dari file sumber
        $plain = $aes->decrypt($filedata); // Mendekripsi data
        fwrite($fopen2, $plain); // Menulis data terdekripsi ke file output
    }
    $_SESSION["download"] = $cache; // Menyimpan path file hasil dekripsi di sesi

    // Menampilkan pesan sukses dan membuka halaman download
    echo("<script language='javascript'>
        window.open('download.php', '_blank');
        window.location.href='decrypt.php';
        window.alert('Berhasil mendekripsi file.');
        </script>");
} else {
    // Menampilkan pesan kesalahan jika password tidak sesuai
    echo("<script language='javascript'>
        window.location.href='decrypt-file.php?id_file=$idfile';
        window.alert('Maaf, Password tidak sesuai.');
        </script>");
}

$akhir = microtime(true); // Mencatat waktu akhir eksekusi
$lama = $akhir - $awal; // Menghitung lama waktu eksekusi
$sql3 = "UPDATE file SET waktu_2 ='$lama' WHERE id_file='$idfile'"; // Query untuk memperbarui waktu dekripsi di database
$query3 = mysqli_query($koneksi, $sql3) or die(mysql_error()); // Menjalankan query dan memeriksa kesalahan
?>