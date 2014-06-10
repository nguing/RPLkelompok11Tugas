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
$username 				= isset($_POST['username']) ? $_POST['username'] : '';
$id_unit_kerja			= isset($_POST['id_unit_kerja']) ? $_POST['id_unit_kerja'] : '';
$pass					= isset($_POST['password']) ? $_POST['password'] : '';
$repeat_pass			= isset($_POST['repeat_password']) ? $_POST['repeat_password'] : '';
$nama_penanggungjawab	= isset($_POST['nama_penanggungjawab']) ? $_POST['nama_penanggungjawab'] : '';
$password 				= base64_encode("$pass");
$repeat_password 		= base64_encode("$repeat_pass");

$que = 'SELECT * FROM user,unit_kerja WHERE username="'.$username.'"';

foreach($masukuser->Que($que) as $value){
	$cek_username = $value['username'];
}

// eksekusi class

if(!$cek_username)
	{
	if ($password == $repeat_password)
		{
		$que = 'SELECT * FROM unit_kerja,user WHERE user.id_unit_kerja = unit_kerja.id_unit_kerja and user.id_unit_kerja="'.$id_unit_kerja.'"';

		foreach($masukuser->Que($que) as $value){
			$cek_id_unit_kerja = $value['id_unit_kerja'];
		}		
		
		if($cek_id_unit_kerja != $id_unit_kerja)
		{
			$queryuser ='INSERT INTO user( username,id_unit_kerja,password,nama_penanggungjawab ) VALUES( :username,:id_unit_kerja,:password,:nama_penanggungjawab )';
			$masukuser->Insertuser($queryuser,$username,$id_unit_kerja,$password,$nama_penanggungjawab);		
		}
		else
		{
		echo "Unit Kerja sudah mempunyai akun";
		}

		}
	else
		{
		echo "password dan repeat password tidak sama";
		}	
	}
else
	{
		echo "username sudah ada";
	}
echo "<meta http-equiv='refresh' content='0;URL=user.php'>";	
?>

Kembali ke : <a href="user.php">Home</a>
<?php include 'bot.html'; ?>