<?php

require("../../config/fungsi.php");
$data = $_SESSION['data_petugas'];

auth_petugas();

require('fpdf/fpdf.php');
{
  date_default_timezone_set('Asia/Jakarta');// change according timezone
  $currentTime = date( 'd-m-Y h:i:s A', time () );
  }
$pdf = new FPDF('l','mm','A5');
// membuat halaman baru
$pdf->AddPage();
// setting jenis font yang akan digunakan
$pdf->SetFont('Arial','B',16);
// mencetak string 
$pdf->Cell(190,1,'LAPORAN PENGADUAN MASYARAKAT',0,1,'C');
$pdf->Cell(190,20.7,"".date("D-d/m/Y  h:i:s a"),0,1,'C');
$pdf->ln(1);
$pdf->SetFont('Arial','B',12);


// Memberikan space kebawah agar tidak terlalu rapat
$pdf->Cell(14,25,'1. BELUM DITANGGAPI',4,4);

$pdf->SetFont('Arial','B',10);
$pdf->Cell(12,6,'NO',1,0);
$pdf->Cell(35,6,'TANGGAL',1,0);
$pdf->Cell(36,6,'NAMA',1,0);
$pdf->Cell(35,6,'NIK',1,0);
$pdf->Cell(35,6,'TELPON',1,0);
$pdf->Cell(35,6,'LAPORAN',1,1);


$pdf->SetFont('Arial','',10);


$no = 1;
$out = mysqli_query($koneksi, "SELECT * FROM pengaduan inner join masyarakat ON pengaduan.nik=masyarakat.nik where status=1");
  while($keluar = mysqli_fetch_array($out)){
    $pdf->Cell(12,6,$no++,1,0);
    $pdf->Cell(35,6,$keluar['tgl_pengaduan'],1,0);
    $pdf->Cell(36,6,$keluar['nama'],1,0);
    $pdf->Cell(35,6,$keluar['nik'],1,0);
    $pdf->Cell(35,6,$keluar['telp'],1,0);
    $pdf->Cell(35,6,$keluar['isi_laporan'],1,1);
  
}
$pdf->SetFont('Arial','B',12);
$pdf->Cell(14,25,'2. DIPROSES',4,4);

$pdf->SetFont('Arial','B',10);
$pdf->Cell(9,6,'NO',1,0);
$pdf->Cell(20,6,'TANGGAL',1,0);
$pdf->Cell(35,6,'NAMA',1,0);
$pdf->Cell(20,6,'NIK',1,0);

$pdf->Cell(30,6,'TELPON',1,0);

$pdf->Cell(35,6,'LAPORAN',1,0);
$pdf->Cell(39,6,'TANGGAPAN',1,1);


$pdf->SetFont('Arial','',10);
$no = 1;
$out = mysqli_query($koneksi, "SELECT * FROM tanggapan  inner join pengaduan ON tanggapan.id_pengaduan=pengaduan.id_pengaduan inner join masyarakat ON pengaduan.nik=masyarakat.nik where status='proses'");
  while($keluar = mysqli_fetch_array($out)){
    $pdf->Cell(9,6,$no++,1,0);
    $pdf->Cell(20,6,$keluar['tgl_pengaduan'],1,0);
    $pdf->Cell(35,6,$keluar['nama'],1,0);
    $pdf->Cell(20,6,$keluar['nik'],1,0);
    $pdf->Cell(30,6,$keluar['telp'],1,0);
    $pdf->Cell(35,6,$keluar['isi_laporan'],1,0);
    $pdf->Cell(39,6,$keluar['tanggapan'],1,1);
  
  

}
$pdf->SetFont('Arial','B',12);
$pdf->Cell(14,25,'3. SELESAI',4,4);

$pdf->SetFont('Arial','B',10);
$pdf->Cell(9,6,'NO',1,0);
$pdf->Cell(20,6,'TANGGAL',1,0);
$pdf->Cell(35,6,'NAMA',1,0);
$pdf->Cell(20,6,'NIK',1,0);

$pdf->Cell(30,6,'TELPON',1,0);

$pdf->Cell(35,6,'LAPORAN',1,0);
$pdf->Cell(39,6,'TANGGAPAN',1,1);


$pdf->SetFont('Arial','',10);
$no = 1;
$out = mysqli_query($koneksi, "SELECT * FROM tanggapan  inner join pengaduan ON tanggapan.id_pengaduan=pengaduan.id_pengaduan inner join masyarakat ON pengaduan.nik=masyarakat.nik where status='selesai'");
  while($keluar = mysqli_fetch_array($out)){
    $pdf->Cell(9,6,$no++,1,0);
    $pdf->Cell(20,6,$keluar['tgl_pengaduan'],1,0);
    $pdf->Cell(35,6,$keluar['nama'],1,0);
    $pdf->Cell(20,6,$keluar['nik'],1,0);
    $pdf->Cell(30,6,$keluar['telp'],1,0);
    $pdf->Cell(35,6,$keluar['isi_laporan'],1,0);
    $pdf->Cell(39,6,$keluar['tanggapan'],1,1);
  

}

  $pdf->Output();


?>