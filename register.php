<?php
require "koneksi.php";

if (isset($_POST['submit'])) {
    // Get input data
    $nama = $_POST['nama'];
    $nik = $_POST['nik'];
    $username = $_POST['username'];
    $password = $_POST['password1'];
    $telp = $_POST['telp'];
    $role = $_POST['role'];
    
    // Check if the gambar key is set in the $_FILES array
    if (isset($_FILES['gambar'])) {
        $gambar = $_FILES['gambar']['name'];
        
        // Check if username already exists
        $check_username = mysqli_query($conn, "SELECT * FROM masyarakat WHERE username='$username'");
        $check_nik = mysqli_query($conn, "SELECT * FROM masyarakat WHERE nik='$nik'");

        if (mysqli_num_rows($check_username) > 0) {
            echo "<script>alert('Username sudah digunakan');</script>";
        }else if (mysqli_num_rows($check_nik) > 0) {
                echo "<script>alert('nik sudah digunakan');</script>";
        
        } else {
            // Insert data into database
            $insert = mysqli_query($conn, "INSERT INTO masyarakat (nama, nik, username, password, telp, role, gambar) VALUES ('$nama', '$nik', '$username', '$password', '$telp', '$role', '$gambar')");
            if ($insert) {
                // Upload image to server
                $target_dir = "uploads/";
                $target_file = $target_dir . basename($_FILES["gambar"]["name"]);
                move_uploaded_file($_FILES["gambar"]["tmp_name"], $target_file);

                echo "<script>
                alert('Berhasil register');
                document.location.href = 'login.php';
                </script>";
            } else {
                echo "<script>alert('Gagal mendaftar');</script>";
            }
        }
    } else {
        // If the gambar key is not set, set the $gambar variable to an empty string
        $gambar = "";
        
        // Check if username already exists
        $check_username = mysqli_query($conn, "SELECT * FROM masyarakat WHERE username='$username'");
        $check_nik = mysqli_query($conn, "SELECT * FROM masyarakat WHERE nik='$nik'");

        if (mysqli_num_rows($check_username) > 0) {
            echo "<script>alert('Username sudah digunakan');</script>";

        }else if (mysqli_num_rows($check_nik) > 0) {
            echo "<script>alert('nik sudah digunakan');</script>";
    
        } else {
            // Insert data into database
            $insert = mysqli_query($conn, "INSERT INTO masyarakat (nama, nik, username, password, telp, role, gambar) VALUES ('$nama', '$nik', '$username', '$password', '$telp', '$role', '$gambar')");
            if ($insert) {
                echo "<script>
                alert('Berhasil register');
                document.location.href = 'login.php';
                </script>";
            } else {
                echo "<script>alert('Gagal mendaftar');</script>";
            }
        }
    }
}
?>










<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>register</title>

    <!-- Font Icon -->
    <link rel="stylesheet" href="login/fonts/material-icon/css/material-design-iconic-font.min.css">

    <!-- Main css -->
    <link rel="stylesheet" href="login/css/style.css">
</head>
<body>

    <div class="main">

        <!-- Sign up form -->
        <section class="signup">
            <div class="container">
                <div class="signup-content">
                    <div class="signup-form">
                    
                    
                    
                    <h2 class="form-title">sign up</h2>

                        <form method="POST" class="register-form" id="register-form" enctype="multipart/form-data">
                            <div class="form-group">
                                <label for="name"><i class="zmdi zmdi-account material-icons-name"></i></label>
                                <input type="text" name="nama" id="name" placeholder="nama anda"/>
                            </div>
                            <div class="form-group">
                                <label for="name"><i class="zmdi zmdi-account material-icons-name"></i></label>
                                <input type="text" name="nik" id="name" placeholder="nik"/>
                            </div>
                            <div class="form-group">
                                <label for="email"><i class="zmdi zmdi-email"></i></label>
                                <input type="text" name="username" id="email" placeholder="username"/>
                            </div>
                            <div class="form-group">
                                <label for="pass"><i class="zmdi zmdi-lock"></i></label>
                                <input type="password" name="password1" id="pass" placeholder="Password"/>
                            </div>
                            <div class="form-group">
                                <label for="re-pass"><i class="zmdi zmdi-lock-outline"></i></label>
                                <input type="password" name="password2" id="re_pass" placeholder="Repeat your password"/>
                            </div>
                            <div class="form-group">
                                <label for="name"><i class="zmdi zmdi-account material-icons-name"></i></label>
                                <input type="text" name="telp" id="name" placeholder="no telp"/>
                            </div>
                            <div class="form-group">
                                <span>masukan foto anda</span>
                               
                                <input required="required" type="file" name="gambar" class="form-control-file" id="gambar" aria-describedby="gambarHelp" accept="image/*">
                            </div>
                            <div class="form-group">
                                <input type="checkbox" name="agree-term" id="agree-term" class="agree-term" />
              
                            </div>
                            <input type="hidden" name="role" id="role" class="agree-term" value="masyarakat"/>
                           
                           
                           
                            <div class="form-group form-button">
                                <input type="submit" name="submit" id="signup" class="form-submit" value="Register"/>
                            </div>
                        </form>
                    </div>
                    <div class="signup-image">
                        <figure><img src="login/images/6.jpg" alt="sing up image"></figure>
                        <a href="login.php" class="signup-image-link">I am already member</a>
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