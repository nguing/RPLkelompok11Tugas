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
require( 'querypengeluaran.php' );
 
$no_pengeluaran_barang = isset($_GET['no_pengeluaran_barang']) ? $_GET['no_pengeluaran_barang'] : '';

$que = 'select * from detail_pengeluaran where no_pengeluaran = "'.$no_pengeluaran_barang.'"';

foreach($masukpengeluaran->Que($que) as $value){
    $cek_no_pengeluaran_barang = $value['no_pengeluaran'];
}

if (empty($cek_no_pengeluaran_barang))
	{
		$que = 'DELETE FROM pengeluaran_brg WHERE no_pengeluaran_barang="'.$no_pengeluaran_barang.'"';
		$masukpengeluaran->Que($que);
	}
else
	{
		echo '<script type="text/javascript">confirm("Data detail pengeluaran masih ada ")</script>';
		echo "masih ada data detail pengeluaran";
	}

echo "<meta http-equiv='refresh' content='0;URL=pengeluaran.php'>";
?>
Kembali ke : <a href="pengeluaran.php">Home</a>
<?php include 'bot.html'; ?>