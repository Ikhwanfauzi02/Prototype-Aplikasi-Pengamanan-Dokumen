<?php
session_start();
include 'config.php';

if (isset($_POST['login'])) {
    if (empty($_POST['username']) || empty($_POST['password'])) {
        $_SESSION['pesan'] = "Username or Password Tidak Valid!";
        header("location: index.php");
    } else {
        $username = $_POST['username'];
        $password = md5($_POST['password']);

        $query = mysqli_query($koneksi, "SELECT * FROM users WHERE username='$username' AND password='$password'");
        $cek = mysqli_num_rows($query);

        if ($cek > 0) {
            $_SESSION['username'] = $username;
            $_SESSION['status'] = 'login';
            header("location: dashboard/index.php");
        } else {
            $_SESSION['pesan'] = "Akses masuk gagal! username dan password salah!";
            header("location: index.php");
        }
    }
}
?>
