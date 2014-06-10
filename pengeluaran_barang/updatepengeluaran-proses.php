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
require( 'querypengeluaran.php' );
$no_pengeluaran_barang 			= isset($_POST['no_pengeluaran_barang']) ? $_POST['no_pengeluaran_barang'] : '';
$no_permintaan_barang 			= isset($_POST['no_permintaan_barang']) ? $_POST['no_permintaan_barang'] : '';
$keterangan						= isset($_POST['keterangan']) ? $_POST['keterangan'] : '';
$tanggal_pengeluaran			= isset($_POST['tanggal_pengeluaran']) ? $_POST['tanggal_pengeluaran'] : '';

$querypengeluar = 'UPDATE pengeluaran_brg SET no_permintaan_barang=:no_permintaan_barang,keterangan=:keterangan,tanggal_pengeluaran=:tanggal_pengeluaran WHERE no_pengeluaran_barang=:no_pengeluaran_barang';
$masukpengeluaran->Insertpengeluaran($querypengeluar,$no_pengeluaran_barang,$no_permintaan_barang,$keterangan,$tanggal_pengeluaran);
echo "<meta http-equiv='refresh' content='0;URL=pengeluaran.php'>";
?>
Kembali ke : <a href="pengeluaran.php">Home</a>
<?php include 'bot.html'; ?>