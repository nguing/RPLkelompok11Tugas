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
require( 'queryjb.php' );
?>
	<script type="text/javascript">
			function hapus()
			{
				var hapus = confirm("Data Jenis Barang akan dihapus");
				
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
				var update = confirm("Data Jenis Barang akan di update");
				
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
<h1>Input Jenis Barang</h1>
<form action="insertjb.php" enctype="multipart/form-data" name="jenis_barang" method="post" >
  <table border="0" class="table table-striped">
    <tr>
      <td>ID Jenis Barang</td>
      <td>:</td>
      <td><input type="text" class="form-control" name="id_jenis" required pattern="[A-Za-z0-9]{2,30}"  /></td>
    </tr>
    <tr>
      <td>Nama Jenis Barang</td>
      <td>:</td>
      <td><input type="text" class="form-control" name="jenis_brg" required pattern="[A-Za-z0-9 ]{2,}" /></td>
    </tr>
    <tr>
      <td align="center" colspan="3"><input type="submit" class="form-control" style="width:50%" value="Kirim" name="kirim" /></td>
    </tr>
  </table>
</form>

<br>
<br>
<h1>Daftar Jenis Barang</h1>
<table border="1" style="border-collapse:collapse;text-align:left;" class="table table-striped">
  <tr>
    <th>ID Jenis Barang</th>
    <th>Nama Jenis Barang</th>
    <th colspan="2">Action</th>
  </tr>

  <?php 
	$que = "select * from jenis_barang";
	foreach($masukjb->Que($que) as $value){ 
  ?>
  <tr>
    <td><?php echo $value['id_jenis']; ?></td>
    <td><?php echo $value['jenis_brg']; ?></td>
    <td><a onclick="return update()" href="updatejb.php?id_jenis=<?php echo $value['id_jenis']; ?>"><input type="button" class="form-control" value="Update"></a></td>
    <td><a onclick="return hapus()" href="deletejb.php?id_jenis=<?php echo $value['id_jenis']; ?>"><input type="button" class="form-control" value="Delete"></a></td>
  </tr>
  <?php } ?>
</table>

<?php include 'bot.html'; ?>