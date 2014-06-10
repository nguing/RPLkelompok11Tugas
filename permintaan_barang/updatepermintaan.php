<?php
session_start();
if(isset($_SESSION['username']))
	{
	
	}
else
	{
	header('location:../login.php');
	}
	
include 'top.php';
require( 'querypermintaan.php' );
$no_permintaan_barang = isset($_GET['no_permintaan_barang']) ? $_GET['no_permintaan_barang'] : '';

// tampilkan data berdasarkan where
$que = 'select * from permintaan_brg, user, unit_kerja where user.id_unit_kerja = unit_kerja.id_unit_kerja and permintaan_brg.kode_akun = user.kode_akun and no_permintaan_barang = "'.$no_permintaan_barang.'"';

foreach($masukpermintaan->Que($que) as $value){
    $no_permintaan_barang = $value['no_permintaan_barang'];
    $kode_akun = $value['kode_akun'];
	$status = $value['status'];
	$unit_kerja = $value['unit_kerja'];
	$keterangan = $value['keterangan'];
	$tanggal_permintaan_barang = $value['tanggal_permintaan_barang'];
	$nama_penanggungjawab = $value['nama_penanggungjawab'];
}
?>

<h1>Edit Data Permintaan Barang</h1>
<form action="updatepermintaan-proses.php" method="post">
  <table border="0" style="border-collapse:collapse;text-align:left;" class="table table-striped">
   <tr>
      <td>No Permintaan Barang</td>
      <td>:</td>
      <td><input type="text" class="form-control" name="no_permintaan_barang" value="<?php echo $no_permintaan_barang; ?>" readonly /></td>
    </tr>
    <tr>
      <td>Nama Penanggung Jawab</td>
      <td>:</td>
      <td>
	  <select name="kode_akun" class="form-control"> 
		<option value="<?php echo $kode_akun; ?>"><?php echo $unit_kerja; echo ' -- '; echo $nama_penanggungjawab; ?></option>
		  <?php 
			$que = "select * from user,unit_kerja where user.id_unit_kerja = unit_kerja.id_unit_kerja";
			foreach($masukpermintaan->Que($que) as $value){ 
		  ?>
			<option value="<?php echo $value['kode_akun']; ?>"><?php echo $value['unit_kerja']; echo ' -- '; echo $value['nama_penanggungjawab']; ?></option>
		  <?php } ?>       
      </select>
	  </td>
    </tr>		
    <tr>
      <td>Keterangan</td>
      <td>:</td>
      <td><input type="text" class="form-control" name="keterangan" value="<?php echo $keterangan; ?>" required pattern="[A-Za-z0-9 ]{1,}" /></td>
    </tr>	
    <tr>
      <td>Tanggal Pembuatan Permintaan Barang</td>
      <td>:</td>
      <td><input type="date" class="form-control" name="tanggal_permintaan_barang" value="<?php echo $tanggal_permintaan_barang; ?>" required pattern="[0-9]{1,}" /></td>
    </tr>
    <tr>
      <td  align="center" colspan="3"><input style="width:50%" type="submit" class="form-control" value="Update" name="Update" /></td>
    </tr>
  </table>
</form>
<?php include 'bot.html'; ?>