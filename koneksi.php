<?php
    $conn = mysqli_connect("localhost", "root", "", "pengaduan");
    if (!$conn){
        die("Gagal Terhubung ". mysqli_connect_error());
    }

date_default_timezone_set('Asia/jakarta');
$tgl = date('Y-m-d');
	function ajukan($nik, $path, $filename, $isis)
{
	global $conn;
	global $tgl;
	$isi = htmlspecialchars($isis);
	$spam = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM pengaduan WHERE nik='$nik' and tgl_pengaduan='$tgl'"));
	if($spam > 0){
		header("Location:?berhasil=maxsend");
	}else{
		$adukan = mysqli_query($conn, "INSERT INTO pengaduan (tgl_pengaduan, nik, isi_laporan, foto, status) VALUES ('$tgl', '$nik', '$isi', '$filename', '1')") or die ("<h1>ILEGAL TEXT DETECTED !</h1><b>TERJADI KESALAHAN PADA SISTEM HARAP HUBUNGI ADMINISTRATOR</b>");
		$isi_notifikasi = "Pengaduan anda telah Berhasil dikirim dan segera diproses oleh Petugas.";
		$send_notif = mysqli_query($conn, "INSERT INTO notifikasi (nik, notifikasi, tgl) VALUES ('$nik', '$isi_notifikasi', '$tgl')");
			header("Location:?berhasil=ajukan");
			
	}
	return $adukan;
}
	function register_petugas($namas, $usrnms, $passs, $telps, $levels)
	{
		global $conn;
		$nama =	htmlspecialchars($namas);
		$usrnm = htmlspecialchars($usrnms);
		$pass = htmlspecialchars($passs);
		$telp = htmlspecialchars($telps);
		$level = htmlspecialchars($levels);
		$cekduplikatuser = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM masyarakat WHERE username='$usrnm'"));
		$cekduplikatuserpro = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM petugas WHERE username='$usrnm'"));
		if($cekduplikatuser > 0){
			header("Location:?berhasil=duplikat&username=$usrnm");
		}elseif($cekduplikatuserpro > 0){
			header("Location:?berhasil=duplikat&username=$usrnm");
		}else{
			$register = mysqli_query($conn, "INSERT INTO petugas (nama_petugas, username, password, telp, role) VALUES ('$nama', '$usrnm', '$pass', '$telp', '$level')") or die ("<h1>ILEGAL TEXT DETECTED !</h1><b>TERJADI KESALAHAN PADA SISTEM HARAP HUBUNGI ADMINISTRATOR</b>");
			header("Location:?berhasil=register");
		}
		return $register;
	}
    function tanggapi($id_pengaduan, $tanggapan, $nik, $nama_petugas_tanggapan)
{
	global $conn;
	global $tgl;
	
	$id_petugas = $_SESSION['id_petugas'];

echo $nik;
	$cekduplikat = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM tanggapan WHERE id_pengaduan='$id_pengaduan'"));
	if($cekduplikat > 0){
		header("Location:?tanggapi=$id_pengaduan&berhasil=duplikat");
	}else{
		$masukan_tanggapan = mysqli_query($conn, "INSERT INTO tanggapan (id_pengaduan, tgl_tanggapan, tanggapan, id_petugas) values ('$id_pengaduan', '$tgl', '$tanggapan', '$id_petugas')") or die ("<h1>ILEGAL TEXT DETECTED !</h1><b>TERJADI KESALAHAN PADA SISTEM HARAP HUBUNGI ADMINISTRATOR</b>");
		$update_status = mysqli_query($conn, "UPDATE pengaduan set status='proses' where id_pengaduan='$id_pengaduan'");
		$isi_notifikasi = "Pengaduan anda dengan ID: ".$id_pengaduan." telah ditanggapi oleh Petugas.";
		$send_notif = mysqli_query($conn, "INSERT INTO notifikasi (nik, notifikasi, tgl) VALUES ('$nik', '$isi_notifikasi', '$tgl')");
		header("Location:?tanggapi=$id_pengaduan&berhasil=tanggapi");
	}
}
function proses_selesai($id, $nik)
{
	global $conn;
	global $tgl;
	$proses = mysqli_query($conn, "UPDATE pengaduan set status='selesai' where id_pengaduan='$id'") or die ("Terjadi Kesalahan");
	$isi_notifikasi = "Pengaduan anda dengan ID: ".$id." telah Selesai diproses.";
	$send_notif = mysqli_query($conn, "INSERT INTO notifikasi (nik, notifikasi, tgl) VALUES ('$nik', '$isi_notifikasi', '$tgl')");
	header("Location:?berhasil=proses_oke");
	return $proses;
}
function hapus_pengaduan($id)
{
	global $conn;
	$hapus_tanggapan = mysqli_query($conn, "DELETE FROM tanggapan where id_pengaduan='$id' ") or die ("Terjadi Kesalahan");
	$hapus_pengaduan = mysqli_query($conn, "DELETE FROM pengaduan where id_pengaduan='$id' ") or die ("Terjadi Kesalahan");
	header("Location:?berhasil=proses_hapus");
	return $hapus_tanggapan;
	return $hapus_pengaduan;
}
function hapus_petugas($id)
{
	global $conn;
	$hapus_tanggapan = mysqli_query($conn, "DELETE FROM petugas where id_petugas='$id' ") or die ("Terjadi Kesalahan");

	header("Location:?berhasil=proses_hapus");
	return $hapus_tanggapan;
}

function hapus_masyarakat($id)
{
	global $conn;
	$hapus_tanggapan = mysqli_query($conn, "DELETE FROM masyarakat where nik='$id' ") or die ("Terjadi Kesalahan");

	header("Location:?berhasil=proses_hapus");
	return $hapus_tanggapan;
}
function nonaktif($id)
{
	global $conn;
	$nonaktifkan_petugas = mysqli_query($conn, "UPDATE petugas set role='nonaktif' where id_petugas='$id'") or die ("Terjadi Kesalahan");
	header("Location:?berhasil=proses_hapus");
	return $nonaktifkan_petugas;
}
function non($id)
{
	global $conn;
	$nonaktifkan_petugas = mysqli_query($conn, "UPDATE masyarakat set role='nonaktif' where nik='$id'") or die ("Terjadi Kesalahan");
	header("Location:?berhasil=proses_hapus");
	return $nonaktifkan_petugas;
}
function proses($id)
{
	global $conn;
	$nonaktifkan_petugas = mysqli_query($conn, "UPDATE pengaduan set status='proses' where id_pengaduan='$id'") or die ("Terjadi Kesalahan");
	header("Location:pengaduan.php?berhasil=sip");
	return $nonaktifkan_petugas;
}
function aktifkan($id)
{
	global $conn;
	$nonaktifkan_petugas = mysqli_query($conn, "UPDATE petugas set role='petugas' where id_petugas='$id'") or die ("Terjadi Kesalahan");
	header("Location:?berhasil=proses_hapus");
	return $nonaktifkan_petugas;
}
function ap($id)
{
	global $conn;
	$nonaktifkan_petugas = mysqli_query($conn, "UPDATE masyarakat set role='masyarakat' where nik='$id'") or die ("Terjadi Kesalahan");
	header("Location:?berhasil=proses_hapus");
	return $nonaktifkan_petugas;
}
function ubah_data_petugas($id_petugas, $nama, $username, $password, $telp, $role)
{
	global $conn;
	if(empty($password)){
		$update = mysqli_query($conn, "UPDATE petugas set nama_petugas='$nama', username='$username', telp='$telp', role='$role' WHERE id_petugas='$id_petugas' ");
	}else{
		$update = mysqli_query($conn, "UPDATE petugas set nama_petugas='$nama', username='$username', password='$password', telp='$telp', role='$role' WHERE id_petugas='$id_petugas' ");
	}
	if($update){
		header("Location:?berhasil=proses_ubah");	
	}
	return $update;
}
function ubah_masyarakat($id_petugas, $nama, $username, $password, $telp)
{
	global $conn;
	if(empty($password)){
		$update = mysqli_query($conn, "UPDATE masyarakat set nama='$nama', username='$username', telp='$telp' WHERE nik='$id_petugas' ");
	}else{
		$update = mysqli_query($conn, "UPDATE masyarakat set nama='$nama', username='$username', password='$password', telp='$telp' WHERE nik='$id_petugas' ");
	}
	if($update){
		header("Location:?berhasil=proses_ubah");	
	}
	return $update;
}
function update_data_view($id_petugas)
{	
	global $conn;
	$upd = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM petugas WHERE id_petugas='$id_petugas' "));
	$_SESSION['data_petugas'] = $upd;
	return $upd;
}
function ubah_tanggapan($id, $tanggapan, $status)
{
	global $conn;
	
		$update = mysqli_query($conn, "UPDATE tanggapan inner join pengaduan ON tanggapan.id_pengaduan=pengaduan.id_pengaduan inner join masyarakat ON pengaduan.nik=masyarakat.nik set tanggapan='$tanggapan', status='$status' where status='selesai' and id_tanggapan='$id' ") or die ("Terjadi Kesalahan");
	
	
		header("Location:?berhasil=proses_ubah");	
	
	return $update;
}
function update_data_view_user($nik)
{	
	global $conn;
	$upd = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM masyarakat WHERE nik='$nik' "));
	$_SESSION['data_user'] = $upd;
	return $upd;
}
function ubah_profil($id, $nama, $telp)
{
	global $conn;
	$cek = mysqli_query($conn, "SELECT * FROM petugas WHERE id_petugas='$id' ");
	$auth = mysqli_num_rows($cek);
	if($auth > 0){
		mysqli_query($conn, "UPDATE petugas set nama_petugas='$nama', telp='$telp' WHERE id_petugas='$id'");
		
		header("Location:?berhasil=proses_ubah");
	}else{
		header("Location:?berhasil=keynotvalid");
	}

}
function ubah_profil_user($nik, $nama, $telp)
{
	global $conn;
	$cek = mysqli_query($conn, "SELECT * FROM masyarakat WHERE nik='$nik'");
	$auth = mysqli_num_rows($cek);
	if($auth > 0){
		mysqli_query($conn, "UPDATE masyarakat set nama='$nama', telp='$telp' WHERE nik='$nik'");
	
		header("Location:?berhasil=proses_ubah");
	}else{
		header("Location:?berhasil=keynotvalid");
	}

}
function ubah_pass($id_petugas, $pw1, $pw2)
{
	global $conn;
	$cek = mysqli_query($conn, "SELECT * FROM petugas WHERE id_petugas='$id_petugas' ");
	$auth = mysqli_num_rows($cek);
	if($auth > 0){
		if($pw1==$pw2){
			mysqli_query($conn, "UPDATE petugas set password='$pw2' WHERE id_petugas='$id_petugas'");
			header("Location:?page=pass&berhasil=passoke");
		}else{
			header("Location:?page=pass&berhasil=konf");
		}
	}else{
		header("Location:?page=pass&berhasil=keynotvalid");
	}
}
function ubah_pass_user($nik, $pw1, $pw2, $pass_now)
{
	global $conn;
	$cek = mysqli_query($conn, "SELECT * FROM masyarakat WHERE nik='$nik' ");
	$auth = mysqli_num_rows($cek);
	if($auth > 0){
		if($pw1==$pw2){
			mysqli_query($conn, "UPDATE masyarakat set password='$pw2' WHERE nik='$nik'");
			header("Location:?page=pass&berhasil=passoke");
		}else{
			header("Location:?page=pass&berhasil=konf");	
		}
	}else{
		header("Location:?page=pass&berhasil=keynotvalid");
	}
}
?>

