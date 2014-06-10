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
?>

	<script type="text/javascript">
			function hapus()
			{
				var hapus = confirm("Data Permintaan barang akan dihapus");
				
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
				var update = confirm("Data Permintaan barang akan di update");
				
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

<br>
<h1>Daftar Permintaan Barang</h1>
<table border="1" style="border-collapse:collapse;text-align:left;" class="table table-striped">
  <tr>
    <th>Nomor Permintaan Barang</th>
	<th>Unit Kerja</th>		
	<th>Nama Penanggung Jawab</th>	
	<th>Keterangan</th>
	<th>Tanggal Pembuatan Permintaan Barang</th>
    <th colspan="4"><p align="center">Action</p></th>
  </tr>

  <?php 
	$que = "select * from permintaan_brg, user, unit_kerja 
			where 
			user.id_unit_kerja = unit_kerja.id_unit_kerja 
			and permintaan_brg.kode_akun = user.kode_akun		
			";
	foreach($masukpermintaan->Que($que) as $value){ 
  ?>
  <tr>
    <td><?php echo $value['no_permintaan_barang']; ?></td>
    <td><?php echo $value['unit_kerja']; ?></td>
	<td><?php echo $value['nama_penanggungjawab']; ?></td>
	<td><?php echo $value['keterangan']; ?></td>
	<td><?php echo $value['tanggal_permintaan_barang']; ?></td>
    <td><a onclick="return update()" href="updatepermintaan.php?no_permintaan_barang=<?php echo $value['no_permintaan_barang']; ?>"><input type="button" class="form-control" value="Update"></a></td>
    <td><a onclick="return hapus()" href="deletepermintaan.php?no_permintaan_barang=<?php echo $value['no_permintaan_barang']; ?>"><input type="button" class="form-control" value="Delete"></a></td>
	<td><a href="./detail_permintaan/detail_permintaan.php?no_permintaan_barang=<?php echo $value['no_permintaan_barang']; ?>"><input type="button" class="form-control" value="Detail Permintaan"></a></td>
	<td><a href="cetak_permintaan.php?no_permintaan_barang=<?php echo $value['no_permintaan_barang']; ?>"><input type="button" class="form-control" value="Cetak"></a></td>
  </tr>
  <?php } ?>
</table>
<?php include 'bot.html'; ?>