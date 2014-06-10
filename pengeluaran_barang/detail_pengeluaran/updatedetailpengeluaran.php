<?php
session_start();
if(isset($_SESSION['username']))
	{
	if ($_SESSION['role'] == "gudang")
		{
		
		}
	else
		{
		header('location:../../index.php');
		}	
	}
else
	{
	header('location:../../login.php');
	}
	
include 'top.php';
require( 'querydetailpengeluaran.php' );
$no_pengeluaran_barang = isset($_GET['no_pengeluaran_barang']) ? $_GET['no_pengeluaran_barang'] : '';

// tampilkan data berdasarkan where
$que = 'select no_pengeluaran_barang,pengeluaran_brg.no_permintaan_barang,unit_kerja,nama_penanggungjawab,pengeluaran_brg.keterangan as keterangan_pengeluaran,tanggal_pengeluaran from pengeluaran_brg, permintaan_brg, user, unit_kerja where user.id_unit_kerja = unit_kerja.id_unit_kerja and permintaan_brg.kode_akun = user.kode_akun and pengeluaran_brg.no_permintaan_barang = permintaan_brg.no_permintaan_barang and no_pengeluaran_barang = "'.$no_pengeluaran_barang.'"';

foreach($masukdetailpengeluaran->Que($que) as $value){
    $no_permintaan_barang = $value['no_permintaan_barang'];
	$unit_kerja = $value['unit_kerja'];
	$nama_penanggungjawab = $value['nama_penanggungjawab'];
	$keterangan = $value['keterangan_pengeluaran'];
	$tanggal_pengeluaran = $value['tanggal_pengeluaran'];
}
?>

<h1>Faktur Pengeluaran Barang</h1>
  <table border="1" style="border-collapse:collapse;text-align:left;" class="table table-striped">
    <tr>
      <td>Nomor Pengeluaran Barang</td>
      <td>:</td>
      <td><?php echo $no_pengeluaran_barang; ?></td>
    </tr>  
    <tr>
      <td>Nomor Permintaan Barang</td>
      <td>:</td>
      <td><?php echo $no_permintaan_barang; ?></td>
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
      <td>Tanggal Pengeluaran</td>
      <td>:</td>
      <td><?php echo $tanggal_pengeluaran; ?></td>
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
$id_detail_pengeluaran = isset($_GET['id_detail_pengeluaran']) ? $_GET['id_detail_pengeluaran'] : '';

// tampilkan data berdasarkan where
$que = 'select * from detail_pengeluaran,barang where detail_pengeluaran.id_brg=barang.id_brg and id_detail_pengeluaran="'.$id_detail_pengeluaran.'"';

foreach($masukdetailpengeluaran->Que($que) as $value){
    $id_detail_pengeluaran = $value['id_detail_pengeluaran'];
    $id_barang = $value['id_brg'];
	$jumlah = $value['jumlah'];
	$nama_brg = $value['nama_barang'];
}
?>
 
<br>
<br>
<h1>Edit Data Detail Pengadaan</h1>
<form action="updatedetailpengeluaran-proses.php" enctype="multipart/form-data" method="post" >
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
			foreach($masukdetailpengeluaran->Que($que) as $value){ 
		  ?>
			<option value="<?php echo $value['id_brg']; ?>"><?php echo $value['id_brg']; echo " -- "; echo $value['nama_barang']; ?></option>
		  <?php } ?>       
    </select>
	</th>
    <th><input type="text" class="form-control" name="jumlah" value="<?php echo $jumlah; ?>" required pattern="[0-9]{1,30}" /></th>
	<th><input type="submit" class="form-control" value="Update" name="kirim" /><input  type="hidden" value="<?php echo $no_pengeluaran_barang; ?>" name="no_pengeluaran_barang" required/><input  type="hidden" value="<?php echo $id_detail_pengeluaran; ?>" name="id_detail_pengeluaran" required/></th>
  </tr>
</table>
 </form> 
<?php include 'bot.html'; ?>