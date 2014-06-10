<?php
session_start();
if(isset($_SESSION['username']))
	{
	
	}
else
	{
	header('location:../../login.php');
	}
	
include 'top.php';
require( 'querydetailpermintaan.php' );
$id_detail_permintaan = isset($_GET['id_detail_permintaan']) ? $_GET['id_detail_permintaan'] : '';
$no_permintaan_barang = isset($_GET['no_permintaan_barang']) ? $_GET['no_permintaan_barang'] : '';

$que = 'DELETE FROM detail_permintaan WHERE id_detail_permintaan="'.$id_detail_permintaan.'"';
$masukdetailpermintaan->Que($que);
echo "<meta http-equiv='refresh' content='0;URL=detail_permintaan.php?no_permintaan_barang=$no_permintaan_barang'>";	
?>
Kembali ke : <a href="detail_permintaan.php?no_permintaan_barang=<?php echo $no_permintaan_barang; ?>">Home</a>
<?php include 'bot.html'; ?>