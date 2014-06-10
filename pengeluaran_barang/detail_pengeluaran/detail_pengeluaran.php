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
$no_pengeluaran_barang = isset($_GET['no_pengeluaran_barang']) ? $_GET['no_pengeluaran_barang'] : '';$no_faktur = isset($_GET['no_faktur']) ? $_GET['no_faktur'] : '';
$id_brg = isset($_GET['id_brg']) ? $_GET['id_brg'] : '';
$nama_barang = isset($_GET['nama_barang']) ? $_GET['nama_barang'] : '';

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

	<script type="text/javascript">
			function hapus()
			{
				var hapus = confirm("Data Barang akan dihapus");
				
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
				var update = confirm("Data Barang akan di update");
				
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

<br>
<br> 
 <h1>Daftar Detail Permintaan Nomor <?php echo $no_permintaan_barang; ?></h1>
<table border="1" style="border-collapse:collapse;text-align:left;" class="table table-striped">
  <tr>
	<th>Nomor</th>
    <th>ID Barang</th>
	<th>Nama Barang</th>
    <th>Jumlah</th>
  </tr>

  <?php 
 	$que = "select * from detail_permintaan,barang where barang.id_brg=detail_permintaan.id_brg and detail_permintaan.no_permintaan_barang='".$no_permintaan_barang."'";
	foreach($masukdetailpengeluaran->Que($que) as $value){ 
  ?>
  <tr>
	<td><?php echo $value['id_detail_permintaan']; ?></td>
    <td><?php echo $value['id_brg']; ?></td>
	<td><?php echo $value['nama_barang']; ?></td>
    <td><?php echo $value['jumlah']; ?></td>
  </tr>
  <?php }  ?>
</table>
 
<br>
<br>
<h1>Tambahkan Data Pengeluaran</h1>
<form action="insertdetailpengeluaran.php" enctype="multipart/form-data" method="post" >
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
			foreach($masukdetailpengeluaran->Que($que) as $value){ 
		  ?>
			<option value="<?php echo $value['id_brg']; ?>"><?php echo $value['id_brg']; echo " -- "; echo $value['nama_barang']; ?></option>
		  <?php } ?>       
    </select>	
	</th>	
	<th>
		<a href="cari_barang.php?no_pengeluaran_barang=<?php echo $no_pengeluaran_barang; ?>" ><input type="button" class="form-control" value="Cari" name="kirim" /></a></th>		
	</th>
    <th><input type="text" class="form-control" name="jumlah" required pattern="[0-9]{1,30}" /></th>
	<th><input type="submit" class="form-control" value="Simpan" name="kirim" /><input  type="hidden" value="<?php echo $no_pengeluaran_barang; ?>" name="no_pengeluaran_barang" required/><input  type="hidden" value="<?php echo $nama_penanggungjawab; ?>" name="nama_penanggungjawab" required/></th>
  </tr>
</table>
 </form> 

<br>
<br>
<h1>Daftar Pengeluaran <?php echo $unit_kerja; ?></h1>
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
 	$que = "select * from detail_pengeluaran,barang where barang.id_brg=detail_pengeluaran.id_brg and detail_pengeluaran.no_pengeluaran='".$no_pengeluaran_barang."'";
	foreach($masukdetailpengeluaran->Que($que) as $value){ 
  ?>
  <tr>
	<td><?php echo $n; ?></td>
    <td><?php echo $value['id_brg']; ?></td>
	<td><?php echo $value['nama_barang']; ?></td>
    <td><?php echo $value['jumlah']; ?></td>
    <td><a onclick="return update()" href="updatedetailpengeluaran.php?id_detail_pengeluaran=<?php echo $value['id_detail_pengeluaran']; ?>&no_pengeluaran_barang=<?php echo $no_pengeluaran_barang; ?>"><input type="button" class="form-control" value="Update"></a></td>
    <td><a onclick="return hapus()" href="deletedetailpengeluaran.php?id_detail_pengeluaran=<?php echo $value['id_detail_pengeluaran']; ?>&no_pengeluaran_barang=<?php echo $no_pengeluaran_barang; ?>"><input type="button" class="form-control" value="Delete"></a></td>
  </tr>
  <?php $n++;}  ?>
</table>
<?php include 'bot.html'; ?>