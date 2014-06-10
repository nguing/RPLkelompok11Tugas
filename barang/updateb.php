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
require( 'queryb.php' );
$id_brg = isset($_GET['id_brg']) ? $_GET['id_brg'] : '';

// tampilkan data berdasarkan where
$que = 'SELECT * FROM barang,jenis_barang WHERE id_brg="'.$id_brg.'" and barang.id_jenis_barang=jenis_barang.id_jenis';

foreach($masukb->Que($que) as $value){
    $id_brg = $value['id_brg'];
	$barcode = $value['barcode'];
    $nama_barang = $value['nama_barang'];
	$id_jenis_barang = $value['id_jenis_barang'];
	$jenis_brg = $value['jenis_brg'];
	$satuan = $value['satuan'];
}
?>

<b>Edit Alamat Penduduk</b>
<form action="updateb-proses.php" method="post">
  <table border="0" class="table">
   <tr>
      <td>ID Barang</td>
      <td>:</td>
      <td><input type="text" class="form-control" name="id_barang" value="<?php echo $id_brg; ?>" readonly /></td>
    </tr>
   <tr>
      <td>Barcode Barang</td>
      <td>:</td>
      <td><input type="text" class="form-control" name="barcode" value="<?php echo $barcode; ?>" /></td>
    </tr>	
    <tr>
      <td>Nama Barang</td>
      <td>:</td>
      <td><input type="text" class="form-control" name="nama_barang" value="<?php echo $nama_barang; ?>" required pattern="[A-Za-z0-9 ]{2,30}" /></td>
    </tr>		
    <tr>
      <td>Nama Jenis Barang</td>
      <td>:</td>
      <td>
	  <select name="id_jenis_barang" class="form-control"> 
		<option value="<?php echo $id_jenis_barang; ?>"><?php echo $id_jenis_barang; ?> -- <?php echo $jenis_brg; ?></option>
		  <?php 
			$que = "select id_jenis,jenis_brg from jenis_barang ";
			foreach($masukb->Que($que) as $value){ 
		  ?>
			<option value="<?php echo $value['id_jenis']; ?>"><?php echo $value['id_jenis']; echo " -- "; echo $value['jenis_brg']; ?></option>
		  <?php } ?>       
      </select>
	  </td>
    </tr>
    <tr>
      <td>Satuan</td>
      <td>:</td>
      <td><input type="text" class="form-control" name="satuan" value="<?php echo $satuan; ?>" required pattern="[A-Za-z0-9 ]{1,}" /></td>
    </tr>	
    <tr>
      <td align="center" colspan="3"><input style="width:50%" type="submit" class="form-control" value="Update" name="Update" /></td>
    </tr>
  </table>
</form>
  <?php include 'bot.html'; ?>