<?php
session_start();
include "../config.php"; // Memasukkan koneksi
include "AES.php"; // Memasukkan file AES

if (isset($_POST['tes'])) { // Mengecek apakah tombol 'tes' ditekan
    $idfile = ($_POST['fileid']); // Mengambil ID file dari input POST
    $pwdfile = (substr(md5($_POST["pwdfile"]), 0, 16)); // Menghasilkan kunci enkripsi 16 karakter dari MD5 hash password
    $pwdnonmd = ($_POST["pwdfile"]); // Mengambil password file tanpa MD5 hash
    $query1 = "SELECT * FROM file WHERE id_file='$idfile'"; // Query untuk mengambil data file berdasarkan ID
    $sql1 = mysqli_query($koneksi, $query1); // Menjalankan query
    $data = mysqli_fetch_assoc($sql1); // Mengambil hasil query sebagai array asosiatif
    
    $url = $data["file_name_source"]; // Mendapatkan nama asli file
    $file_path = "terupload/$url"; // Menentukan path file yang diupload
    $file_name = $data["file_name_finish"]; // Mendapatkan nama file terenkripsi
    $size = $data["file_size"]; // Mendapatkan ukuran file
    
    $file_size = filesize($file_path); // Mengambil ukuran file dari sistem
    
    $sql2 = "UPDATE file SET kunci_tes ='$pwdfile' WHERE id_file = '$idfile'"; // Query untuk memperbarui kunci tes di database
    $query2 = mysqli_query($koneksi, $sql2) or die(mysqli_error($koneksi)); // Menjalankan query
    
    $sql3 = "UPDATE file SET password_tes ='$pwdnonmd' WHERE id_file = '$idfile'"; // Query untuk memperbarui password tes di database
    $query3 = mysqli_query($koneksi, $sql3) or die(mysqli_error($koneksi)); // Menjalankan query
    
    $mod = $file_size % 16; // Menghitung sisa pembagian ukuran file dengan 16
    
    $aes = new AES($pwdfile); // Membuat instance AES dengan kunci enkripsi
    $fopen1 = fopen($file_path, "rb"); // Membuka file yang diupload dalam mode baca biner
   
    $cache = "terupload/$file_name"; // Menentukan lokasi file hasil enkripsi
    $fopen2 = fopen($cache, "wb"); // Membuka file output dalam mode tulis biner
    
    if ($mod == 0) { // Memeriksa apakah ukuran file kelipatan 16
        $banyak = $file_size / 16; // Menghitung banyaknya blok 16-byte
    } else {
        $banyak = ($file_size - $mod) / 16; // Menghitung banyaknya blok 16-byte ditambah satu blok sisa
        $banyak = $banyak + 1;
    }
    
    ini_set('max_execution_time', -1); // Mengatur waktu eksekusi maksimum tak terbatas
    ini_set('memory_limit', -1); // Mengatur batas memori tak terbatas
    
    for ($bawah = 0; $bawah < $banyak; $bawah++) { // Melakukan enkripsi blok demi blok
        $filedata = fread($fopen1, 16); // Membaca 16 byte dari file sumber
        $chiper = $aes->encrypt($filedata); // Mengenkripsi data
        fwrite($fopen2, $chiper); // Menulis data terenkripsi ke file output
    }
    $_SESSION["download"] = $cache; // Menyimpan path file hasil enkripsi di sesi
    
    fclose($fopen1); // Menutup file sumber
    fclose($fopen2); // Menutup file output
    
    // Avalanche effect test
    $url2 = $data["file_name_finish"]; // Mendapatkan nama file terenkripsi
    
    $filepath1 = "file_encrypt/$url2"; // Menentukan lokasi file terenkripsi asli
    $filepath2 = "terupload/$url2"; // Menentukan lokasi file hasil enkripsi untuk tes
    
    $fopenplain = fopen($filepath1, "rb"); // Membuka file terenkripsi asli dalam mode baca biner
    $fopentes = fopen($filepath2, "rb"); // Membuka file hasil enkripsi untuk tes dalam mode baca biner
    $tesavalanche = 0; // Menginisialisasi variabel untuk jumlah efek avalanche
    for ($bawah = 0; $bawah < $banyak; $bawah++) { // Menghitung efek avalanche
        $plainava = fread($fopenplain, 16); // Membaca 16 byte dari file terenkripsi asli
        $tesava = fread($fopentes, 16); // Membaca 16 byte dari file hasil enkripsi untuk tes

        $same = 0; // Menginisialisasi variabel untuk jumlah bit yang berbeda
        for ($bwh = 0; $bwh < 16; $bwh++) { // Membandingkan setiap byte
            $bin_plain = str_pad(decbin(ord($plainava[$bwh])), 8, '0', STR_PAD_LEFT); // Mengkonversi byte ke biner
            $bin_tesava = str_pad(decbin(ord($tesava[$bwh])), 8, '0', STR_PAD_LEFT); // Mengkonversi byte ke biner
            
            for ($bit = 0; $bit < 8; $bit++) { // Membandingkan setiap bit
                if ($bin_plain[$bit] != $bin_tesava[$bit]) {
                    $same++; // Menambah jumlah bit yang berbeda
                }
            }
        }
        $tesavalanche += $same; // Menambah jumlah bit yang berbeda ke total
    }
    
    $total_bits = $banyak * 16 * 8; // Menghitung total bit yang dibandingkan
    $hasiltes = ($tesavalanche / $total_bits) * 100; // Menghitung persentase efek avalanche

    fclose($fopenplain); // Menutup file terenkripsi asli
    fclose($fopentes); // Menutup file hasil enkripsi untuk tes
    
    $kunci_plain1 = $data["kunci"]; // Mendapatkan kunci asli
    $kunci_plain2 = $data["password"]; // Mendapatkan kunci dengan MD5
    
    $a = $data["id_file"]; // Mendapatkan ID file
    
    $sql4 = "UPDATE file SET tes_ava ='$hasiltes' WHERE id_file = '$idfile'"; // Query untuk memperbarui hasil tes avalanche di database
    $query4 = mysqli_query($koneksi, $sql4) or die(mysqli_error($koneksi)); // Menjalankan query
    
    // Menampilkan pesan hasil tes avalanche
    echo("<script language='javascript'>
    window.location.href='tes_ava.php?id_file=$a';
    window.alert('Jumlah avalanche effect enkripsi file $url menggunakan kunci $kunci_plain1 diubah menjadi $kunci_plain2 menggunakan penyandian MD5 dengan $pwdnonmd diubah menjadi $pwdfile menggunakan penyandian MD5 adalah $hasiltes %');
    </script>");
}
?>