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
require( 'querypengadaan.php' );
$no_faktur				= isset($_POST['no_faktur']) ? $_POST['no_faktur'] : '';
$tanggal_pengadaan 		= isset($_POST['tanggal_pengadaan']) ? $_POST['tanggal_pengadaan'] : '';
$id_rekanan 			= isset($_POST['id_rekanan']) ? $_POST['id_rekanan'] : '';
$keterangan 			= isset($_POST['keterangan']) ? $_POST['keterangan'] : '';
// eksekusi class

$que = 'select * from pengadaan_brg,rekanan where pengadaan_brg.id_rekanan=rekanan.id_rekanan and no_faktur="'.$no_faktur.'"';

foreach($masukpengadaan->Que($que) as $value){
    $cek_no_faktur = $value['no_faktur'];
}

if (!$cek_no_faktur)
	{
		$querypenga ='INSERT INTO pengadaan_brg( no_faktur,tanggal_pengadaan,id_rekanan,keterangan ) VALUES( :no_faktur,:tanggal_pengadaan,:id_rekanan,:keterangan )';
		$masukpengadaan->Insertpengadaan($querypenga,$no_faktur,$tanggal_pengadaan,$id_rekanan,$keterangan);	
	}
else
	{
		echo '<script type="text/javascript">confirm("No. faktur yang dimasukan sudah ada")</script>';		
	}
echo "<meta http-equiv='refresh' content='0;URL=pengadaan.php'>";	
?>

Kembali ke : <a href="pengadaan.php">Home</a>
<?php include 'bot.html'; ?>