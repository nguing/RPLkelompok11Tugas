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
?>





	<script type="text/javascript">
			function hapus()
			{
				var hapus = confirm("Data Barang akan dihapus");
				
				if(hapus==true)
				{
					return(true);
				}
				else
				{
					return(false);
				}
			}
													
			function update()
			{
				var update = confirm("data Barang akan di update");
				
				if(update==true)
				{
					return(true);
				}
				else
				{
					return(false);
				}
			}	
	</script>
<h1>Input Data Barang</h1>
<br>
<form action="insertb.php" enctype="multipart/form-data" name="barang" method="post" >
  <table border="0" class="table table-striped">
    <tr>
      <td align="left" >ID Barang</td>
      <td>:</td>
      <td><input type="text" class="form-control" name="id_barang" required pattern="[A-Za-z0-9]{2,30}"  /></td>
    </tr>
    <tr>
      <td align="left" >Barcode Barang</td>
      <td>:</td>
      <td><input type="text" class="form-control" name="barcode" pattern="[A-Za-z0-9]{2,30}"  /></td>
    </tr>	
    <tr>
      <td align="left">Nama Barang</td>
      <td>:</td>
      <td><input type="text" class="form-control" name="nama_barang" required pattern="[A-Za-z0-9 ]{2,30}" /></td>
    </tr>		
    <tr>
      <td align="left">Nama Jenis Barang</td>
      <td>:</td>
      <td>
	  <select name="id_jenis_barang" class="form-control"> 
		  <?php 
			$que = "select id_jenis,jenis_brg from jenis_barang";
			foreach($masukb->Que($que) as $value){ 
		  ?>
			<option value="<?php echo $value['id_jenis']; ?>"><?php echo $value['id_jenis']; echo " -- "; echo $value['jenis_brg']; ?></option>
		  <?php } ?>       
      </select>
	  </td>
    </tr>
    <tr>
      <td align="left">Satuan</td>
      <td>:</td>
      <td><input type="text" class="form-control" name="satuan" required pattern="[A-Za-z0-9 ]{1,}" /></td>
    </tr>	
    <tr>
      <td align="center" colspan="3"><input style="width:50%" type="submit" class="form-control" value="Kirim" name="kirim" /></td>
    </tr>
  </table>
</form>

<br>
<br>
<h1>Daftar Jenis Barang</h1>
<br>
<table border="1" style="border-collapse:collapse;text-align:left;" class="table table-striped">
  <tr>
    <th>ID Barang</th>	
	<th>Barcode Barang</th>	
	<th>Nama Barang</th>	
	<th>Jenis Barang</th>
	<th>Satuan</th>
    <th colspan="2"><p align="center">Action</p></th>
  </tr>

<?php 
	$que = "select * from barang, jenis_barang where barang.id_jenis_barang=jenis_barang.id_jenis";
	foreach($masukb->Que($que) as $value){ 
?>
  <tr>
    <td><?php echo $value['id_brg']; ?></td>
	<td><?php echo $value['barcode']; ?></td>
    <td><?php echo $value['nama_barang']; ?></td>
	<td><?php echo $value['jenis_brg']; ?></td>
	<td><?php echo $value['satuan']; ?></td>
    <td align="center"><a onclick="return update()" href="updateb.php?id_brg=<?php echo $value['id_brg']; ?>"><input type="button" class="form-control" value="Update"></a></td>
    <td align="center"><a onclick="return hapus()" href="deleteb.php?id_brg=<?php echo $value['id_brg']; ?>"><input type="button" class="form-control" value="Delete"></a></td>
  </tr>
<?php } ?>
</table>
<?php include 'bot.html'; ?>
