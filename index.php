<?php
session_start();
if (isset($_SESSION['username']) && $_SESSION['status'] == 'login') {
    header("location: dashboard/index.php");
    exit();
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Aplikasi Enkripsi dan Dekripsi AES-128</title>
    <link rel="shortcut icon" href="../assets/images/lockandkey2.png">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="assets/css/main.css">
</head>
<body>
    <section class="material-half-bg">
        <div class="cover" style="background-color:#2F4F4F;"></div>
    </section>
    <section class="login-content info">
        <div class="logo" style="font-family:Times new roman">
            <h1>KRIPTOGRAFI FILE AES 128</h1>
        </div>
        <div class="login-box">
            <form class="login-form" action="auth.php" method="post">
                <h3 class="login-head"><i class="fa fa-lg fa-fw fa-user"></i>Login</h3>
                <div class="form-group">
                    <label class="control-label">Username</label>
                    <input class="form-control" type="text" name="username" placeholder="Username" autofocus autocomplete="off" required>
                </div>
                <div class="form-group">
                    <label class="control-label">Password</label>
                    <input class="form-control" type="password" name="password" placeholder="Password" required>
                </div>
                <div class="form-group btn-container">
                    <button class="btn btn-primary btn-block" style="background-color:#2F4F4F" name="login">Masuk <i class="fa fa-sign-in fa-lg"></i></button><br>
                </div>
            </form>
        </div>
    </section>
    <script src="assets/js/jquery-2.1.4.min.js"></script>
    <script src="assets/js/essential-plugins.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/plugins/pace.min.js"></script>
    <script src="assets/js/main.js"></script>

    <?php
    if (isset($_SESSION['pesan'])) {
        echo '<script>alert("'.$_SESSION['pesan'].'");</script>';
        unset($_SESSION['pesan']);
    }
    ?>
</body>
</html>
