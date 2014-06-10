<?php
session_start();
if(isset($_SESSION['username']))
	{
	
	}
else
	{
	header('location:../../login.php');
	}
	
include 'top.php';
require( 'querydetailpermintaan.php' );
$no_permintaan_barang = isset($_GET['no_permintaan_barang']) ? $_GET['no_permintaan_barang'] : '';

// tampilkan data berdasarkan where
$que = 'select * from permintaan_brg, user, unit_kerja where user.id_unit_kerja = unit_kerja.id_unit_kerja and permintaan_brg.kode_akun = user.kode_akun and no_permintaan_barang = "'.$no_permintaan_barang.'"';

foreach($masukdetailpermintaan->Que($que) as $value){
    $unit_kerja = $value['unit_kerja'];
	$status = $value['status'];
	$nama_penanggungjawab = $value['nama_penanggungjawab'];
	$keterangan = $value['keterangan'];
	$tanggal_permintaan_barang = $value['tanggal_permintaan_barang'];
}
?>

<br>
<h1>Faktur Permintaan Barang</h1>
  <table style="border-collapse:collapse;text-align:left;" class="table table-striped">
    <tr>
      <td>Nomor Permintaan Barang</td>
      <td>:</td>
      <td><?php echo $no_permintaan_barang; ?></td>
    </tr>
    <tr>
      <td>Tanggal Pembuatan Permintaan</td>
      <td>:</td>
      <td><?php echo $tanggal_permintaan_barang; ?></td>
    </tr>
    <tr>
      <td>Nama Penanggung Jawab</td>
      <td>:</td>
      <td>
		<?php echo $nama_penanggungjawab; ?>
	  </td>
    </tr>
    <tr>
      <td>Nama Unit Kerja</td>
      <td>:</td>
      <td>
	  <?php echo $unit_kerja; ?>
	  </td>
    </tr>	
    <tr>
      <td>Keterangan</td>
      <td>:</td>
      <td>
	  <?php echo $keterangan; ?>
	  </td>
    </tr>		
 </table>

 <?php
$id_detail_permintaan = isset($_GET['id_detail_permintaan']) ? $_GET['id_detail_permintaan'] : '';

// tampilkan data berdasarkan where
$que = 'select * from detail_permintaan,barang where detail_permintaan.id_brg=barang.id_brg and id_detail_permintaan="'.$id_detail_permintaan.'"';

foreach($masukdetailpermintaan->Que($que) as $value){
    $id_detail_permintaan = $value['id_detail_permintaan'];
    $id_barang = $value['id_brg'];
	$jumlah = $value['jumlah'];
	$nama_brg = $value['nama_barang'];
}
?>
 
<br>
<br>
<h1>Edit Data Detail PErmintaan</h1>
<form action="updatedetailpermintaan-proses.php" enctype="multipart/form-data" method="post" >
<table border="1" style="border-collapse:collapse;text-align:left;" class="table table-striped">
  <tr>
    <th>Nama Barang</th>
    <th>Jumlah</th>
	<th>Action</th>
  </tr>
  <tr>
    <th>
	<select name="id_brg" class="form-control"> 
	<option value="<?php echo $id_barang; ?>"><?php echo $id_barang; ?> -- <?php echo $nama_brg; ?></option>
		  <?php 
			$que = "select id_brg, nama_barang from barang";
			foreach($masukdetailpermintaan->Que($que) as $value){ 
		  ?>
			<option value="<?php echo $value['id_brg']; ?>"><?php echo $value['id_brg']; echo " -- "; echo $value['nama_barang']; ?></option>
		  <?php } ?>       
    </select>
	</th>
    <th><input type="text" class="form-control" name="jumlah" value="<?php echo $jumlah; ?>" required pattern="[0-9]{1,30}" /></th>
	<th><input type="submit" class="form-control" value="Update" name="kirim" /><input  type="hidden" value="<?php echo $no_permintaan_barang; ?>" name="no_permintaan_barang" required/><input type="hidden" value="<?php echo $id_detail_permintaan; ?>" name="id_detail_permintaan" required/></th>
  </tr>
</table>
 </form> 
<?php include 'bot.html'; ?>