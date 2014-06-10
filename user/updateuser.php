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
$kode_akun = isset($_GET['kode_akun']) ? $_GET['kode_akun'] : '';

// tampilkan data berdasarkan where
$que = 'SELECT * FROM user,unit_kerja WHERE kode_akun="'.$kode_akun.'" and user.id_unit_kerja=unit_kerja.id_unit_kerja';

foreach($masukuser->Que($que) as $value){
	$kode_akun = $value['kode_akun'];
    $username = $value['username'];
    $id_unit_kerja = $value['id_unit_kerja'];
	$unit_kerja = $value['unit_kerja'];
	$password = $value['password'];
	$nama_penanggungjawab = $value['nama_penanggungjawab'];
}
?>

<h1>Edit Alamat Penduduk</h1>
<form action="updateuser-proses.php" method="post">
  <table border="0" style="border-collapse:collapse;text-align:left;" class="table table-striped">
   <tr>
      <td>Username</td>
      <td>:</td>
      <td><input type="text" class="form-control" name="username" value="<?php echo $username; ?>" required pattern="[A-Za-z0-9 ]{1,}" /></td>
    </tr>
    <tr>
      <td>Nama Unit Kerja</td>
      <td>:</td>
      <td>
	  	  <select name="id_unit_kerja" class="form-control"> 
		  <option value="<?php echo $id_unit_kerja; ?>"><?php echo $unit_kerja; ?></option>
		  <?php 
			$que = "select id_unit_kerja,unit_kerja from unit_kerja";
			foreach($masukuser->Que($que) as $value){ 
		  ?>
			<option value="<?php echo $value['id_unit_kerja']; ?>"><?php echo $value['unit_kerja']; ?></option>
		  <?php } ?>       
      </select>
	  </td>
    </tr>		
    <tr>
      <td>Nama Penanggung Jawab</td>
      <td>:</td>
      <td><input type="text" class="form-control" name="nama_penanggungjawab" value="<?php echo $nama_penanggungjawab; ?>" required pattern="[A-Za-z0-9 ]{1,}" /></td>
    </tr>	
    <tr>
      <td align="center" colspan="3"><input type="submit" style="width:50%" class="form-control" value="Update" name="Update" /><input type="hidden" name="kode_akun" value="<?php echo $kode_akun; ?>" required readonly> </td>
    </tr>
  </table>
</form>
<?php include 'bot.html'; ?>