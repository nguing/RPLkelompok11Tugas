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

$queryrekan = 'UPDATE rekanan SET rekanan=:rekanan, telp=:telp, alamat=:alamat WHERE id_rekanan=:id_rekanan';
$masukrekanan->Insertrekan($queryrekan,$id_rekanan,$rekanan,$telp,$alamat);
echo "<meta http-equiv='refresh' content='0;URL=rekanan.php'>";	
?>
Kembali ke : <a href="rekanan.php">Home</a>
<?php include 'bot.html'; ?>