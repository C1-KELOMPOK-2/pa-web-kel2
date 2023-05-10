<?php 
session_start();
require "../koneksi.php";

// Periksa apakah pengguna telah login sebagai admin
if ($_SESSION['role'] !== 'admin') {
  header('Location: ../login.php');
  exit();
}

if (isset($_GET['logout'])) {
  session_destroy();
  header('Location: ../login.php');
  exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Pengaduan</title>

  <!-- Custom fonts for this template-->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="css/sb-admin-2.min.css" rel="stylesheet">

</head>
<style>
  .bg-wrap .user-logo .img {
    width: 100px;
    height: 100px;
    border-radius: 50%;
    margin: 0 auto;
    margin-bottom: 10px; }
  .bg-wrap .user-logo h3 {
    color: #fff;
    font-size: 18px; }
    *{

margin: 0;

padding: 0;

box-sizing: border-box;

list-style: none;

font-family: ‘Josefin Sans’, sans-serif;

}


h2 {
  font-
}

.wrapper .left{

  width: 40%;

  background: linear-gradient(to right,#083885,#086cb3);

  padding: 30px 25px;

  border-top-left-radius: 5px;

  border-bottom-left-radius: 5px;

  text-align: center;

  color: #fff;

}


.wrapper .left img{

  border-radius: 5px;

  margin-bottom: 10px;

}


.wrapper .left h4{

  margin-bottom: 10px;

  font-size: 20px;

  font-family: sans-serif; 

}


.wrapper .left p{

  font-size: 15px;

}


.wrapper{

position: absolute;

top: 50%;

left: 50%;

transform: translate(-50%,-50%);

width: 500px;

display: flex;

box-shadow: -10px 5px 20px rgba(0, 0, 0, 0.1);

}

</style>
<body id="page-top">

  <!-- Page Wrapper -->
  <div id="wrapper">

   <!-- Sidebar -->
   <ul class="navbar-nav sidebar sidebar-dark accordion" id="accordionSidebar" style="background: linear-gradient(90deg, rgba(2,0,36,1) 0%, rgba(44,231,156,1) 0%, rgba(0,212,255,1) 100%);">


      <!-- Sidebar - Brand -->
      <div class="img bg-wrap text-center py-4" style="background-image: url(images/test.jpg);">
	  			<div class="user-logo">
	  				<div class="img" style="background-image: url();"></div>
	  				<h3 id=nama_ni></h3>
	  			</div>
	  		</div>

      <!-- Divider -->
      <hr class="sidebar-divider my-0">

      <!-- Nav Item - Dashboard -->
      <li class="nav-item">
        <a class="nav-link" href="index.php">
          <i class="fas fa-fw fa-tachometer-alt"></i>
          <span>Home</span></a>
      </li>
      
      
      <li class="nav-item active">
        <a class="nav-link" href="profil.php">
          <i class="fas fa-fw fa-tachometer-alt"></i>
          <span>Profil</span></a>
      </li>
 
      <!-- Heading -->
      
      <li class="nav-item">
        <a class="nav-link" href="admin.php">
          <i class="fas fa-fw fa-user"></i>
          <span>Akun Petugas</span></a>
      </li>

<li class="nav-item">
        <a class="nav-link" href="masyarakat.php">
          <i class="fas fa-fw fa-user"></i>
          <span>Akun masyarakat</span></a>
      </li>
      <!-- Divider -->
      <hr class="sidebar-divider d-none d-md-block">

      <!-- Sidebar Toggler (Sidebar) -->
      <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
      </div>

    </ul>
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">

        <!-- Topbar -->
        <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow" id="accordionSidebar">

          <!-- Sidebar Toggle (Topbar) -->
          <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
            <i class="fa fa-bars"></i>
          </button>

          <!-- Topbar Search -->
       

        <!-- Topbar Navbar -->
<?php include("header/topbar.php");?>
        <!-- End of Topbar -->

        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 col-md-8 text-grey-800">Dashboard Admin</h1>
            
            <a href="print_report.php" target="_blank" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-table fa-sm text-white-50"></i> Lihat Laporan</a>
            <a href="eksel.php" target="_blank" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"> <i class="fas fa-print fa-sm text-white-50"></i>laporan excel</a>
          </div>
      
<br>
<br>
          <!-- Content Row -->
         
          <!-- Content Row -->
          <div class="row">

<div class="col-xl-8 col-lg-7">

    <!-- Area Chart -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Profil</h6>
        </div>
        <div class="card-body">
            <h3>Nama       : <span><?= $_SESSION['nama_petugas'];?></span></h3>
            <h3>No Telepon : <?= $_SESSION['telp'];?> </h3>
            <h3>Role       : <?= $_SESSION['role'];?></h3>

        </div>
    </div>
      <!-- End of Main Content -->

      <!-- Footer -->
     
      <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->

  </div>
  <!-- End of Page Wrapper -->

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  <!-- Logout Modal-->
  <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
          <a class="btn btn-primary" href="?logout">Logout</a>
        </div>
      </div>
    </div>
  </div>

  <!-- Bootstrap core JavaScript-->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="js/sb-admin-2.min.js"></script>

  <!-- Page level plugins -->
  <script src="vendor/chart.js/Chart.min.js"></script>

  <!-- Page level custom scripts -->
  <script src="js/demo/chart-area-demo.js"></script>
  <script src="js/demo/chart-pie-demo.js"></script>
  <script type="text/javascript">
  Chart.defaults.global.defaultFontFamily = 'Nunito', '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
  Chart.defaults.global.defaultFontColor = '#858796';

  // Pie Chart Example
  var ctx = document.getElementById("bulet");
  
  var myPieChart = new Chart(ctx, {
    type: 'doughnut',
    data: {
      labels: ["Diproses", "Selesai", "Belum ditanggapi"],
      datasets: [{
        data: [<?= $persenproses;?>, <?= $persenselesai;?>, <?= $persenbelumditanggapi;?>],
        backgroundColor: ['#4e73df', '#1cc88a', '#f6c23e'],
        hoverBackgroundColor: ['#2e59d9', '#17a673', '#f6c25e'],
        hoverBorderColor: "rgba(234, 236, 244, 1)",
      }],
    },
    options: {
      maintainAspectRatio: false,
      tooltips: {
        backgroundColor: "rgb(255,255,255)",
        bodyFontColor: "#858796",
        borderColor: '#dddfeb',
        borderWidth: 1,
        xPadding: 15,
        yPadding: 15,
        displayColors: false,
        caretPadding: 10,
      },
      legend: {
        display: false
      },
      cutoutPercentage: 80,
    },
  });

  </script>
</body>

</html>


























