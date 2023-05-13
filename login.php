<?php
session_start();
require "koneksi.php";

if (isset($_POST['username']) && isset($_POST['password'])) {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    $query_admin = "SELECT * FROM petugas WHERE username='$username' AND password='$password' AND role='admin'";
    $query_petugas = "SELECT * FROM petugas WHERE username='$username' AND password='$password' AND role='petugas'";

    $query_masyarakat = "SELECT * FROM masyarakat WHERE username='$username' AND password='$password' AND role='masyarakat'";

    $result_admin = mysqli_query($conn, $query_admin);
    $result_petugas = mysqli_query($conn, $query_petugas);

    $result_masyarakat = mysqli_query($conn, $query_masyarakat);

    if (mysqli_num_rows($result_admin) == 1) {
        $_SESSION['role'] = 'admin';
        $_SESSION['username'] = $username;
        $row = mysqli_fetch_assoc($result_admin);
        $_SESSION['nama_petugas'] = $row['nama_petugas'];
        $_SESSION['telp'] = $row['telp'];

        $_SESSION['id_petugas'] = $row['id_petugas'];

        header("location: admin/index.php");
	}else if (mysqli_num_rows($result_petugas) == 1) {
			$_SESSION['role'] = 'petugas';
			$_SESSION['username'] = $username;
			$row = mysqli_fetch_assoc($result_petugas);
			$_SESSION['id_petugas'] = $row['id_petugas'];
			$_SESSION['nama_petugas'] = $row['nama_petugas'];
        $_SESSION['telp'] = $row['telp'];

			header("location: petugas/index.php");
    } else if (mysqli_num_rows($result_masyarakat) == 1) {
        $_SESSION['role'] = 'masyarakat';
        $_SESSION['username'] = $username;
        $row = mysqli_fetch_assoc($result_masyarakat);
        $_SESSION['nama'] = $row['nama'];
        $_SESSION['nik'] = $row['nik'];
        $_SESSION['telp'] = $row['telp'];


        header("location: masyarakat/index.php");
    } else {
        echo "<script>
            alert('Username dan password salah.');
        </script>";
    }
}
mysqli_close($conn);
?>









<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>

    <!-- Font Icon -->
    <link rel="stylesheet" href="login/fonts/material-icon/css/material-design-iconic-font.min.css">

    <!-- Main css -->
    <link rel="stylesheet" href="login/css/style.css">
</head>
<body>

    <div class="main">

        <!-- Sign up form -->
      

        <!-- Sing in  Form -->
        <section class="sign-in">
            <div class="container">
                <div class="signin-content">
                    <div class="signin-image">
                        <figure><img src="login/images/5.jpg" alt="sing up image"></figure>
                        <a href="register.php" class="signup-image-link">Create an account</a>
                    </div>

                    <div class="signin-form">
                        <h2 class="form-title">Login</h2>
                        <form method="POST" class="register-form" id="login-form">
                            <div class="form-group">
                                <label for="your_name"><i class="zmdi zmdi-account material-icons-name"></i></label>
                                <input type="text" name="username" id="your_name" placeholder="Your Name"/>
                            </div>
                            <div class="form-group">
                                <label for="your_pass"><i class="zmdi zmdi-lock"></i></label>
                                <input type="password" name="password" id="your_pass" placeholder="Password"/>
                            </div>
                            <div class="form-group">
                                <input type="checkbox" name="remember-me" id="remember-me" class="agree-term" />
                                <label for="remember-me" class="label-agree-term"><span><span></span></span>Remember me</label>
                            </div>
                            <div class="form-group form-button">
                                <input type="submit"  id="signin" class="form-submit" value="Log in"/>
                            </div>
                        </form>
                       
                    </div>
                </div>
            </div>
        </section>

    </div>

    <!-- JS -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="js/main.js"></script>
</body><!-- This templates was made by Colorlib (https://colorlib.com) -->
</html>