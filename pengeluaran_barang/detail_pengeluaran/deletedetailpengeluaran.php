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
require( 'querydetailpengeluaran.php' );
$id_detail_pengeluaran = isset($_GET['id_detail_pengeluaran']) ? $_GET['id_detail_pengeluaran'] : '';
$no_pengeluaran_barang = isset($_GET['no_pengeluaran_barang']) ? $_GET['no_pengeluaran_barang'] : '';

$que = 'DELETE FROM detail_pengeluaran WHERE id_detail_pengeluaran="'.$id_detail_pengeluaran.'"';
$masukdetailpengeluaran->Que($que);
echo "<meta http-equiv='refresh' content='0;URL=detail_pengeluaran.php?no_pengeluaran_barang=$no_pengeluaran_barang'>";	
?>
Kembali ke : <a href="detail_pengeluaran.php?no_pengeluaran_barang=<?php echo $no_pengeluaran_barang; ?>">Home</a>
<?php include 'bot.html'; ?>