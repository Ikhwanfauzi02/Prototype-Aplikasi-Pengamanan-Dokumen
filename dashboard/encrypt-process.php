<?php
session_start(); // Memulai sesi PHP
include "../config.php"; // Memasukkan file konfigurasi untuk koneksi database
include "AES.php"; // Memasukkan file AES untuk enkripsi

$awal = microtime(true); // Mencatat waktu mulai eksekusi

if (isset($_POST['encrypt_now'])) { // Mengecek apakah tombol 'encrypt_now' ditekan
    $user = $_SESSION['username']; // Mengambil username dari sesi
    $kunci = $_POST["pwdfile"]; // Mengambil password file dari input
    $key = substr(md5($_POST["pwdfile"]), 0, 16); // Menghasilkan kunci enkripsi 16 karakter dari MD5 hash password
    $deskripsi = $_POST['desc']; // Mengambil deskripsi file dari input

    $file_tmpname = $_FILES['file']['tmp_name']; // Mengambil nama sementara file yang diupload
    $file = rand(1000, 100000) . "-" . $_FILES['file']['name']; // Menghasilkan nama acak untuk file yang diupload
    $new_file_name = strtolower($file); // Mengubah nama file menjadi huruf kecil
    $final_file = str_replace(' ', '-', $new_file_name); // Mengganti spasi dengan tanda '-'

    $filename = rand(1000, 100000) . "-" . pathinfo($_FILES['file']['name'], PATHINFO_FILENAME); // Menghasilkan nama acak untuk file tanpa ekstensi
    $new_filename = strtolower($filename); // Mengubah nama file menjadi huruf kecil
    $finalfile = str_replace(' ', '-', $new_filename); // Mengganti spasi dengan tanda '-'

    $size = filesize($file_tmpname); // Mengambil ukuran file
    $size2 = $size / 1024; // Mengonversi ukuran file ke kilobyte
    $info = pathinfo($final_file); // Mengambil informasi path dari file
    $file_source = fopen($file_tmpname, 'rb'); // Membuka file yang diupload dalam mode baca biner

    $dirUpload = "terupload/"; // Menentukan direktori upload
    $ext = $info["extension"]; // Mengambil ekstensi file

    // Validasi ekstensi file
    $valid_extensions = ['doc', 'docx', 'txt', 'pdf', 'xls', 'xlsx', 'ppt', 'pptx'];
    if (!in_array($ext, $valid_extensions)) {
        // Menampilkan pesan kesalahan jika ekstensi file tidak valid
        echo("<script language='javascript'>
        window.location.href='encrypt.php';
        window.alert('Maaf, file yang bisa dienkrip hanya word, excel, text, ppt ataupun pdf.');
        </script>");
        exit(); 
    }

    // Validasi ukuran file
    if ($size2 > 5000) { // Memeriksa apakah ukuran file lebih dari 5MB
        // Menampilkan pesan kesalahan jika ukuran file terlalu besar
        echo("<script language='javascript'>
        window.location.href='home.php?encrypt';
        window.alert('Maaf, file tidak bisa lebih besar dari 5MB.');
        </script>");
        exit(); 
    }

    // Menyimpan informasi file ke database
    $sql1 = "INSERT INTO file VALUES ('', '$user', '$final_file', '$finalfile.rda', '', '$size2', '$key', now(), '1', '', '', '$deskripsi', '$kunci', '', '', '', '')";
    $query1 = mysqli_query($koneksi, $sql1) or die(mysqli_error($koneksi));

    // Mengambil file yang baru saja diinput ke database
    $sql2 = "SELECT * FROM file WHERE file_url = ''";
    $query2 = mysqli_query($koneksi, $sql2) or die(mysqli_error($koneksi));

    $url = $finalfile . ".rda"; // Menghasilkan URL untuk file terenkripsi
    $file_url = "file_encrypt/$url"; // Menentukan lokasi file terenkripsi

    // Memperbarui URL file di database
    $sql3 = "UPDATE file SET file_url ='$file_url' WHERE file_url=''";
    $query3 = mysqli_query($koneksi, $sql3) or die(mysqli_error($koneksi));

    $file_output = fopen($file_url, 'wb'); // Membuka file output dalam mode tulis biner

    $mod = $size % 16; // Menghitung sisa pembagian ukuran file dengan 16
    $banyak = $mod == 0 ? $size / 16 : ($size - $mod) / 16 + 1; // Menghitung banyaknya blok 16-byte

    if (is_uploaded_file($file_tmpname)) { // Memeriksa apakah file diupload dengan benar
        ini_set('max_execution_time', -1); // Mengatur waktu eksekusi maksimum tak terbatas
        ini_set('memory_limit', -1); // Mengatur batas memori tak terbatas
        $aes = new AES($key); // Membuat instance AES dengan kunci enkripsi

        for ($bawah = 0; $bawah < $banyak; $bawah++) { // Melakukan enkripsi blok demi blok
            $data = fread($file_source, 16); // Membaca 16 byte dari file sumber
            $cipher = $aes->encrypt($data); // Mengenkripsi data
            fwrite($file_output, $cipher); // Menulis data terenkripsi ke file output
        }
        fclose($file_source); // Menutup file sumber
        fclose($file_output); // Menutup file output

        // Menampilkan pesan sukses
        echo("<script language='javascript'>
        window.location.href='encrypt.php';
        window.alert('Enkripsi Berhasil..');
        </script>");
    } else {
        // Menampilkan pesan kesalahan jika terjadi masalah dengan upload
        echo("<script language='javascript'>
        window.location.href='encrypt.php';
        window.alert('Encrypt file mengalami masalah..');
        </script>");
    }

    $akhir = microtime(true); // Mencatat waktu akhir eksekusi
    $lama = $akhir - $awal; // Menghitung lama waktu eksekusi
    // Memperbarui waktu enkripsi di database
    $sql4 = "UPDATE file SET waktu ='$lama' WHERE waktu=''";
    $query4 = mysqli_query($koneksi, $sql4) or die(mysqli_error($koneksi));

    // Memindahkan file yang diupload ke direktori tujuan
    $terupload = move_uploaded_file($file_tmpname, $dirUpload . $final_file);
}
?>