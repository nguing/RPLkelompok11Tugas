<?php
session_start();
if(isset($_SESSION['username']))
	{
	if ($_SESSION['role'] == "gudang")
		{
		
		}
	else
		{
		header('location:../index.php');
		}	
	}
else
	{
	header('location:../login.php');
	}
	
include 'top.php';
require( 'querypengadaan.php' );
$no_faktur				= isset($_POST['no_faktur']) ? $_POST['no_faktur'] : '';
$tanggal_pengadaan 		= isset($_POST['tanggal_pengadaan']) ? $_POST['tanggal_pengadaan'] : '';
$id_rekanan 			= isset($_POST['id_rekanan']) ? $_POST['id_rekanan'] : '';
$keterangan 			= isset($_POST['keterangan']) ? $_POST['keterangan'] : '';

$querypenga = 'UPDATE pengadaan_brg SET tanggal_pengadaan=:tanggal_pengadaan, id_rekanan=:id_rekanan, keterangan=:keterangan WHERE no_faktur=:no_faktur';
$masukpengadaan->Insertpengadaan($querypenga,$no_faktur,$tanggal_pengadaan,$id_rekanan,$keterangan);
echo "<meta http-equiv='refresh' content='0;URL=pengadaan.php'>";
?>
Kembali ke : <a href="pengadaan.php">Home</a>
<?php include 'bot.html'; ?>