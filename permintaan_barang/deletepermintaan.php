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
 
$no_permintaan_barang = isset($_GET['no_permintaan_barang']) ? $_GET['no_permintaan_barang'] : '';

$que = 'select * from detail_permintaan where no_permintaan_barang = "'.$no_permintaan_barang.'"';

foreach($masukpermintaan->Que($que) as $value){
    $cek_no_permintaan_barang = $value['no_permintaan_barang'];
}

if (empty($cek_no_permintaan_barang))
	{
		$que = 'DELETE FROM permintaan_brg WHERE no_permintaan_barang="'.$no_permintaan_barang.'"';
		$masukpermintaan->Que($que);
	}
else
	{
		echo '<script type="text/javascript">confirm("masih ada data detail permintaan")</script>';
	}
echo "<meta http-equiv='refresh' content='0;URL=permintaan.php'>";	
?>
Kembali ke : <a href="permintaan.php">Home</a>
<?php include 'bot.html'; ?>