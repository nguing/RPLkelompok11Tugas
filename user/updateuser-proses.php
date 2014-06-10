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
$username 				= isset($_POST['username']) ? $_POST['username'] : '';
$id_unit_kerja			= isset($_POST['id_unit_kerja']) ? $_POST['id_unit_kerja'] : '';
$nama_penanggungjawab	= isset($_POST['nama_penanggungjawab']) ? $_POST['nama_penanggungjawab'] : '';

$queryupuser = 'UPDATE user SET username=:username,id_unit_kerja=:id_unit_kerja,nama_penanggungjawab=:nama_penanggungjawab WHERE kode_akun=:kode_akun';
$masukuser->Updateuser($queryupuser,$kode_akun,$username,$id_unit_kerja,$nama_penanggungjawab);
echo "<meta http-equiv='refresh' content='0;URL=user.php'>";	
?>
Kembali ke : <a href="user.php">Home</a>
<?php include 'bot.html'; ?>