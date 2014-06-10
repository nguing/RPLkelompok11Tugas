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
require( 'queryrekan.php' );
?>
	<script type="text/javascript">
			function hapus()
			{
				var hapus = confirm("Data Rekanan akan dihapus");
				
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
				var update = confirm("Data Rekanan akan di update");
				
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
<h1>Input Data Rekanan</h1>
<form action="insertrekan.php" enctype="multipart/form-data" method="post" >
  <table border="0" style="border-collapse:collapse;text-align:left;" class="table table-striped">
    <tr>
      <td>ID Rekanan</td>
      <td>:</td>
      <td><input type="text" class="form-control" name="id_rekanan" required pattern="[A-Za-z0-9]{2,30}"  /></td>
    </tr>
    <tr>
      <td>Nama Rekanan</td>
      <td>:</td>
      <td><input type="text" class="form-control" name="rekanan" required pattern="[A-Za-z0-9 ]{2,}" /></td>
    </tr>
    <tr>
      <td>Contact Person</td>
      <td>:</td>
      <td><input type="text" class="form-control" name="telp" required pattern="[0-9]{2,}" /></td>
    </tr>
    <tr>
      <td>Alamat</td>
      <td>:</td>
      <td>
	  <textarea name="alamat" class="form-control" required pattern="[A-Za-z0-9 ]{2,}"></textarea>
	  </td>
    </tr>	
    <tr>
      <td align="center" colspan="3"><input style="width:50%" type="submit" class="form-control" value="Kirim" name="kirim" /></td>
    </tr>
  </table>
</form>


<br>
<br>
<h1>Daftar Rekanan</h1>
<table border="1" style="border-collapse:collapse;text-align:left;" class="table table-striped">
  <tr>
    <th>ID Rekanan</th>
    <th>Nama Rekanan</th>
	<th>Contact Person</th>
	<th>Alamat</th>
    <th colspan="2"><p align="center">Action</p></th>
  </tr>

  <?php 
	$que = "select * from rekanan";
	foreach($masukrekanan->Que($que) as $value){ 
  ?>
  <tr>
    <td><?php echo $value['id_rekanan']; ?></td>
    <td><?php echo $value['rekanan']; ?></td>
	<td><?php echo $value['telp']; ?></td>
	<td><?php echo $value['alamat']; ?></td>
    <td><a onclick="return update()" href="updaterekan.php?id_rekanan=<?php echo $value['id_rekanan']; ?>"><input type="button" class="form-control" value="Update"></a></td>
    <td><a onclick="return hapus()" href="deleterekan.php?id_rekanan=<?php echo $value['id_rekanan']; ?>"><input type="button" class="form-control" value="Delete"></a></td>
  </tr>
  <?php } ?>
</table>
<?php include 'bot.html'; ?>