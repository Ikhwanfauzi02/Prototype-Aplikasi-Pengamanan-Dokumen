<?php
session_start();
include "../config.php"; // Memasukkan koneksi
include "AES.php"; // Memasukkan file AES

if (isset($_POST['tes'])) {
    $idfile = ($_POST['fileid']);
    $pwdfile = (substr(md5($_POST["pwdfile"]), 0, 16));
    $pwdnonmd = ($_POST["pwdfile"]);
    $query1 = "SELECT * FROM file WHERE id_file='$idfile'";
    $sql1 = mysqli_query($koneksi, $query1);
    $data = mysqli_fetch_assoc($sql1);
    
    $url = $data["file_name_source"];
    $file_path = "terupload/$url";
    $file_name = $data["file_name_finish"];
    $size = $data["file_size"];
    
    if (!file_exists($file_path)) {
        die("File tidak ditemukan: $file_path");
    }

    $file_size = filesize($file_path);
    
    $sql2 = "UPDATE file SET kunci_tes ='$pwdfile' WHERE id_file = '$idfile'";
    $query2 = mysqli_query($koneksi, $sql2) or die(mysqli_error($koneksi));
    
    $sql3 = "UPDATE file SET password_tes ='$pwdnonmd' WHERE id_file = '$idfile'";
    $query3 = mysqli_query($koneksi, $sql3) or die(mysqli_error($koneksi));
    
    $mod = $file_size % 16;
    
    $aes = new AES($pwdfile);
    $fopen1 = fopen($file_path, "rb");
    if (!$fopen1) {
        die("Gagal membuka file untuk membaca: $file_path");
    }
   
    $cache = "terupload/$file_name";
    $fopen2 = fopen($cache, "wb");
    if (!$fopen2) {
        fclose($fopen1);
        die("Gagal membuka file untuk menulis: $cache");
    }
    
    if ($mod == 0) {
        $banyak = $file_size / 16;
    } else {
        $banyak = ($file_size - $mod) / 16;
        $banyak = $banyak + 1;
    }
    
    ini_set('max_execution_time', -1);
    ini_set('memory_limit', -1);
    
    for ($bawah = 0; $bawah < $banyak; $bawah++) {
        $filedata = fread($fopen1, 16);
        $chiper = $aes->encrypt($filedata);
        fwrite($fopen2, $chiper);
    }
    $_SESSION["download"] = $cache;
    
    fclose($fopen1);
    fclose($fopen2);
    
    // Avalanche effect test
    $url2 = $data["file_name_finish"];
    
    $filepath1 = "file_encrypt/$url2";
    $filepath2 = "terupload/$url2";
    
    if (!file_exists($filepath1) || !file_exists($filepath2)) {
        die("File tidak ditemukan untuk pengujian avalanche effect: $filepath1 atau $filepath2");
    }

    $fopenplain = fopen($filepath1, "rb");
    if (!$fopenplain) {
        die("Gagal membuka file untuk membaca: $filepath1");
    }
    
    $fopentes = fopen($filepath2, "rb");
    if (!$fopentes) {
        fclose($fopenplain);
        die("Gagal membuka file untuk membaca: $filepath2");
    }
    
    $tesavalanche = 0;
    for ($bawah = 0; $bawah < $banyak; $bawah++) {
        $plainava = fread($fopenplain, 16);
        $tesava = fread($fopentes, 16);

        $same = 0;
        for ($bwh = 0; $bwh < 16; $bwh++) {
            $bin_plain = str_pad(decbin(ord($plainava[$bwh])), 8, '0', STR_PAD_LEFT);
            $bin_tesava = str_pad(decbin(ord($tesava[$bwh])), 8, '0', STR_PAD_LEFT);
            
            for ($bit = 0; $bit < 8; $bit++) {
                if ($bin_plain[$bit] != $bin_tesava[$bit]) {
                    $same++;
                }
            }
        }
        $tesavalanche += $same;
    }
    
    $total_bits = $banyak * 16 * 8;
    $hasiltes = ($tesavalanche / $total_bits) * 100;

    fclose($fopenplain);
    fclose($fopentes);
    
    $kunci_plain1 = $data["kunci"]; // Kunci awal plain
    $kunci_plain2 = $data["password"]; // Kunci awal dengan MD5
    
    $a = $data["id_file"];
    
    $sql4 = "UPDATE file SET tes_ava ='$hasiltes' WHERE id_file = '$idfile'";
    $query4 = mysqli_query($koneksi, $sql4) or die(mysqli_error($koneksi));
    
    echo("<script language='javascript'>
    window.location.href='tes_ava.php?id_file=$a';
    window.alert('Jumlah avalanche effect enkripsi file $url menggunakan kunci $kunci_plain1 diubah menjadi $kunci_plain2 menggunakan penyandian MD5 dengan $pwdnonmd diubah menjadi $pwdfile menggunakan penyandian MD5 adalah $hasiltes %');
    </script>");
}
?>
