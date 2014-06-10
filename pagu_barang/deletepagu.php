<?php
session_start();
if(isset($_SESSION['username']))
	{
	if ($_SESSION['role'] == "admin")
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
require( 'querypagu.php' );
$id_pagu_barang = isset($_GET['id_pagu_barang']) ? $_GET['id_pagu_barang'] : '';

$que = 'select * from detail_pagu where id_pagu_barang = "'.$id_pagu_barang.'"';

foreach($masukpagu->Que($que) as $value){
    $cek_id_pagu_barang = $value['id_pagu_barang'];
}

if (empty($cek_id_pagu_barang))
	{
		$que = 'DELETE FROM pagu_brg WHERE id_pagu_barang="'.$id_pagu_barang.'"';
		$masukpagu->Que($que);
	}
else
	{
		echo '<script type="text/javascript">confirm("Data detail pagu masih ada")</script>';
	}
echo "<meta http-equiv='refresh' content='0;URL=pagu_barang.php'>";	
?>
Kembali ke : <a href="pagu_barang.php">Home</a>
<?php include 'bot.html'; ?>