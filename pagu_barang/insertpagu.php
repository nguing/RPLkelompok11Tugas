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
$id_pagu_barang 		= isset($_POST['id_pagu_barang']) ? $_POST['id_pagu_barang'] : '';
$kode_akun_user 		= isset($_POST['kode_akun_user']) ? $_POST['kode_akun_user'] : '';
// eksekusi class

$que = 'SELECT * FROM pagu_brg, unit_kerja, user WHERE kode_akun_user = kode_akun and unit_kerja.id_unit_kerja = user.id_unit_kerja and id_pagu_barang="'.$id_pagu_barang.'"';

foreach($masukpagu->Que($que) as $value){
    $cek_kode_akun_user = $value['kode_akun_user'];
}

if(empty($cek_kode_akun_user))
	{
		$querypagu ='INSERT INTO pagu_brg( id_pagu_barang, kode_akun_user ) VALUES( :id_pagu_barang, :kode_akun_user )';
		$masukpagu->Insertpagu($querypagu,$id_pagu_barang,$kode_akun_user);	
	}
else
	{
		echo '<script type="text/javascript">confirm("data pagu yang dimasukan sudah ada")</script>';
	}
echo "<meta http-equiv='refresh' content='0;URL=pagu_barang.php'>";	
?>

Kembali ke : <a href="pagu_barang.php">Home</a>
<?php include 'bot.html'; ?>