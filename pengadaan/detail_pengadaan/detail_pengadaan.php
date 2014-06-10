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
$id_brg = isset($_GET['id_brg']) ? $_GET['id_brg'] : '';
$nama_barang = isset($_GET['nama_barang']) ? $_GET['nama_barang'] : '';

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
	<script type="text/javascript">
			function hapus()
			{
				var hapus = confirm("Data Detail Pengadaan akan dihapus");
				
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
				var update = confirm("data Detail Pengadaan akan di update");
				
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
<h1>Faktur Pengadaan Barang</h1>
  <table border="0" class="table table-striped" >
    <tr>
      <td align="left">Nomor Faktur</td>
      <td align="left">:</td>
      <td align="left"><?php echo $no_faktur; ?></td>
    </tr>
    <tr>
      <td align="left">Tanggal Pengadaan</td>
      <td align="left">:</td>
      <td align="left"><?php echo $tanggal_pengadaan; ?></td>
    </tr>
    <tr>
      <td align="left">Nama Rekanan</td>
      <td align="left">:</td>
      <td align="left"><?php echo $rekanan; ?></td>
    </tr>
    <tr>
      <td align="left">Keterangan</td>
      <td align="left">:</td>
      <td align="left"><?php echo $keterangan; ?></td>
    </tr>	
 </table>
 
 <br>
<br>
 
<h1>Tambah Data Detail Pengadaan</h1>
<form action="insertdetailpengadaan.php" enctype="multipart/form-data" method="post" >
<table border="1" style="border-collapse:collapse;text-align:left;" class="table table-striped">
  <tr>
    <th>Nama Barang</th>
	<th>Cari</th>
    <th>Jumlah</th>
	<th>Harga Satuan</th>
	<th><p align="center">Action</p></th>
  </tr>
  <tr>
    <th>
	<select name="id_barang" class="form-control"> 
			<option value="<?php echo $id_brg; ?>"><?php echo $id_brg; echo " -- "; echo $nama_barang; ?></option>
		  <?php 
			$que = "select id_brg, nama_barang from barang";
			foreach($masukdetailpengadaan->Que($que) as $value){ 
		  ?>
			<option value="<?php echo $value['id_brg']; ?>"><?php echo $value['id_brg']; echo " -- "; echo $value['nama_barang']; ?></option>
		  <?php } ?>       
    </select>
	</th>
	<th><a href="cari_barang.php?no_faktur=<?php echo $no_faktur; ?>" ><input type="button" class="form-control" value="Cari" name="kirim" /></a></th>	
    <th><input type="text" class="form-control" name="jumlah" required pattern="[0-9]{1,30}" /></th>
	<th><input type="text" class="form-control" name="harga_brg" required pattern="[0-9]{3,30}" /></th>
	<th><input type="submit" class="form-control" value="Simpan" name="kirim" /><input  type="hidden" value="<?php echo $no_faktur; ?>" name="no_faktur" required/></th>
  </tr>
</table>
 </form> 
 
<br>
<br>
<h1>Daftar Data Detail Pengadaan</h1>
<table border="1" style="border-collapse:collapse;text-align:left;" class="table table-striped">
  <tr>
	<th>Nomor</th>
	<th>ID Barang</th>
    <th>Nama Barang</th>
    <th>Jumlah</th>
	<th>Harga Satuan</th>
	<th>Harga</th>
    <th colspan="2" ><p align="center">Action</p></th>
  </tr>

  <?php 
	$n=1;
	$que = "select * from detail_pengadaan,barang where barang.id_brg=detail_pengadaan.id_brg and detail_pengadaan.no_faktur='".$no_faktur."'";
	foreach($masukdetailpengadaan->Que($que) as $value){ 
  ?>
  <tr>
	<td><?php echo $n; ?></td>
    <td><?php echo $value['id_brg']; ?></td>
	<td><?php echo $value['nama_barang']; ?></td>
    <td><?php echo $value['jumlah']; ?></td>
	<td><?php echo $value['harga_brg']; ?></td>
	<td>
		<?php 
			echo $value['jumlah'] * $value['harga_brg'];
		?>
	</td>
    <td><a onclick="return update()" href="updatedetailpengadaan.php?id_detail_pengadaan=<?php echo $value['id_detail_pengadaan']; ?>&no_faktur=<?php echo $no_faktur; ?>"><input type="button" class="form-control" value="Update"></a></td>
    <td><a onclick="return hapus()" href="deletedetailpengadaan.php?id_detail_pengadaan=<?php echo $value['id_detail_pengadaan']; ?>&no_faktur=<?php echo $no_faktur; ?>"><input type="button" class="form-control" value="Delete"></a></td>
  </tr>
  <?php $n++;} ?>
</table>
<?php include 'bot.html'; ?>