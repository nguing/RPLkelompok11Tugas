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

// eksekusi class

$que = "select id_brg from barang where id_brg = '".$id_brg."'";


foreach($masukb->Que($que) as $value){
    $cek_id_brg = $value['id_brg'];
}


if (empty($cek_id_brg))
	{
		$querybrg ='INSERT INTO barang( id_brg,id_jenis_barang,satuan,nama_barang,barcode ) VALUES( :id_brg,:id_jenis_barang,:satuan,:nama_barang,:barcode )';
		$masukb->Insertb($querybrg,$id_brg,$id_jenis_barang,$satuan,$nama_barang,$barcode);	
	}
else
	{
		echo '<script type="text/javascript">confirm("Kode barang sudah ada")</script>';
	}
	
echo "<meta http-equiv='refresh' content='0;URL=barang.php'>";	
?>

Kembali ke : <a href="barang.php">Home</a>

<?php include 'bot.html'; ?>