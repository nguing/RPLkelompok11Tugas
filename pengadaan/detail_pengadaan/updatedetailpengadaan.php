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
require( 'querydetailpengadaan.php' );
$no_faktur = isset($_GET['no_faktur']) ? $_GET['no_faktur'] : '';

// tampilkan data berdasarkan where
$que = 'select * from pengadaan_brg,rekanan where pengadaan_brg.id_rekanan=rekanan.id_rekanan and no_faktur="'.$no_faktur.'"';

foreach($masukdetailpengadaan->Que($que) as $value){
    $no_faktur = $value['no_faktur'];
    $tanggal_pengadaan = $value['tanggal_pengadaan'];
	$id_rekanan = $value['id_rekanan'];
	$keterangan = $value['keterangan'];
	$rekanan = $value['rekanan'];
}
?>

<h1>Faktur Pengadaan Barang</h1>
  <table border="0" style="border-collapse:collapse;text-align:left;" class="table table-striped">
    <tr>
      <td>Nomor Faktur</td>
      <td>:</td>
      <td><?php echo $no_faktur; ?></td>
    </tr>
    <tr>
      <td>Tanggal Pengadaan</td>
      <td>:</td>
      <td><?php echo $tanggal_pengadaan; ?></td>
    </tr>
    <tr>
      <td>Nama Rekanan</td>
      <td>:</td>
      <td>
		<?php echo $rekanan; ?>
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
$id_detail_pengadaan = isset($_GET['id_detail_pengadaan']) ? $_GET['id_detail_pengadaan'] : '';

// tampilkan data berdasarkan where
$que = 'select * from detail_pengadaan,barang where detail_pengadaan.id_brg=barang.id_brg and id_detail_pengadaan="'.$id_detail_pengadaan.'"';

foreach($masukdetailpengadaan->Que($que) as $value){
    $id_detail_pengadaan = $value['id_detail_pengadaan'];
	$no_faktur = $value['no_faktur'];
    $id_barang = $value['id_brg'];
	$jumlah = $value['jumlah'];
	$harga_brg = $value['harga_brg'];
	$nama_brg = $value['nama_barang'];
}
?>

<br>
<br>
<h1>Edit Data Detail Pengadaan</h1>
<form action="updatedetailpengadaan-proses.php" enctype="multipart/form-data" method="post" >
<table border="1" style="border-collapse:collapse;text-align:left;" class="table table-striped">
  <tr>
    <th>Nama Barang</th>
    <th>Jumlah</th>
	<th>Harga Satuan</th>
	<th>Action</th>
  </tr>
  <tr>
    <th>
	<select name="id_brg" class="form-control"> 
	<option value="<?php echo $id_barang; ?>"><?php echo $id_barang; ?> -- <?php echo $nama_brg; ?></option>
		  <?php 
			$que = "select id_brg, nama_barang from barang";
			foreach($masukdetailpengadaan->Que($que) as $value){ 
		  ?>
			<option value="<?php echo $value['id_brg']; ?>"><?php echo $value['id_brg']; echo " -- "; echo $value['nama_barang']; ?></option>
		  <?php } ?>       
    </select>
	</th>
    <th><input type="text" class="form-control" name="jumlah" value="<?php echo $jumlah; ?>" required pattern="[0-9]{1,30}" /></th>
	<th><input type="text" class="form-control" name="harga_brg" value="<?php echo $harga_brg; ?>" required pattern="[0-9]{3,30}" /></th>
	<th><input type="submit" class="form-control" value="Update" name="kirim" /><input  type="hidden" value="<?php echo $no_faktur; ?>" name="no_faktur" required/><input type="hidden" value="<?php echo $id_detail_pengadaan; ?>" name="id_detail_pengadaan" required/></th>
  </tr>
</table>
</form> 
<?php include 'bot.html'; ?>