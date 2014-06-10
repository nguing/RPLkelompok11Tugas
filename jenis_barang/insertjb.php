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
$id_jenis 		= isset($_POST['id_jenis']) ? $_POST['id_jenis'] : '';
$jenis_brg 		= isset($_POST['jenis_brg']) ? $_POST['jenis_brg'] : '';
// eksekusi class

$que = 'SELECT * FROM jenis_barang WHERE id_jenis="'.$id_jenis.'"';

foreach($masukjb->Que($que) as $value){
    $cek_id_jenis = $value['id_jenis'];
}

if(!$cek_id_jenis)
	{
		$queryjbrg ='INSERT INTO jenis_barang( id_jenis, jenis_brg ) VALUES( :id_jenis, :jenis_brg )';
		$masukjb->Insertjb($queryjbrg,$id_jenis,$jenis_brg);	
	}
else
	{
		echo '<script type="text/javascript">confirm("Data id jenis sudah ada")</script>';
	}
echo "<meta http-equiv='refresh' content='0;URL=jenis_barang.php'>";	
?>

Kembali ke : <a href="jenis_barang.php">Home</a>
<?php include 'bot.html'; ?>