<?php
session_start();
if(isset($_SESSION['username']))
	{
	if ($_SESSION['role'] == "admin")
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
require( 'querydetailpagu.php' );
$id_pagu_barang = isset($_GET['id_pagu_barang']) ? $_GET['id_pagu_barang'] : '';

// tampilkan data berdasarkan where
$que = 'select * from pagu_brg, unit_kerja, user where kode_akun_user = kode_akun and unit_kerja.id_unit_kerja = user.id_unit_kerja and pagu_brg.id_pagu_barang = "'.$id_pagu_barang.'"';

foreach($masukdetailpagu->Que($que) as $value){
    $unit_kerja = $value['unit_kerja'];
	$nama_penanggungjawab = $value['nama_penanggungjawab'];
}
?>

<h1>Pagu Barang</h1>
  <table border="0" style="border-collapse:collapse;text-align:left;" class="table table-striped">
    <tr>
      <td>ID Pagu Barang</td>
      <td>:</td>
      <td><?php echo $id_pagu_barang; ?></td>
    </tr>
    <tr>
      <td>Unit Kerja</td>
      <td>:</td>
      <td><?php echo $unit_kerja; ?></td>
    </tr>
    <tr>
      <td>Nama Penanggung Jawab</td>
      <td>:</td>
      <td>
		<?php echo $nama_penanggungjawab; ?>
	  </td>
    </tr>		
 </table>

<?php
$id_detail_pagu = isset($_GET['id_detail_pagu']) ? $_GET['id_detail_pagu'] : '';

// tampilkan data berdasarkan where
$que = 'select * from detail_pagu,barang where detail_pagu.id_brg=barang.id_brg and id_detail_pagu="'.$id_detail_pagu.'"';

foreach($masukdetailpagu->Que($que) as $value){
    $id_barang = $value['id_brg'];
	$jumlah = $value['jumlah'];
	$nama_brg = $value['nama_barang'];
}
?>

 <br>
 <br>
<h1>Edit Data Pagu Barang</h1>
<form action="updatedetailpagu-proses.php" enctype="multipart/form-data" method="post" >
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
			foreach($masukdetailpagu->Que($que) as $value){ 
		  ?>
			<option value="<?php echo $value['id_brg']; ?>"><?php echo $value['id_brg']; echo " -- "; echo $value['nama_barang']; ?></option>
		  <?php } ?>       
    </select>
	</th>
    <th><input type="text" class="form-control" name="jumlah" value="<?php echo $jumlah; ?>" required pattern="[0-9]{1,30}" /></th>
	<th><input type="submit" class="form-control" value="Update" name="kirim" /><input hidden type="text" value="<?php echo $id_detail_pagu; ?>" name="id_detail_pagu" required/><input hidden type="text" value="<?php echo $id_pagu_barang; ?>" name="id_pagu_barang" required/></th>
  </tr>
</table>
 </form> 
<?php include 'bot.html'; ?>