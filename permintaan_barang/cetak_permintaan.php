<?php
session_start();
if(isset($_SESSION['username']))
	{
	
	}
else
	{
	header('location:../login.php');
	}
require( 'querypermintaan.php' );
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
$no_permintaan_barang = isset($_GET['no_permintaan_barang']) ? $_GET['no_permintaan_barang'] : '';
//permintaan
$que = 'select * from permintaan_brg, user, unit_kerja where user.id_unit_kerja = unit_kerja.id_unit_kerja and permintaan_brg.kode_akun = user.kode_akun and no_permintaan_barang = "'.$no_permintaan_barang.'"';

foreach($masukpermintaan->Que($que) as $value){
    $unit_kerja = $value['unit_kerja'];
	$nama_penanggungjawab = $value['nama_penanggungjawab'];
	$keterangan = $value['keterangan'];
	$tanggal_permintaan_barang = $value['tanggal_permintaan_barang'];
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

<h3>Faktur Permintaan Barang</h3>
  <table style="border-collapse:collapse;text-align:left;" class="table">
    <tr>
      <td>Nomor Permintaan Barang</td>
      <td>:</td>
      <td colspan="2"><?php echo $no_permintaan_barang; ?></td>
    </tr>
    <tr>
      <td>Tanggal Pembuatan Permintaan</td>
      <td>:</td>
      <td colspan="2"><?php echo $tanggal_permintaan_barang; ?></td>
    </tr>
    <tr>
      <td>Nama Penanggung Jawab</td>
      <td>:</td>
      <td colspan="2">
		<?php echo $nama_penanggungjawab; ?>
	  </td>
    </tr>
    <tr>
      <td>Nama Unit Kerja</td>
      <td>:</td>
      <td colspan="2">
	  <?php echo $unit_kerja; ?>
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
    </tr>	
	
<?php
//detail permintaan
	$n=1;
 	$que = "select * from detail_permintaan,barang where barang.id_brg=detail_permintaan.id_brg and detail_permintaan.no_permintaan_barang='".$no_permintaan_barang."'";
	foreach($masukpermintaan->Que($que) as $value){ 
	$id_detail_permintaan = $value['id_detail_permintaan'];
    $id_brg = $value['id_brg'];
	$nama_barang = $value['nama_barang'];
	$jumlah = $value['jumlah'];
	echo 	"
			<tr>  
			  <td>".$id_detail_permintaan."</td>
			  <td>".$id_brg."</td>
			  <td>".$nama_barang."</td>
			  <td>".$jumlah."</td>	  
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