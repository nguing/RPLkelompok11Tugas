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
$id_pagu_barang 	= isset($_POST['id_pagu_barang']) ? $_POST['id_pagu_barang'] : '';
$kode_akun_user 	= isset($_POST['kode_akun_user']) ? $_POST['kode_akun_user'] : '';

$querypagu = 'UPDATE pagu_brg SET kode_akun_user=:kode_akun_user WHERE id_pagu_barang=:id_pagu_barang';
$masukpagu->Insertpagu($querypagu,$id_pagu_barang,$kode_akun_user);
echo "<meta http-equiv='refresh' content='0;URL=pagu_barang.php'>";	
?>
Kembali ke : <a href="pagu_barang.php">Home</a>
<?php include 'bot.html'; ?>