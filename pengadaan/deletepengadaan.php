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
$no_faktur = isset($_GET['no_faktur']) ? $_GET['no_faktur'] : '';

$que = 'select * from detail_pengadaan where no_faktur = "'.$no_faktur.'"';

foreach($masukpengadaan->Que($que) as $value){
    $cek_no_faktur = $value['no_faktur'];
}

if (empty($cek_no_faktur))
	{
		$que = 'DELETE FROM pengadaan_brg WHERE no_faktur="'.$no_faktur.'"';
		$masukpengadaan->Que($que);
	}
else
	{
		echo '<script type="text/javascript">confirm("Data detail pengadaan masih ada ")</script>';
	}
echo "<meta http-equiv='refresh' content='0;URL=pengadaan.php'>";
?>
Kembali ke : <a href="pengadaan.php">Home</a>
<?php include 'bot.html'; ?>