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

if(isset($_GET['non'])){
  non($_GET['non']);
}
if(isset($_GET['ap'])){
  ap($_GET['ap']);
}

if(isset($_GET['ubah_masyarakat'])) {
  $masyarakat = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM masyarakat WHERE nik='$_GET[ubah_masyarakat]'"));
}
if(isset($_POST['ubah_masyarakat'])){
  $nama = $_POST['nama'];
  $username = $_POST['username'];
  $password1 = $_POST['password1'];
  $password2 = $_POST['password2'];
  $telp = $_POST['telp'];


  $pesan_error = '';

  if ($password1 != $password2) {
    $pesan_error = 'Konfirmasi password tidak sesuai dengan password yang dimasukkan.';
  } else {
    $password = $password1;
  }

  if(empty($pesan_error)) {
    ubah_masyarakat($_GET['ubah_masyarakat'], $nama, $username, $password, $telp);
  }
}
if(isset($_GET['hapus_masyarakat'])){
  hapus_masyarakat($_GET['hapus_masyarakat']);
}
?>


        <!-- Page Content  -->
    

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

  <!-- Custom styles for this template -->
  <link href="css/sb-admin-2.min.css" rel="stylesheet">

  <!-- Custom styles for this page -->
  <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

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
      
      

 
      <!-- Heading -->
      
      <li class="nav-item">
        <a class="nav-link" href="admin.php">
          <i class="fas fa-fw fa-user"></i>
          <span>Akun Petugas</span></a>
      </li>

<li class="nav-item active">
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
        <!-- Page Content  -->
    

        <div style="display: inline;position: fixed;padding: 8px;">

</div>
        
  <div class="container">

    <!-- Outer Row -->
    <div class="row justify-content-center animated--grow-in">

      <div class="col-xl-7 col-lg-10 col-md-9">

        <div class="card o-hidden border-0 shadow-lg my-5">
          <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row">
              <div class="col-lg">
               
                  
<?php
if(isset($_GET['berhasil'])){
  if($_GET['berhasil']=="register"){
?>
                    <div class="form-group">
                      <div class="small">
                        <center><b align="center" class="text-primary">Akun masyarakat Berhasil dibuat !</b></center>
                      </div>
                    </div>
<?php
  }
}
?>
<?php
if(isset($_GET['berhasil'])){
  if($_GET['berhasil']=="duplikat"){
?>
                    <div class="form-group">
                      <div class="small">
                        <center><b align="center" class="text-danger">Username <u><?= $_GET['username'];?></u> tidak Tersedia !</b></center>
                      </div>
                    </div>
<?php
  }
}
?>
<?php
if(isset($_GET['berhasil'])){
  if($_GET['berhasil']=="keynotvalid"){
?>
                    <div class="form-group">
                      <div class="small">
                        <center><b align="center" class="text-danger">Konfirmasi Password tidak valid !</b></center>
                      </div>
                    </div>
<?php
  }
}
?>
<?php
if(isset($_GET['berhasil'])){
  if($_GET['berhasil']=="proses_ubah"){
?>
                    <div class="form-group">
                      <div class="small">
                        <center><b align="center" class="text-primary">Data masyarakat berhasil diubah !</b></center>
                      </div>
                    </div>
<?php
  }
}
?>
        <?php
if(isset($_GET['berhasil'])){
  if($_GET['berhasil']=="proses_hapus"){
?>
                    <div class="form-group">
                      <div class="small">
                        <center><b align="center" class="text-warning">1 masyarakat berhasil dihapus !</b></center>
                      </div>
                    </div>
<?php
  }
}
?>           
                </div>
              </div>
            </div>
          </div>
        </div>

      </div>



<!-- Modal -->
<?php
if(isset($_GET['ubah_masyarakat'])){?>
  <script type="text/javascript">window.onload = function(){document.getElementById('tombol').click();}</script>
  <input id="tombol" data-toggle="modal" data-target="#exampleModal" type="hidden">
<?php
  }
?>
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
      <h5 class="modal-title" id="exampleModalLabel">Edit Data Masyarakat <?= "[NIK: ".$_GET['ubah_masyarakat']."]";?></h5>
     
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

        <form method="POST" action="">
                    <div class="form-group">
                      <small>Nama masyarakat</small>
                      <input required="required" type="text" name="nama" class="form-control form-control-user" id="exampleInputEmail" value="<?php if(!empty($masyarakat)){ echo $masyarakat['nama']; }?>" aria-describedby="emailHelp" placeholder="Nama masyarakat">
                    </div>
                    <div class="form-group">
                      <small>Username</small>
                      <input  required="required" type="text" name="username" class="form-control form-control-user" value="<?php if(!empty($masyarakat)){ echo $masyarakat['username']; }?>" id="exampleInputEmail" aria-describedby="emailHelp" placeholder="Username">
                    </div>
                    <div class="form-group">
                    <small>password (jika tidak ada yg di ubah kosongkan saja)</small>

  <input type="password" name="password1" class="form-control form-control-user" id="exampleInputEmail" aria-describedby="emailHelp" placeholder="Ketik Password">
</div>
<small>konfirmasi password</small>

<div class="form-group">
  <input type="password" name="password2" class="form-control form-control-user" id="exampleInputEmail" aria-describedby="emailHelp" placeholder="Konfirmasi Password">
  <?php if(!empty($pesan_error)) { ?>
    <div class="text-danger"><?php echo $pesan_error; ?></div>
  <?php } ?>
</div>
                    <div class="form-group">
                      <small>Nomor Telepon</small>
                      <input required="required" value="<?php if(!empty($masyarakat)){ echo $masyarakat['telp']; }?>" type="number" name="telp" class="form-control form-control-user" id="exampleInputPassword" placeholder="Nomor Telepon">
                    </div>
                   

      </div>
      <div class="modal-footer">
        <input type="submit" onclick="return confirm('Konfirmasi Perubahan ?');" name="ubah_masyarakat" value="Simpan Perubahan" class="btn btn-primary btn-user btn-block">
      </div>
      </form>
    </div>
  </div>
</div>

          <!-- DataTales Example -->
          <div class="card shadow mb-4 animated--grow-in">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Tabel masyarakat</h6>
            </div>
            <div class="card-body">
              <div class="table-responsive">
              <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
  <thead>
    <tr>
      <th>ID</th>
      <th>Nama masyarakat</th>
      <th>Username</th>
      <th>Password</th>
      <th>Telepon</th>
      <th>gambar</th>
      <th>Opsi</th>
    </tr>
  </thead>

  <tbody>
    <?php
    $out = mysqli_query($conn, "SELECT * FROM masyarakat where role='masyarakat' ");
    while($keluar = mysqli_fetch_array($out)){
    ?>
    <tr>
      <td><?php echo $keluar['nik'];?></td>
      <td><?php echo $keluar['nama'];?></td>
      <td><?php echo $keluar['username'];?></td>
      <td><?php echo $keluar['password'];?></td>
      <td><?php echo $keluar['telp'];?></td>
      <td>
        <?php if(!empty($keluar['gambar'])) { ?>
          <img src="../uploads/<?php echo $keluar['gambar']; ?>" alt="gambar <?php echo $keluar['nama']; ?>" width="100" height="100">
        <?php } else { ?>
          <i>Tidak ada gambar</i>
        <?php } ?>
      </td>
      <td>
        <a title="Ubah" href="?ubah_masyarakat=<?php echo $keluar['nik'];?>" class="btn btn-primary"><span class="fas fa-fw fa-pen"></span></a>
        <a onclick="return confirm('Yakin ingin Menghapus masyarakat ? \n ID masyarakat: <?php echo $keluar['nik'];?>');" href="?hapus_masyarakat=<?php echo $keluar['nik'];?>" class="btn btn-danger"><span class="fas fa-fw fa-trash"></span></a>
      </td>
    </tr>
    <?php
    }
    ?>
  </tbody>
</table>

              </div>
            </div>
          </div>
  </div>

 <!-- Footer -->
 <footer class="sticky-footer bg-white">
        <div class="container my-auto">
          <div class="copyright text-center my-auto">
            <span>Copyright &copy; Your Website 2019</span>
          </div>
        </div>
      </footer>
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
  <script src="vendor/datatables/jquery.dataTables.min.js"></script>
  <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

  <!-- Page level custom scripts -->
  <script src="js/demo/datatables-demo.js"></script>


  </body>
</html>