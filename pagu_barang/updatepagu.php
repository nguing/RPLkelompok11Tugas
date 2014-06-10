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
$id_pagu_barang = isset($_GET['id_pagu_barang']) ? $_GET['id_pagu_barang'] : '';

// tampilkan data berdasarkan where
$que = 'SELECT * FROM pagu_brg, unit_kerja, user WHERE kode_akun_user = kode_akun and unit_kerja.id_unit_kerja = user.id_unit_kerja and id_pagu_barang="'.$id_pagu_barang.'"';

foreach($masukpagu->Que($que) as $value){
    $kode_akun_user = $value['kode_akun_user'];
	$unit_kerja = $value['unit_kerja'];
	$nama_penanggungjawab = $value['nama_penanggungjawab'];
}
?>

<h1>Edit Data Pagu Barang</h1>
<form action="updatepagu-proses.php" method="post">
  <table border="0" class="table table-striped">
    <tr>
      <td>ID Pagu Barang</td>
      <td>:</td>
      <td><input type="text" class="form-control" readonly value="<?php echo $id_pagu_barang; ?>" name="id_pagu_barang" /></td>
    </tr>
    <tr>
      <td>Nama Penanggung Jawab</td>
      <td>:</td>
      <td>
	  <select name="kode_akun_user" class="form-control"> 
		<option value="<?php echo $kode_akun_user; ?>"><?php echo $unit_kerja; echo " -- "; echo $nama_penanggungjawab; ?></option>
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
      <td align="center" colspan="3"><input style="width:50%" type="submit" class="form-control" value="Update" name="Update" /></td>
    </tr>
  </table>
</form>
<?php include 'bot.html'; ?>