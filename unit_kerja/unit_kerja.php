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
require( 'queryukerja.php' );
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
				var update = confirm("Data Barang akan di update");
				
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

<h1>Input Data Unit Kerja</h1>
<form action="insertukerja.php" enctype="multipart/form-data" name="barang" method="post" >
  <table border="0" style="border-collapse:collapse;text-align:left;" class="table table-striped">
    <tr>
      <td>ID Unit Kerja</td>
      <td>:</td>
      <td><input type="text" class="form-control" name="id_unit_kerja" required pattern="[A-Za-z0-9]{2,30}"  /></td>
    </tr>
    <tr>
      <td>Nama Unit Kerja</td>
      <td>:</td>
      <td><input type="text" class="form-control" name="unit_kerja" required pattern="[A-Za-z0-9 ]{2,30}" /></td>
    </tr>		
    <tr>
      <td align="center" colspan="3"><input style="width:50%" type="submit" class="form-control" value="Simpan" name="kirim" /></td>
    </tr>
  </table>
</form>

<br>
<br>
<h1>Daftar Unit Kerja</h1>
<table border="1" style="border-collapse:collapse;text-align:left;" class="table table-striped">
  <tr>
    <th>ID Unit Kerja</th>	
	<th>Nama Unit Kerja</th>	
    <th colspan="2"><p align="center">Action</p></th>
  </tr>

  <?php 
	$que = "select * from unit_kerja";
	foreach($masukunitkerja->Que($que) as $value){ 
  ?>
  <tr>
    <td><?php echo $value['id_unit_kerja']; ?></td>
    <td><?php echo $value['unit_kerja']; ?></td>
    <td><a onclick="return update()" href="updateukerja.php?id_unit_kerja=<?php echo $value['id_unit_kerja']; ?>"><input type="button" class="form-control" value="Update"></a></td>
    <td><a onclick="return hapus()" href="deleteukerja.php?id_unit_kerja=<?php echo $value['id_unit_kerja']; ?>"><input type="button" class="form-control" value="Delete"></a></td>
  </tr>
  <?php } ?>
</table>
<?php include 'bot.html'; ?>