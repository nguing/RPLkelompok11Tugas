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
require( 'queryrekan.php' );
$id_rekanan		= isset($_POST['id_rekanan']) ? $_POST['id_rekanan'] : '';
$rekanan 		= isset($_POST['rekanan']) ? $_POST['rekanan'] : '';
$telp 			= isset($_POST['telp']) ? $_POST['telp'] : '';
$alamat 		= isset($_POST['alamat']) ? $_POST['alamat'] : '';
// eksekusi class

$que = 'SELECT * FROM rekanan WHERE id_rekanan="'.$id_rekanan.'"';

foreach($masukrekanan->Que($que) as $value){
    $cek_id_rekanan = $value['id_rekanan'];
}

if(!$cek_id_rekanan)
	{
		$queryrekan ='INSERT INTO rekanan( id_rekanan, rekanan, telp, alamat ) VALUES( :id_rekanan, :rekanan, :telp, :alamat )';
		$masukrekanan->Insertrekan($queryrekan,$id_rekanan,$rekanan,$telp,$alamat);	
	}
else
	{
		echo '<script type="text/javascript">confirm("Id_rekanan sudah ada")</script>';
	}
echo "<meta http-equiv='refresh' content='0;URL=rekanan.php'>";	
?>

Kembali ke : <a href="rekanan.php">Home</a>
<?php include 'bot.html'; ?>