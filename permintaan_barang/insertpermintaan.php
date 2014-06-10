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

// eksekusi class

$que = 'select * from permintaan_brg, user, unit_kerja where user.id_unit_kerja = unit_kerja.id_unit_kerja and permintaan_brg.kode_akun = user.kode_akun and no_permintaan_barang = "'.$no_permintaan_barang.'"';

foreach($masukpermintaan->Que($que) as $value){
    $cek_no_permintaan_barang = $value['no_permintaan_barang'];
}

if(!$cek_no_permintaan_barang)
	{
		$queryperminta ='INSERT INTO permintaan_brg( no_permintaan_barang,kode_akun,keterangan,tanggal_permintaan_barang ) VALUES(:no_permintaan_barang,:kode_akun,:keterangan,:tanggal_permintaan_barang )';
		$masukpermintaan->Insertpermintaan($queryperminta,$no_permintaan_barang,$kode_akun,$keterangan,$tanggal_permintaan_barang);	
	}
else
	{
		echo '<script type="text/javascript">confirm("No_permintaan_barang sudah ada")</script>';
		echo "cek_no_permintaan_barang sudah ada";
	}
echo "<meta http-equiv='refresh' content='0;URL=permintaan.php'>";	
?>

Kembali ke : <a href="permintaan.php">Home</a>
<?php include 'bot.html'; ?>