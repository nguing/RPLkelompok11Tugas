<?php
session_start();
if(isset($_SESSION['username']))
	{
	if ($_SESSION['role'] == "admin")
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
require( 'querypagu.php' );
?>	

	<script type="text/javascript">
			function hapus()
			{
				var hapus = confirm("Data Pagu Barang akan dihapus");
				
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
				var update = confirm("data Pagu Barang akan di update");
				
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
	
<h1>Input Pagu Barang</h1>
<form action="insertpagu.php" enctype="multipart/form-data" name="jenis_barang" method="post" >
  <table border="0" style="border-collapse:collapse;text-align:left;" class="table table-striped">
    <tr>
      <td>ID Pagu Barang</td>
      <td>:</td>
      <td><input type="text" class="form-control" name="id_pagu_barang" required pattern="[A-Za-z0-9]{1,30}"  /></td>
    </tr>
    <tr>
      <td>Nama Penanggung Jawab</td>
      <td>:</td>
      <td>
	  <select name="kode_akun_user" class="form-control"> 
		  <?php 
			$que = "select kode_akun,nama_penanggungjawab,unit_kerja  from user, unit_kerja where unit_kerja.id_unit_kerja = user.id_unit_kerja ";
			foreach($masukpagu->Que($que) as $value){ 
		  ?>
			<option value="<?php echo $value['kode_akun']; ?>"><?php echo $value['unit_kerja']; echo " -- "; echo $value['nama_penanggungjawab']; ?></option>
		  <?php } ?>       
      </select>
	  </td>
    </tr>
    <tr>
      <td align="center" colspan="3"><input style="width:50%" type="submit" class="form-control" value="Kirim" name="kirim" /></td>
    </tr>
  </table>
</form>



<br>
<br>
<h1>Daftar Pagu Barang</h1>
<table border="1" style="border-collapse:collapse;text-align:left;" class="table table-striped">
  <tr>
    <th>ID Pagu Barang</th>
    <th>Unit Kerja</th>	
    <th>Nama Penanggung Jawab</th>
    <th colspan="3">Action</th>
  </tr>

  <?php 
	$n=1;
	$que = "select * from pagu_brg, unit_kerja, user where kode_akun_user = kode_akun and unit_kerja.id_unit_kerja = user.id_unit_kerja";
	foreach($masukpagu->Que($que) as $value){ 
  ?>
  <tr>
    <td><?php echo $n; ?></td>
    <td><?php echo $value['unit_kerja']; ?></td>	
    <td><?php echo $value['nama_penanggungjawab']; ?></td>
    <td><a onclick="return update()" href="updatepagu.php?id_pagu_barang=<?php echo $value['id_pagu_barang']; ?>"><input type="button" class="form-control" value="Update"></a></td>
    <td><a onclick="return hapus()" href="deletepagu.php?id_pagu_barang=<?php echo $value['id_pagu_barang']; ?>"><input type="button" class="form-control" value="Delete"></a></td>
	<td><a href="detail_pagu/detail_pagu.php?id_pagu_barang=<?php echo $value['id_pagu_barang']; ?>"><input type="button" class="form-control" value="Detail Pagu Barang"></a></td>
  </tr>
  <?php $n++;} ?>
</table>
<?php include 'bot.html'; ?>