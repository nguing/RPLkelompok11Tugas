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
$id_detail_permintaan = isset($_GET['id_detail_permintaan']) ? $_GET['id_detail_permintaan'] : '';
$id_brg = isset($_GET['id_brg']) ? $_GET['id_brg'] : '';
$nama_barang = isset($_GET['nama_barang']) ? $_GET['nama_barang'] : '';

// tampilkan data berdasarkan where
$que = 'select * from permintaan_brg, user, unit_kerja where user.id_unit_kerja = unit_kerja.id_unit_kerja and permintaan_brg.kode_akun = user.kode_akun and no_permintaan_barang = "'.$no_permintaan_barang.'"';

foreach($masukdetailpermintaan->Que($que) as $value){
    $unit_kerja = $value['unit_kerja'];
	$nama_penanggungjawab = $value['nama_penanggungjawab'];
	$keterangan = $value['keterangan'];
	$tanggal_permintaan_barang = $value['tanggal_permintaan_barang'];
}
?>

	<script type="text/javascript">
			function hapus()
			{
				var hapus = confirm("Data Detail Permintaan akan dihapus");
				
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
				var update = confirm("Data Detail Permintaan akan di update");
				
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

<br>
<br>

<h1>Input Data Permintaan</h1>
<form action="insertdetailpermintaan.php" enctype="multipart/form-data" method="post" >
<table border="1" style="border-collapse:collapse;text-align:left;" class="table table-striped">
  <tr>
    <th>Nama Barang</th>
	<th>Cari</th>		
    <th>Jumlah</th>
	<th>Action</th>
  </tr>
  <tr>
    <th>
	<select name="id_barang" class="form-control"> 
			<option value="<?php echo $id_brg; ?>"><?php echo $id_brg; echo " -- "; echo $nama_barang; ?></option>
		  <?php 
			$que = "select id_brg, nama_barang from barang";
			foreach($masukdetailpermintaan->Que($que) as $value){ 
		  ?>
			<option value="<?php echo $value['id_brg']; ?>"><?php echo $value['id_brg']; echo " -- "; echo $value['nama_barang']; ?></option>
		  <?php } ?>       
    </select>
	</th>
	<th>
		<a href="cari_barang.php?no_permintaan_barang=<?php echo $no_permintaan_barang; ?>" ><input type="button" class="form-control" value="Cari" name="kirim" /></a></th>		
	</th>		
    <th><input type="text" class="form-control" name="jumlah" required pattern="[0-9]{1,30}" /></th>
	<th><input type="submit" class="form-control" value="Simpan" name="kirim" /><input  type="hidden" value="<?php echo $no_permintaan_barang; ?>" name="no_permintaan_barang" required/></th>
  </tr>
</table>
 </form> 

<br>
<br>
<h1>Daftar Detail Permintaan <?php echo $unit_kerja; ?></h1>
<table border="1" style="border-collapse:collapse;text-align:left;" class="table table-striped">
  <tr>
	<th>Nomor</th>
    <th>ID Barang</th>
	<th>Nama Barang</th>
    <th>Jumlah</th>
    <th colspan="2" align="middle">Action</th>
  </tr>

  <?php 
	$n=1;
 	$que = "select * from detail_permintaan,barang where barang.id_brg=detail_permintaan.id_brg and detail_permintaan.no_permintaan_barang='".$no_permintaan_barang."'";
	foreach($masukdetailpermintaan->Que($que) as $value){ 
  ?>
  <tr>
	<td><?php echo $n; ?></td>
    <td><?php echo $value['id_brg']; ?></td>
	<td><?php echo $value['nama_barang']; ?></td>
    <td><?php echo $value['jumlah']; ?></td>
    <td><a onclick="return update()" href="updatedetailpermintaan.php?id_detail_permintaan=<?php echo $value['id_detail_permintaan']; ?>&no_permintaan_barang=<?php echo $no_permintaan_barang; ?>"><input type="button" class="form-control" value="Update"></a></td>
    <td><a onclick="return hapus()" href="deletedetailpermintaan.php?id_detail_permintaan=<?php echo $value['id_detail_permintaan']; ?>&no_permintaan_barang=<?php echo $no_permintaan_barang; ?>"><input type="button" class="form-control" value="Delete"></a></td>
  </tr>
  <?php $n++;}  ?>
</table>
<?php include 'bot.html'; ?>