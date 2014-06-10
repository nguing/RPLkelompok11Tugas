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
$no_pengeluaran_barang 			= isset($_POST['no_pengeluaran_barang']) ? $_POST['no_pengeluaran_barang'] : '';
$no_permintaan_barang 			= isset($_POST['no_permintaan_barang']) ? $_POST['no_permintaan_barang'] : '';
$keterangan						= isset($_POST['keterangan']) ? $_POST['keterangan'] : '';
$tanggal_pengeluaran			= isset($_POST['tanggal_pengeluaran_barang']) ? $_POST['tanggal_pengeluaran_barang'] : '';

// eksekusi class

$que = 'select no_pengeluaran_barang,pengeluaran_brg.no_permintaan_barang,unit_kerja,nama_penanggungjawab,pengeluaran_brg.keterangan as keterangan_pengeluaran,tanggal_pengeluaran from pengeluaran_brg, permintaan_brg, user, unit_kerja where user.id_unit_kerja = unit_kerja.id_unit_kerja and permintaan_brg.kode_akun = user.kode_akun and pengeluaran_brg.no_permintaan_barang = permintaan_brg.no_permintaan_barang and no_pengeluaran_barang = "'.$no_pengeluaran_barang.'"';

foreach($masukpengeluaran->Que($que) as $value){
    $cek_no_permintaan_barang = $value['no_permintaan_barang'];
}

if(!$cek_no_permintaan_barang)
	{
		$querypengeluar ='INSERT INTO pengeluaran_brg( no_pengeluaran_barang,no_permintaan_barang,keterangan,tanggal_pengeluaran ) VALUES(:no_pengeluaran_barang,:no_permintaan_barang,:keterangan,:tanggal_pengeluaran )';
		$masukpengeluaran->Insertpengeluaran($querypengeluar,$no_pengeluaran_barang,$no_permintaan_barang,$keterangan,$tanggal_pengeluaran);	
	}
else
	{
		echo '<script type="text/javascript">confirm("No permintaan barang sudah ada")</script>';
	}
echo "<meta http-equiv='refresh' content='0;URL=pengeluaran.php'>";	
?>

Kembali ke : <a href="pengeluaran.php">Home</a>
<?php include 'bot.html'; ?>