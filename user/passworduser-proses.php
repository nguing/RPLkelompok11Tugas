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
$kode_akun 				= isset($_POST['kode_akun']) ? $_POST['kode_akun'] : '';
$pass					= isset($_POST['password']) ? $_POST['password'] : '';
$repeat_pass			= isset($_POST['repeat_password']) ? $_POST['repeat_password'] : '';
$password 				= base64_encode("$pass");
$repeat_password 		= base64_encode("$repeat_pass");

if($password == $repeat_password)
	{
	$queryuppwuser = 'UPDATE user SET password=:password WHERE kode_akun=:kode_akun';
	$masukuser->Updatepwuser($queryuppwuser,$kode_akun,$password);
	}
else
	{
	echo '<script type="text/javascript">confirm("password dan repeat_password tidak sama")</script>';
	}
echo "<meta http-equiv='refresh' content='0;URL=user.php'>";	
?>
Kembali ke : <a href="user.php">Home</a>
<?php include 'bot.html'; ?>