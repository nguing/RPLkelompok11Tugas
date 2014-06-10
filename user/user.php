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

require( 'queryuser.php' );
?>

	<script type="text/javascript">
			function hapus()
			{
				var hapus = confirm("Data User akan dihapus");
				
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
				var update = confirm("Data user akan di update");
				
				if(update==true)
				{
					return(true);
				}
				else
				{
					return(false);
				}
			}	
			
			function pw()
			{
				var pw = confirm("Password user akan di update");
				
				if(pw==true)
				{
					return(true);
				}
				else
				{
					return(false);
				}
			}				
	</script>

<h1>Input User</h1>
<form action="insertuser.php" enctype="multipart/form-data" name="barang" method="post" >
  <table border="0" style="border-collapse:collapse;text-align:left;" class="table table-striped">
    <tr>
      <td>Username</td>
      <td>:</td>
      <td><input type="text" class="form-control" name="username" required pattern="[A-Za-z0-9]{2,30}"  /></td>
    </tr>
    <tr>
      <td>Nama Unit kerja</td>
      <td>:</td>
      <td>
	  <select name="id_unit_kerja" class="form-control"> 
		  <?php 
			$que = "select id_unit_kerja,unit_kerja from unit_kerja";
			foreach($masukuser->Que($que) as $value){ 
		  ?>
			<option value="<?php echo $value['id_unit_kerja']; ?>"><?php echo $value['id_unit_kerja']; echo " -- "; echo $value['unit_kerja']; ?></option>
		  <?php } ?>       
      </select>
	  </td>
    </tr>		
    <tr>
      <td>Password</td>
      <td>:</td>
      <td><input type="password" class="form-control" name="password" required pattern="[A-Za-z0-9 ]{1,}" /></td>
    </tr>
    <tr>
      <td>Repeat Password</td>
      <td>:</td>
      <td><input type="password" class="form-control" name="repeat_password" required pattern="[A-Za-z0-9 ]{1,}" /></td>
    </tr>	
    <tr>
      <td>Nama Penanggung Jawab</td>
      <td>:</td>
      <td><input type="text" class="form-control" name="nama_penanggungjawab" required pattern="[A-Za-z0-9 ]{2,30}"  /></td>
    </tr>	
    <tr>
      <td align="center" colspan="3"><input style="width:50%" type="submit" class="form-control" value="Simpan" name="kirim" /></td>
    </tr>
  </table>
</form>

<br>
<br>
<h1>Daftar User</h1>
<table border="1" style="border-collapse:collapse;text-align:left;" class="table table-striped">
  <tr>
    <th>Username</th>	
	<th>Nama Unit Kerja</th>	
	<th>Nama Penanggung Jawab</th>
    <th colspan="3"><p align="center">Action</p></th>
  </tr>

  <?php 
	$que = "select * from user, unit_kerja where user.id_unit_kerja=unit_kerja.id_unit_kerja";
	foreach($masukuser->Que($que) as $value){ 
  ?>
  <tr>
    <td><?php echo $value['username']; ?></td>
	<td><?php echo $value['unit_kerja']; ?></td>
	<td><?php echo $value['nama_penanggungjawab']; ?></td>
    <td><a onclick="return update()" href="updateuser.php?kode_akun=<?php echo $value['kode_akun']; ?>"><input type="button" class="form-control" value="Update"></a></td>
    <td><a onclick="return hapus()" href="deleteuser.php?kode_akun=<?php echo $value['kode_akun']; ?>"><input type="button" class="form-control" value="Delete"></a></td>
	<td><a onclick="return pw()" href="passworduser.php?kode_akun=<?php echo $value['kode_akun']; ?>"><input type="button" class="form-control" value="Ubah Password"></a></td>
  </tr>
  <?php } ?>
</table>
<?php include 'bot.html'; ?>