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
$id_brg = isset($_GET['id_brg']) ? $_GET['id_brg'] : '';
$nama_barang = isset($_GET['nama_barang']) ? $_GET['nama_barang'] : '';

// tampilkan data berdasarkan where
$que = 'select * from pagu_brg, unit_kerja, user where kode_akun_user = kode_akun and unit_kerja.id_unit_kerja = user.id_unit_kerja and pagu_brg.id_pagu_barang = "'.$id_pagu_barang.'"';

foreach($masukdetailpagu->Que($que) as $value){
    $unit_kerja = $value['unit_kerja'];
	$nama_penanggungjawab = $value['nama_penanggungjawab'];
}
?>

	<script type="text/javascript">
			function hapus()
			{
				var hapus = confirm("Data Detail Pagu Barang akan dihapus");
				
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
				var update = confirm("Data Detail Pagu Barang akan di update");
				
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

<H1>Pagu Barang</h1>
  <table style="border-collapse:collapse;text-align:left;" class="table table-striped">
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
 
<br>
<br> 
 
<h1>Daftar Detail Pagu Barang</h1>
<form action="insertdetailpagu.php" enctype="multipart/form-data" method="post" >  
<table border="1" style="border-collapse:collapse;text-align:left;" class="table table-striped">
  <tr>
    <th>Nama Barang</th>
	<th>Cari</th>	
    <th>Jumlah Batasan</th>
	<th>Action</th>
  </tr>
  <tr>
    <th>
	<select name="id_barang" class="form-control"> 
			<option value="<?php echo $id_brg; ?>"><?php echo $id_brg; echo " -- "; echo $nama_barang; ?></option>
		  <?php 
			$que = "select id_brg, nama_barang from barang";
			foreach($masukdetailpagu->Que($que) as $value){ 
		  ?>
			<option value="<?php echo $value['id_brg']; ?>"><?php echo $value['id_brg']; echo " -- "; echo $value['nama_barang']; ?></option>
		  <?php } ?>       
    </select>
	</th>
	<th>
		<a href="cari_barang.php?id_pagu_barang=<?php echo $id_pagu_barang; ?>" ><input type="button" class="form-control" value="Cari" name="kirim" /></a></th>		
	</th>	
    <th><input type="text" class="form-control" name="jumlah" required pattern="[0-9]{1,30}" /></th>
	<th><input type="submit" class="form-control" value="Simpan" name="kirim" /><input hidden type="text" value="<?php echo $id_pagu_barang; ?>" name="id_pagu_barang" required/></th>
  </tr>
</table>
 </form> 

<br>
<br>	
<h1>Daftar Detail Pagu Barang Unit Kerja <?php echo $unit_kerja ?></h1>
<table border="1" style="border-collapse:collapse;text-align:left;" class="table table-striped">
  <tr>
	<th>Nomor</th>
	<th>ID Barang</th>
    <th>Nama Barang</th>
    <th>Jumlah</th>
    <th colspan="2" ><p align="center">Action</p></th>
  </tr>

  <?php 
	$n=1;
 	$que = "select * from detail_pagu,barang where barang.id_brg=detail_pagu.id_brg and detail_pagu.id_pagu_barang='".$id_pagu_barang."'";
	foreach($masukdetailpagu->Que($que) as $value){ 
  ?>
  <tr>
	<td><?php echo $n; ?></td>
	<td><?php echo $value['id_brg']; ?></td>
    <td><?php echo $value['nama_barang']; ?></td>
    <td><?php echo $value['jumlah']; ?></td>
    <td><a onclick="return update()" href="updatedetailpagu.php?id_detail_pagu=<?php echo $value['id_detail_pagu']; ?>&id_pagu_barang=<?php echo $id_pagu_barang; ?>"><input type="button" class="form-control" value="Update"></a></td>
    <td><a onclick="return hapus()" href="deletedetailpagu.php?id_detail_pagu=<?php echo $value['id_detail_pagu']; ?>&id_pagu_barang=<?php echo $id_pagu_barang; ?>"><input type="button" class="form-control" value="Delete"></a></td>
  </tr>
  <?php $n++;}  ?>
</table>
<?php include 'bot.html'; ?>