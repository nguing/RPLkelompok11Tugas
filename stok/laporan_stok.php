<?php
session_start();
if(isset($_SESSION['username']))
	{
	
	}
else
	{
	header('location:../login.php');
	}
	
include 'top.php';
require( 'querylaporan.php' );
?>

<h1>Daftar Stok Barang</h1>
<a href="cetak_laporan_stok.php"> <input type="button" class="form-control" value="Print" name="kirim" /></a>
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

<?php include 'bot.html'; ?>