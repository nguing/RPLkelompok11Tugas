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
$id_unit_kerja = isset($_GET['id_unit_kerja']) ? $_GET['id_unit_kerja'] : '';

$que = 'select * from user where id_unit_kerja = "'.$id_unit_kerja.'"';

foreach($masukunitkerja->Que($que) as $value){
    $cek_id_unit_kerja = $value['id_unit_kerja'];
}

if (empty($cek_id_unit_kerja))
	{
		$que = 'DELETE FROM unit_kerja WHERE id_unit_kerja="'.$id_unit_kerja.'"';
		$masukunitkerja->Que($que);
	}
else
	{
		echo '<script type="text/javascript">confirm("Data user masih ada ")</script>';
	}
echo "<meta http-equiv='refresh' content='0;URL=unit_kerja.php'>";	
?>
Kembali ke : <a href="unit_kerja.php">Home</a>
<?php include 'bot.html'; ?>