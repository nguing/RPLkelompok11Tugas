<?php
session_start();
if(isset($_SESSION['username']))
	{
	
	}
else
	{
	header('location:../login.php');
	}
?>

 <script>
 window.load = print_d();
 function print_d(){
 window.print();
 }
 </script>
<?php
require( 'querylaporan.php' );
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

<h1>Daftar Stok Barang</h1>
<br>
<table border="1" style="border-collapse:collapse;text-align:left;" class="table table-striped">
  <tr>
	<th style="width:30px">No.</th>	
    <th>ID Barang</th>	  
    <th>Nama Barang</th>	
	<th>Stok</th>	
  </tr>

  <?php 
	$n=1;
	$que = "			
			SELECT 
			a.id_brg, a.nama_barang, (SELECT COALESCE(SUM(jumlah), 0) 
			FROM detail_pengadaan d 
			WHERE d.id_brg = a.id_brg) 
			- 
			(SELECT COALESCE(SUM(jumlah), 0) 
			FROM detail_pengeluaran e 
			WHERE e.id_brg = a.id_brg) AS stok 

			FROM barang a LEFT JOIN detail_pengadaan b 
			ON a.id_brg = b.id_brg 
			LEFT JOIN detail_pengeluaran c 
			ON a.id_brg = c.id_brg 
			GROUP BY a.id_brg
			";
	foreach($masuklaporan->Que($que) as $value){ 
  ?>
  <tr>
	<td><?php echo $n; ?></td> 
    <td><?php echo $value['id_brg']; ?></td> 
    <td><?php echo $value['nama_barang']; ?></td>
    <td><?php echo $value['stok'];?></td>
  </tr>
  <?php $n++;} ?>
</table>
	<!-- script references -->
		<script src="js/jquery.min.js"></script>
		<script src="js/bootstrap.min.js"></script>
		<script src="js/scripts.js"></script>
	</body>
</html>