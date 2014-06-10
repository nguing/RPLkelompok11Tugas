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
require( 'queryb.php' );
$id_brg 			= isset($_POST['id_barang']) ? $_POST['id_barang'] : '';
$barcode 			= isset($_POST['barcode']) ? $_POST['barcode'] : '';
$nama_barang		= isset($_POST['nama_barang']) ? $_POST['nama_barang'] : '';
$id_jenis_barang	= isset($_POST['id_jenis_barang']) ? $_POST['id_jenis_barang'] : '';
$satuan				= isset($_POST['satuan']) ? $_POST['satuan'] : '';

$querybrg = 'UPDATE barang SET nama_barang=:nama_barang,id_jenis_barang=:id_jenis_barang,satuan=:satuan,barcode=:barcode WHERE id_brg=:id_brg';

$masukb->Insertb($querybrg,$id_brg,$id_jenis_barang,$satuan,$nama_barang,$barcode);
echo "<meta http-equiv='refresh' content='0;URL=barang.php'>";	
?>
Kembali ke : <a href="barang.php">Home</a>
<?php include 'bot.html'; ?>