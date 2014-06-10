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
require( 'querypengadaan.php' );
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta http-equiv="content-type" content="text/html; charset=UTF-8">
		<meta charset="utf-8">
		<title>Inventory Fakultas Teknik Universitas Andalas</title>
		<meta name="generator" content="Bootply" />
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
		<link href="css/bootstrap.min.css" rel="stylesheet">
		<link href="css/font-awesome.min.css" rel="stylesheet">		
		
		<!--[if lt IE 9]>
			<script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script>
		<![endif]-->
		<link href="css/styles.css" rel="stylesheet">
	</head>
	<body>

  <div class="row">
  	<div class="col-sm-8 col-sm-offset-2 text-center">
	

<?php 
$no_faktur = isset($_GET['no_faktur']) ? $_GET['no_faktur'] : '';
//permintaan
$que = 'SELECT * FROM pengadaan_brg,rekanan where pengadaan_brg.id_rekanan = rekanan.id_rekanan and no_faktur = "'.$no_faktur.'"';

foreach($masukpengadaan->Que($que) as $value){
    $no_faktur = $value['no_faktur'];
	$rekanan = $value['rekanan'];
	$tanggal_pengadaan = $value['tanggal_pengadaan'];
	$keterangan = $value['keterangan'];
	
}
?>
 <script>
 window.load = print_d();
 function print_d(){
 window.print();
 }
 </script>
<div>
<table style="border-collapse:collapse;text-align:left;" class="table table-striped left">
    <tr>
      <td style="width:100px"><img src="css/unand.jpg"></img></td>
      <td>
		<h3>Universitas Andalas</h3>
		<h3>Dekanat Fakultas Teknik</h3>
		<h5>Limau Manih Padang</h5>
	  </td>
    </tr>
</table>
</div>

<h3>Faktur Pengadaan Barang</h3>
  <table style="border-collapse:collapse;text-align:left;" class="table">
    <tr>
      <td>Nomor Pengadaan Barang</td>
      <td>:</td>
      <td colspan="2"><?php echo $no_faktur; ?></td>
    </tr>
    <tr>
      <td>Tanggal Pembuatan Pengadaan</td>
      <td>:</td>
      <td colspan="2"><?php echo $tanggal_pengadaan; ?></td>
    </tr>
    <tr>
      <td>Nama Rekanan</td>
      <td>:</td>
      <td colspan="2">
		<?php echo $rekanan; ?>
	  </td>
    </tr>
    <tr>
      <td>Keterangan</td>
      <td>:</td>
      <td colspan="2">
	  <?php echo $keterangan; ?>
	  </td>
    </tr>	
</table>

<h4>Detail Permintaan Barang</h4>
<table style="border-collapse:collapse;text-align:left;" class="table">			
    <tr>
      <td>Nomor</td>
      <td>ID Barang</td>
      <td>Nama Barang</td>
	  <td>Jumlah</td>	
	  <td>Harga</td>  
	  <td>Jumlah</td>
    </tr>	
	
<?php
//detail permintaan
	$n=1;
 	$que = "SELECT * FROM pengadaan_brg,detail_pengadaan,barang where barang.id_brg = detail_pengadaan.id_brg and  pengadaan_brg.no_faktur = detail_pengadaan.no_faktur  and detail_pengadaan.no_faktur ='".$no_faktur."'";
	foreach($masukpengadaan->Que($que) as $value){ 
	$id_detail_permintaan = $value['id_detail_pengadaan'];
    $id_brg = $value['id_brg'];
	$nama_barang = $value['nama_barang'];
	$jumlah = $value['jumlah'];
	$harga_brg = $value['harga_brg'];
	echo 	"
			<tr>  
			  <td>".$n."</td>
			  <td>".$id_brg."</td>
			  <td>".$nama_barang."</td>
			  <td>".$jumlah."</td>	  
			  <td>".$harga_brg."</td>
			  <td>".$jumlah * $harga_brg."</td>	 
			</tr>	
			";
	$n++;
	}
?>	
 </table>
    </div>
  </div>
	<!-- script references -->
		<script src="js/jquery.min.js"></script>
		<script src="js/bootstrap.min.js"></script>
		<script src="js/scripts.js"></script>
	</body>
</html>