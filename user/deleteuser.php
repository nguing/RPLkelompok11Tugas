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

require( 'queryuser.php' );
$kode_akun = isset($_GET['kode_akun']) ? $_GET['kode_akun'] : '';

$que = 'DELETE FROM user WHERE kode_akun="'.$kode_akun.'"';
$masukuser->Que($que);
echo "<meta http-equiv='refresh' content='0;URL=user.php'>";	
?>
Kembali ke : <a href="user.php">Home</a>
<?php include 'bot.html'; ?>