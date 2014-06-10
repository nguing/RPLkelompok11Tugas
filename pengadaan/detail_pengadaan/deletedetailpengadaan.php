<?php
session_start();
if(isset($_SESSION['username']))
	{
	if ($_SESSION['role'] == "gudang")
		{
		
		}
	else
		{
		header('location:../../index.php');
		}	
	}
else
	{
	header('location:../../login.php');
	}
	
include 'top.php';	
require( 'querydetailpengadaan.php' );
$id_detail_pengadaan = isset($_GET['id_detail_pengadaan']) ? $_GET['id_detail_pengadaan'] : '';
$no_faktur = isset($_GET['no_faktur']) ? $_GET['no_faktur'] : '';

$que = 'DELETE FROM detail_pengadaan WHERE id_detail_pengadaan="'.$id_detail_pengadaan.'"';
$masukdetailpengadaan->Que($que);
echo "<meta http-equiv='refresh' content='0;URL=detail_pengadaan.php?no_faktur=$no_faktur '>";
?>
Kembali ke : <a href="detail_pengadaan.php?no_faktur=<?php echo $no_faktur; ?>">Home</a>
<?php include 'bot.html'; ?>