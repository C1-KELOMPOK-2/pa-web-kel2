<?php

require("../../config/fungsi.php");
$data = $_SESSION['data_petugas'];

auth_petugas();
?><!DOCTYPE html>
<html>
<head>
	<title>Export Data Ke Excel Dengan PHP - www.malasngoding.com</title>
</head>
<body>
	<style type="text/css">
	body{
		font-family: sans-serif;
	}
	table{
		margin: 20px auto;
		border-collapse: collapse;
        text-align: center;
	}
	table th,
	table td{
		border: 1px solid #3c3c3c;
		padding: 3px 8px;
        text-align: center;
	}
	a{
		background: blue;
		color: #fff;
		padding: 8px 10px;
		text-decoration: none;
		border-radius: 2px;
	}
	</style>

	<?php
	header("Content-type: application/vnd-ms-excel");
	header("Content-Disposition: attachment; filename=laporan masyarakat.xls");
	?>

	<center>
		<h1>LAPORAN MASYARAKAT</h1>
	</center>
	<center><?php 

// menampilkan jam sekarang


//kombinasi format tanggal dan jam
echo date('l, d-m-Y H:i:s a');

?></center>
<br>
<br>
<h1>BELUM DITANGGAPI</h1>
<table width="100%" cellspacing="0" border="1">
          
                    <tr align="center">
                      <th>NO</th>
                      <th>Tanggal</th>
					  <th>NAMA</th>
                      <th>NIK</th>
                      <th>laporan</th>
                     
                    </tr>
              
                  
                  <tbody>
<?php

$no = 1;
  $out = mysqli_query($koneksi, "SELECT * FROM pengaduan inner join masyarakat ON pengaduan.nik=masyarakat.nik where status=1");
  while($keluar = mysqli_fetch_array($out)){
?>

                    <tr align="center">
                      <td><?php echo $no++?></td>
                      <td><?php echo $keluar['tgl_pengaduan'];?></td>
					  <td><?php echo $keluar['nama'];?></td>
                      <td><?php echo $keluar['nik'];?></td>
                      <td><?php echo $keluar['isi_laporan'];?></td>
                     
                    </tr>
<?php
}
?>
                  </tbody>
                </table>
				<br>
<br>
<h1>DI PROSES</h1>
<table width="100%" cellspacing="0" border="1">
          
                    <tr align="center">
                      <th>NO</th>
                      <th>Tanggal</th>
					  <th>NAMA</th>
            <th>telpon</th>
                      <th>NIK</th>
                      
                      <th>laporan</th>
                      <th>tanggapan</th>
                    </tr>
              
                  
                  <tbody>
<?php

$no = 1;
  $out = mysqli_query($koneksi, "SELECT * FROM tanggapan  inner join pengaduan ON tanggapan.id_pengaduan=pengaduan.id_pengaduan inner join masyarakat ON pengaduan.nik=masyarakat.nik where status='proses'");
  while($keluar = mysqli_fetch_array($out)){
?>

                    <tr align="center">
                      <td><?php echo $no++?></td>
                      <td><?php echo $keluar['tgl_pengaduan'];?></td>
					  <td><?php echo $keluar['nama'];?></td>
            <td><?php echo $keluar['telp'];?></td>
                      <td><?php echo $keluar['nik'];?></td>
                  
                      <td><?php echo $keluar['isi_laporan'];?></td>
                      <td><?php echo $keluar['tanggapan'];?></td>
                      
                     
                    </tr>
<?php
}
?>
                  </tbody>
                </table>
				<br>
<br>
<h1>SELESAI</h1>
<table width="100%" cellspacing="0" border="1">
          
                    <tr align="center">
                  
                      <th>NO</th>
                      <th>Tanggal</th>
					  <th>NAMA</th>
            <th>telpon</th>
                      <th>NIK</th>
                    
                      <th>laporan</th>
                      <th>tanggapan</th>
                    </tr>
                     
                 
              
                  
                  <tbody>
<?php

$no = 1;
  $out = mysqli_query($koneksi, "SELECT * FROM tanggapan  inner join pengaduan ON tanggapan.id_pengaduan=pengaduan.id_pengaduan inner join masyarakat ON pengaduan.nik=masyarakat.nik where status='selesai'");
  while($keluar = mysqli_fetch_array($out)){
?>

                    <tr align="center">
                      <td><?php echo $no++?></td>
                      <td><?php echo $keluar['tgl_pengaduan'];?></td>
					  <td><?php echo $keluar['nama'];?></td>
            <td><?php echo $keluar['telp'];?></td>
                      <td><?php echo $keluar['nik'];?></td>
                      
                      <td><?php echo $keluar['isi_laporan'];?></td>
                      <td><?php echo $keluar['tanggapan'];?></td>
                     
                    </tr>
<?php
}
?>
                  </tbody>
                </table>
</body>
</html>