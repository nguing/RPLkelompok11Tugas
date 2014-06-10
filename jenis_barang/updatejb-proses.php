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
require( 'queryjb.php' );
$id_jenis 	= isset($_POST['id_jenis']) ? $_POST['id_jenis'] : '';
$jenis_brg 	= isset($_POST['jenis_brg']) ? $_POST['jenis_brg'] : '';

$queujb = 'UPDATE jenis_barang SET jenis_brg=:jenis_brg WHERE id_jenis=:id_jenis';
$masukjb->Updatesavejb($queujb,$id_jenis,$jenis_brg);
echo "<meta http-equiv='refresh' content='0;URL=jenis_barang.php'>";	
?>
Kembali ke : <a href="jenis_barang.php">Home</a>
<?php include 'bot.html'; ?>