<?php 
require("../../config/fungsi.php");
$data = $_SESSION['data_petugas'];

auth_petugas();
if(isset($_GET['logout'])) {
  logout();
}
if(isset($_GET['proses_selesai'])){
  proses_selesai($_GET['proses_selesai'], $_GET['nik']);
}
if(isset($_GET['hapus_pengaduan'])){
  hapus_pengaduan($_GET['hapus_pengaduan']);
}

if(isset($_GET['ubah_tanggapan'])) {
  $petugas = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM tanggapan  inner join pengaduan ON tanggapan.id_pengaduan=pengaduan.id_pengaduan inner join masyarakat ON pengaduan.nik=masyarakat.nik where id_tanggapan='$_GET[ubah_tanggapan]'"));
}
if(isset($_POST['ubah_tanggapan'])){
  ubah_tanggapan($_GET['ubah_tanggapan'], $_POST['tanggapan'], $_POST['status'], $petugas['nik'], $petugas['telp'], $petugas['isi_laporan'], $petugas['status']);
}
if(isset($_GET['proses'])){
  proses($_GET['proses']);
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

  <title>Tabel Pengaduan</title>

  <!-- Custom fonts for this template -->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template -->
  <link href="css/sb-admin-2.min.css" rel="stylesheet">

  <!-- Custom styles for this page -->
  <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

</head>

<body id="page-top">

  <!-- Page Wrapper -->
  <div id="wrapper">

   <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

      <!-- Sidebar - Brand -->
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="#">
        <div class="sidebar-brand-icon rotate-n-15">
          <i class="fas fa-laugh-wink"></i>
        </div>
        <div class="sidebar-brand-text mx-3">Pengaduan <sup>Masyarakat</sup></div>
      </a>

      <!-- Divider -->
      <hr class="sidebar-divider my-0">

      <!-- Nav Item - Dashboard -->
      <li class="nav-item">
        <a class="nav-link" href="index.php">
          <i class="fas fa-fw fa-tachometer-alt"></i>
          <span>Dashboard</span></a>
      </li>

      <!-- Divider -->
      <hr class="sidebar-divider">

      <!-- Heading -->
      <div class="sidebar-heading">
        Manajemen Pengaduan
      </div>

      <!-- Nav Item - Pages Collapse Menu -->
      <li class="nav-item active">
        <a class="nav-link collapsed" href="pengaduan.php">
          <i class="fas fa-fw fa-cog"></i>
          <span>Pengaduan Diproses</span>
        </a>
      </li>

      <!-- Nav Item - Tables -->
      <li class="nav-item">
        <a class="nav-link" href="tables.php">
          <i class="fas fa-fw fa-table"></i>
          <span>Tanggapi Pengaduan</span></a>
      </li>
<?php
if($data['level']=="admin"){
?>
      <!-- Divider -->
      <hr class="sidebar-divider">
      <!-- Heading -->
      <div class="sidebar-heading">
        Petugas
      </div>
      <!-- Nav Item - Tables -->
      <li class="nav-item">
        <a class="nav-link" href="petugas.php">
          <i class="fas fa-fw fa-user"></i>
          <span>Kelola Akun Petugas</span></a>
      </li>
<?php } ?>
<?php
if($data['level']=="admin"){
?>
<li class="nav-item active">
        <a class="nav-link" href="ok.php">
          <i class="fas fa-fw fa-user"></i>
          <span>kelola akun masyarakat</span></a>
      </li><?php } ?>
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
        <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

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
          <h1 class="h3 mb-2 text-primary-800">Diproses</h1>

          <!-- DataTales Example -->
          <div class="card shadow mb-4 animated--grow-in">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Tabel Pengaduan Diproses</h6>
            </div>
            <div class="card-body">
<?php
if(isset($_GET['berhasil'])){
  if($_GET['berhasil']=="proses_oke"){
?>
                    <div class="form-group">
                      <div class="small">
                        <center><b align="center" class="text-success">1 Pengaduan telah Selesai !</b></center>
                      </div>
                    </div>
<?php
  }
}
?>
<?php
if(isset($_GET['berhasil'])){
  if($_GET['berhasil']=="sip"){
?>
                    <div class="form-group">
                      <div class="small">
                        <center><b align="center" class="text-primary">1 Pengaduan kembali di proses !</b></center>
                      </div>
                    </div>
<?php
  }
}
?>
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>NO</th>
                      <th>Tanggal</th>
                      <th>Nama</th>
                      <th>NIK</th>
                      <th>TELP</th>
                      <th>Isi</th>
                      <th>tanggapan</th>
                      <th>Foto</th>
                      <th>Aksi</th>
                    </tr>
                  </thead>
                  <tfoot>
                    <tr>
                      <th>NO</th>
                      <th>Tanggal</th>
                      <th>Nama</th>
                      <th>NIK</th>
                      <th>TELP</th>
                      <th>Isi</th>
                      <th>tanggapan</th>
                      <th>Foto</th>
                      <th>Aksi</th>
                    </tr>
                  </tfoot>
                  <tbody>
<?php
$no = 1;
  $out = mysqli_query($koneksi, "SELECT * FROM tanggapan  inner join pengaduan ON tanggapan.id_pengaduan=pengaduan.id_pengaduan inner join masyarakat ON pengaduan.nik=masyarakat.nik where status='proses'");
  while($keluar = mysqli_fetch_array($out)){
?>

                    <tr>
                      <td><?php echo $no++?></td>
                      <td><?php echo $keluar['tgl_pengaduan'];?></td>
                      <td><?php echo $keluar['nama'];?></td>
                      <td><?php echo $keluar['nik'];?></td>
                      <td><?php echo $keluar['telp'];?></td>
                      <td><?php echo $keluar['isi_laporan'];?></td>
                      <td><?php echo $keluar['tanggapan'];?></td>
                      <td align="Center"><img src="../../file_upload/<?php echo $keluar['foto'];?>" style="width: 100px;height: auto;"></td>
                      <td><a onclick="return confirm('Konfirmasi untuk Melanjutkan Proses Penyelesaian');" href="?proses_selesai=<?php echo $keluar['id_pengaduan'];?>&nik=<?php echo $keluar['nik'];?>" class="btn btn-success">Proses Selesai</a></td>
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
        <!-- /.container-fluid -->
<hr/>
        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <h1 class="h3 mb-2 text-success-800">Selesai</h1>

          <!-- DataTales Example -->
          <div class="card shadow mb-4 animated--grow-in">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-success">Tabel Pengaduan Telah Selesai</h6>
            </div>
            <div class="card-body">
<?php
if(isset($_GET['berhasil'])){
  if($_GET['berhasil']=="proses_hapus"){
?>
                    <div class="form-group">
                      <div class="small">
                        <center><b align="center" class="text-warning">1 Pengaduan berhasil dihapus !</b></center>
                      </div>
                    </div>
<?php
  }
}
?>
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>NO</th>
                      <th>Tanggal</th>
                      <th>Nama</th>
                      <th>NIK</th>
                     
                      <th>Status</th>
                   
                      <th>Aksi</th>
                    </tr>
                  </thead>
                  <tfoot>
                    <tr>
                      <th>NO</th>
                      <th>Tanggal</th>
                      <th>Nama</th>
                      <th>NIK</th>
                      
                      
                      <th>Status</th>
                  
                      <th>Aksi</th>
                    </tr>
                  </tfoot>
                  <tbody>
<?php
$no = 1;
  $out = mysqli_query($koneksi, "SELECT * FROM tanggapan  inner join pengaduan ON tanggapan.id_pengaduan=pengaduan.id_pengaduan inner join masyarakat ON pengaduan.nik=masyarakat.nik where status='selesai'");
  while($keluar = mysqli_fetch_array($out)){
?>

                    <tr>
                      <td><?php echo $no++?></td>
                      <td><?php echo $keluar['tgl_pengaduan'];?></td>
                      <td><?php echo $keluar['nama'];?></td>
                      <td><?php echo $keluar['nik'];?></td>
                   
                     
                      <td><p class="text-success"><b>SELESAI</b></p></td>
                      <td><a title="Ubah" href="?ubah_tanggapan=<?php echo $keluar['id_tanggapan'];?>" class="btn btn-primary btn-user">DETAIL DAN EDIT</a>
                      <a onclick="return confirm('Yakin ingin Menghapus Pengaduan ? \n ID Pengaduan : <?php echo $keluar['id_pengaduan'];?>');" href="?hapus_pengaduan=<?php echo $keluar['id_pengaduan'];?>" class="btn btn-danger"><span class="fas fa-fw fa-trash"></span></a></td>
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
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->
<?php
if(isset($_GET['ubah_tanggapan'])){?>
  <script type="text/javascript">window.onload = function(){document.getElementById('tombol').click();}</script>
  <input id="tombol" data-toggle="modal" data-target="#exampleModal" type="hidden">
<?php
  }
  
?>
      
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">detail dan edit</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

        <form method="POST" action="">
        <div class="form-group">
                      <small>nama</small>
                      <input value="<?php if(!empty($petugas)){ echo $petugas['nama']; }?>" type="text" name="tanggapan" class="form-control form-control-user" id="exampleInputEmail" aria-describedby="emailHelp"  placeholder="" readonly></textarea>
                    </div>
                  
                    <div class="form-group">
                      <small>nik</small>
                      <input value="<?php if(!empty($petugas)){ echo $petugas['nik']; }?>" type="text" name="nik" class="form-control form-control-user" id="exampleInputEmail" aria-describedby="emailHelp"  placeholder="" readonly></textarea>
                    </div>
                    <div class="form-group">
                      <small>telepon</small>
                      <input value="<?php if(!empty($petugas)){ echo $petugas['telp']; }?>"  type="text" name="tanggapan" class="form-control form-control-user" id="exampleInputEmail" aria-describedby="emailHelp"  placeholder="Masukan Tanggapan" readonly></textarea>
                    </div>
                    <div class="form-group">
                      <small>isi laporan</small>
                      <input value="<?php if(!empty($petugas)){ echo $petugas['isi_laporan']; }?>" type="text" name="tanggapan" class="form-control form-control-user" id="exampleInputEmail" aria-describedby="emailHelp"  placeholder="Masukan Tanggapan" readonly></textarea>
                    </div>
                    <div class="form-group">
                      <small>TANGGAPAN</small>
                      <input value="<?php if(!empty($petugas)){ echo $petugas['tanggapan']; }?>" type="text" name="tanggapan" class="form-control form-control-user" id="exampleInputEmail" aria-describedby="emailHelp"  placeholder="Masukan Tanggapan"></textarea>
                    </div>
                    <div class="form-group">
                      <small>FOTO</small>
                      <td><img src="../../file_upload/<?php echo $petugas['foto'];?>" style="width: 100px;height: auto;"></td>
                    </div>
                    <div class="form-group">
                      <small>STATUS</small>
                      <select required="required" name="status" value="<?php if(!empty($petugas)){ echo $petugas['status']; }?>" class="form-control form-control-user" id="exampleInputPassword" placeholder="Level">
                        <option value="selesai">selesai</option>
                        <option value="proses">proses</option>
                      </select>
                    </div>

      </div>
      <div class="modal-footer">
        <input type="submit" onclick="return confirm('Konfirmasi Perubahan ?');" name="ubah_tanggapan" value="Simpan Perubahan" class="btn btn-primary btn-user btn-block">
      </div>
      </form>
     
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
