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
	$kode_akun 		= $value['kode_akun'];
    $username 		= $value['username'];
    $id_unit_kerja 	= $value['id_unit_kerja'];
	$unit_kerja 	= $value['unit_kerja'];
	$pass 			= $value['password'];
	$nama_penanggungjawab = $value['nama_penanggungjawab'];
	$role 			= $value['role'];
	$password 		= base64_decode("$pass");
}
?>

<h1>Data User</h1>
  <table border="1" style="border-collapse:collapse;text-align:left;" class="table table-striped">
   <tr>
      <td>Username</td>
      <td>:</td>
      <td><?php echo $username; ?></td>
    </tr>
   <tr>
      <td>Password</td>
      <td>:</td>
      <td><?php echo $password; ?></td>
    </tr>	
    <tr>
      <td>Nama Unit Kerja</td>
      <td>:</td>
      <td><?php echo $unit_kerja; ?>
	  </td>
    </tr>		
    <tr>
      <td>Nama Penanggung Jawab</td>
      <td>:</td>
      <td><?php echo $nama_penanggungjawab; ?></td>
    </tr>
    <tr>
      <td>Role</td>
      <td>:</td>
      <td><?php echo $role; ?></td>
    </tr>	
  </table>
  
 <h1>Ubah Password</h1>
	<form action="passworduser-proses.php" enctype="multipart/form-data" name="barang" method="post" >
	  <table border="0" style="border-collapse:collapse;text-align:left;" class="table table-striped">
		<tr>
		  <td> Ubah Password</td>
		  <td>:</td>
		  <td><input type="password" class="form-control" name="password" required pattern="[A-Za-z0-9 ]{1,}" /></td>
		</tr>
		<tr>
		  <td>Repeat Password</td>
		  <td>:</td>
		  <td><input type="password" class="form-control" name="repeat_password" required pattern="[A-Za-z0-9 ]{1,}" /></td>
		</tr>		
		<tr>
		  <td align="center" colspan="3"><input style="width:50%" type="submit" class="form-control" value="Simpan" name="kirim" /><input type="hidden" name="kode_akun" value="<?php echo $kode_akun; ?>" required readonly></td>
		</tr>
	  </table>
	</form> 
<?php include 'bot.html'; ?>