<?php
include "../config.php";   // Memasukkan koneksi
include "AES.php"; // Memasukkan file AES

if (isset($_POST['tes_entropy'])) { // Mengecek apakah tombol 'tes_entropy' ditekan

    $idfile = $_POST['fileid']; // Mengambil ID file dari input POST
    $query1 = "SELECT * FROM file WHERE id_file='$idfile'"; // Query untuk mengambil data file berdasarkan ID
    $sql1 = mysqli_query($koneksi, $query1); // Menjalankan query
    $data = mysqli_fetch_assoc($sql1); // Mengambil hasil query sebagai array asosiatif

    $url = $data["file_name_finish"]; // Mendapatkan nama file terenkripsi
    $file_path = "file_encrypt/$url"; // Menentukan path file terenkripsi

    // Cek apakah file ada
    if (!file_exists($file_path)) {
        die("File tidak ditemukan: $file_path"); // Menghentikan eksekusi jika file tidak ditemukan
    }

    // Membuka file
    $handle = fopen($file_path, "rb"); // Membuka file dalam mode baca biner
    if (!$handle) {
        die("Gagal membuka file: $file_path"); // Menghentikan eksekusi jika gagal membuka file
    }

    // Inisialisasi array karakter
    $chars = array(); // Array untuk menyimpan frekuensi karakter
    $charcount = 0; // Menghitung jumlah karakter

    // Membaca file dan menghitung frekuensi karakter
    while ($thischar = fread($handle, 1)) { // Membaca file satu karakter sekaligus
        $ascii_val = ord($thischar); // Mendapatkan nilai ASCII dari karakter
        if (!isset($chars[$ascii_val])) {
            $chars[$ascii_val] = 0; // Inisialisasi frekuensi karakter jika belum ada
        }
        $chars[$ascii_val]++; // Menambah frekuensi karakter
        $charcount++; // Menambah jumlah karakter
    }

    fclose($handle); // Menutup file

    // Menghitung entropy
    $entropy = 0.0; // Inisialisasi nilai entropy
    foreach ($chars as $val) { // Iterasi melalui setiap karakter dan frekuensinya
        $p = $val / $charcount; // Menghitung probabilitas karakter
        $entropy -= $p * log($p, 2); // Menambah nilai entropy
    }

    // Update database dengan nilai entropy
    $sql2 = "UPDATE file SET tes_en ='$entropy' WHERE id_file = '$idfile'"; // Query untuk memperbarui nilai entropy di database
    $query2 = mysqli_query($koneksi, $sql2); // Menjalankan query
    if (!$query2) {
        die("Gagal mengupdate database: " . mysqli_error($koneksi)); // Menghentikan eksekusi jika gagal mengupdate database
    }

    $a = $data["id_file"]; // Mengambil ID file
    // Menampilkan pesan hasil tes entropy dan mengarahkan ke halaman hasil
    echo("<script language='javascript'>
    window.location.href='entropyhalaman.php?id_file=$a';
    window.alert('Persentase tes entropy enkripsi file $url adalah $entropy');
    </script>");
}
?>