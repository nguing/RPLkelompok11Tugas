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
require( 'querypengeluaran.php' );
$no_pengeluaran_barang = isset($_GET['no_pengeluaran_barang']) ? $_GET['no_pengeluaran_barang'] : '';

// tampilkan data berdasarkan where
$que = 'select no_pengeluaran_barang,pengeluaran_brg.no_permintaan_barang,unit_kerja,nama_penanggungjawab,pengeluaran_brg.keterangan as keterangan_pengeluaran,tanggal_pengeluaran from pengeluaran_brg, permintaan_brg, user, unit_kerja where user.id_unit_kerja = unit_kerja.id_unit_kerja and permintaan_brg.kode_akun = user.kode_akun and pengeluaran_brg.no_permintaan_barang = permintaan_brg.no_permintaan_barang and no_pengeluaran_barang = "'.$no_pengeluaran_barang.'"';

foreach($masukpengeluaran->Que($que) as $value){
    $no_permintaan_barang = $value['no_permintaan_barang'];
	$unit_kerja = $value['unit_kerja'];
	$keterangan = $value['keterangan_pengeluaran'];
	$tanggal_pengeluaran = $value['tanggal_pengeluaran'];
	$nama_penanggungjawab = $value['nama_penanggungjawab'];
}
?>

<h1>Edit Data Pengeluaran Barang</h1>
<form action="updatepengeluaran-proses.php" method="post">
  <table style="border-collapse:collapse;text-align:left;" class="table table-striped">
    <tr>
      <td>No Pengeluaran Barang</td>
      <td>:</td>
      <td><input type="text" class="form-control" name="no_pengeluaran_barang" value="<?php echo $no_pengeluaran_barang; ?>" readonly /></td>
    </tr> 
    <tr>
      <td>Nomor Permintaan Barang</td>
      <td>:</td>
      <td>
	  <select name="no_permintaan_barang" class="form-control"> 
	  <option value="<?php echo $no_permintaan_barang; ?>"><?php echo $no_permintaan_barang; echo ' -- '; echo $unit_kerja; echo ' -- '; echo $nama_penanggungjawab; ?></option>
		  <?php 
			$que = "select * from permintaan_brg,user,unit_kerja where user.id_unit_kerja = unit_kerja.id_unit_kerja and user.kode_akun = permintaan_brg.kode_akun";
			foreach($masukpengeluaran->Que($que) as $value){ 
		  ?>
			<option value="<?php echo $value['no_permintaan_barang']; ?>"><?php echo $value['no_permintaan_barang']; echo ' -- '; echo $value['unit_kerja']; echo ' -- '; echo $value['nama_penanggungjawab']; ?></option>
		  <?php } ?>       
      </select>
	  </td>
    </tr>		
    <tr>
      <td>Keterangan</td>
      <td>:</td>
      <td><input type="text" class="form-control" name="keterangan" value="<?php echo $keterangan; ?>" required pattern="[A-Za-z0-9]{1,}" /></td>
    </tr>	
    <tr>
      <td>Tanggal Pembuatan Pengeluaran Barang</td>
      <td>:</td>
      <td><input type="date" class="form-control" name="tanggal_pengeluaran" value="<?php echo $tanggal_pengeluaran; ?>" required /></td>
    </tr>
    <tr>
      <td align="center" colspan="3"><input style="width:50%" type="submit" class="form-control" value="Update" name="Update" /></td>
    </tr>
  </table>
</form>
<?php include 'bot.html'; ?>