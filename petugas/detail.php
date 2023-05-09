<?php 
require("../../config/fungsi.php");
$data = $_SESSION['data_petugas'];

auth_petugas();
if(isset($_GET['logout'])) {
  logout();
}

if(isset($_GET['proses'])){
  proses($_GET['proses']);
}



if(isset($_POST['ubah_tanggapan'])){
  
  ubah_tanggapan($_GET['ubah_tanggapan'], $_POST['tanggapan']);
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

  <title>Daftar</title>

  <!-- Custom fonts for this template-->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="css/sb-admin-2.min.css" rel="stylesheet">

</head>
<style>

table {width: 100%;

}
table, th, td {
  border: 1px solid black;
  border-collapse: collapse;
}
th, td {
  padding: 5px;
     
}
</style>
<body class="bg-gradient-primary">

<div class="shadow fixed-left bg-light card" style="display: inline;position: fixed;padding: 8px;">
  <a href="index.php"><button class="btn btn-primary"><b>Dashboard</b></button></a>
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
                <div class="p-5">
                  <div class="text-center">
                    <h1 class="h4 text-gray-900 mb-4">detail</h1>
                    <hr>
                  </div>
               <?php
$no = 1;
  $out = mysqli_query($koneksi, "SELECT * FROM tanggapan  inner join pengaduan ON tanggapan.id_pengaduan=pengaduan.id_pengaduan inner join masyarakat ON pengaduan.nik=masyarakat.nik where status='selesai'");
  while($keluar = mysqli_fetch_array($out)){
?>
  <table border="1" align="center">



  

</tr>
<tr>

<td>NO :</td>
<td> <?php echo $no++?></td>

</tr>

<tr>

<td>TANGGAL :</td>
<td> <?php echo $keluar['tgl_pengaduan'];?></td>

</tr>

<tr>

<td>NAMA :</td>
<td><?php echo $keluar['nama'];?></td>

</tr>
<tr>

<td>NIK :</td>
<td><?php echo $keluar['nik'];?></h5></td>
</tr>
<tr>

<td>TELPON :</td>
<td> <?php echo $keluar['telp'];?></td>

</tr>
<tr>
<td>ISI LAPORAN :</td>
<td><?php echo $keluar['isi_laporan'];?></td>
</tr>
<tr>
<td>TANGGAPAN :</td>
<td><?php echo $keluar['tanggapan'];?></td>
</tr>
<tr>
<td>FOTO :</td>
<td><img src="../../file_upload/<?php echo $keluar['foto'];?>" style="width: 100px;height: auto;"></td>
</tr>
<td>STATUS :</td>
<td><?php if($keluar['status']=="selesai"){ ?>
                          <a onclick="return confirm('Yakin ingin kembalikan menjadi proses belum <?php echo $keluar['status'];?>');" href="?proses=<?php echo $keluar['id_pengaduan'];?>" class="btn btn-success">selesai</span></a>
                      
                        <?php } ?>  </td>
</tr>



</table> 
<br>
            <a title="Ubah" href="?ubah_tanggapan=<?php echo $keluar['id_tanggapan'];?>" class="btn btn-primary btn-user btn-block"><span class="fas fa-fw fa-pen"></span>edit</a></td>
<?php
}
?>
               
<?php
if(isset($_GET['berhasil'])){
  if($_GET['berhasil']=="register"){
?>
                    <div class="form-group">
                      <div class="small">
                        <center><b align="center" class="text-primary">Akun Petugas Berhasil dibuat !</b></center>
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
                        <center><b align="center" class="text-primary">tanggapan diubah !</b></center>
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

    </div>


<!-- Modal -->
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
        <h5 class="modal-title" id="exampleModalLabel">Edit tanggapan</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

        <form method="POST" action="">
        <div class="form-group">
                      <small>TANGGAPAN</small>
                      <textarea required="required" type="text" name="tanggapan" class="form-control form-control-user" id="exampleInputEmail" aria-describedby="emailHelp"  placeholder="Masukan Tanggapan"></textarea>
                    </div>
                  
                 

      </div>
      <div class="modal-footer">
        <input type="submit" onclick="return confirm('Konfirmasi Perubahan ?');" name="ubah_tanggapan" value="Simpan Perubahan" class="btn btn-primary btn-user btn-block">
      </div>
      </form>
    </div>
  </div>
</div>

          <!-- DataTales Example -->
        
               
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

</body>

</html>