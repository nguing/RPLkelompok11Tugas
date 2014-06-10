<?php
session_start();
if(isset($_SESSION['username']))
	{
	
	}
else
	{
	header('location:../login.php');
	}
	
include 'top.php';
require( 'querypermintaan.php' );
$no_permintaan_barang 			= isset($_POST['no_permintaan_barang']) ? $_POST['no_permintaan_barang'] : '';
$kode_akun						= isset($_POST['kode_akun']) ? $_POST['kode_akun'] : '';
$keterangan						= isset($_POST['keterangan']) ? $_POST['keterangan'] : '';
$tanggal_permintaan_barang		= isset($_POST['tanggal_permintaan_barang']) ? $_POST['tanggal_permintaan_barang'] : '';

$queryperminta = 'UPDATE permintaan_brg SET kode_akun=:kode_akun,keterangan=:keterangan,tanggal_permintaan_barang=:tanggal_permintaan_barang WHERE no_permintaan_barang=:no_permintaan_barang';
$masukpermintaan->Insertpermintaan($queryperminta,$no_permintaan_barang,$kode_akun,$keterangan,$tanggal_permintaan_barang);
echo "<meta http-equiv='refresh' content='0;URL=permintaan.php'>";	
?>
Kembali ke : <a href="permintaan.php">Home</a>
<?php include 'bot.html'; ?>