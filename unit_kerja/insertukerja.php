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
require( 'queryukerja.php' );
$id_unit_kerja 		= isset($_POST['id_unit_kerja']) ? $_POST['id_unit_kerja'] : '';
$unit_kerja 		= isset($_POST['unit_kerja']) ? $_POST['unit_kerja'] : '';
// eksekusi class

$que = 'SELECT * FROM unit_kerja WHERE id_unit_kerja="'.$id_unit_kerja.'"';

foreach($masukunitkerja->Que($que) as $value){
    $cek_id_unit_kerja = $value['id_unit_kerja'];
}

if(!$cek_id_unit_kerja)
	{
		$queryukerja ='INSERT INTO unit_kerja( id_unit_kerja, unit_kerja ) VALUES( :id_unit_kerja, :unit_kerja )';
		$masukunitkerja->Insertukerja($queryukerja,$id_unit_kerja,$unit_kerja);	
	}
else
	{
		echo '<script type="text/javascript">confirm("Id_unit_kerja sudah ada")</script>';
	}
echo "<meta http-equiv='refresh' content='0;URL=unit_kerja.php'>";		
?>

Kembali ke : <a href="unit_kerja.php">Home</a>
<?php include 'bot.html'; ?>