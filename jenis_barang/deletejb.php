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
$id_jenis = isset($_GET['id_jenis']) ? $_GET['id_jenis'] : '';

$que = 'select * from barang where id_jenis_barang = "'.$id_jenis.'"';

foreach($masukjb->Que($que) as $value){
    $cek_id_jenis = $value['id_jenis_barang'];
}

if (empty($cek_id_jenis))
	{
		$que = 'DELETE FROM jenis_barang WHERE id_jenis="'.$id_jenis.'"';
		$masukjb->Que($que);
	}
else
	{
		echo '<script type="text/javascript">confirm("Data barang masih ada")</script>';
	}
echo "<meta http-equiv='refresh' content='0;URL=jenis_barang.php'>";	
?>
Kembali ke : <a href="jenis_barang.php">Home</a>
<?php include 'bot.html'; ?>