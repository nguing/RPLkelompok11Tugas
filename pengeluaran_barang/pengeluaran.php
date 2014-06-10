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
?>

	<script type="text/javascript">
			function hapus()
			{
				var hapus = confirm("Data Pengeluaran Barang akan dihapus");
				
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
				var update = confirm("Data Pengeluaran Barang akan di update");
				
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

<h1>Input Data Pengeluaran Barang</h1>
<form action="insertpengeluaran.php" enctype="multipart/form-data" name="barang" method="post" >
  <table style="border-collapse:collapse;text-align:left;" class="table table-striped">
    <tr>
      <td>Nomor Pengeluaran Barang</td>
      <td>:</td>
      <td><input type="text" class="form-control" name="no_pengeluaran_barang" required pattern="[A-Za-z0-9]{2,30}"  /></td>
    </tr>
    <tr>
      <td>Nomor Permintaan Barang</td>
      <td>:</td>
      <td>
	  <select name="no_permintaan_barang" class="form-control"> 
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
      <td>Tanggal Pengeluaran</td>
      <td>:</td>
      <td><input type="date" class="form-control" value="<?php echo date('Y-m-d'); ?>" name="tanggal_pengeluaran_barang" required /></td>
    </tr>
    <tr>
      <td>Keterangan</td>
      <td>:</td>
      <td>
	  <textarea name="keterangan" class="form-control" required pattern="[A-Za-z0-9 ]{1,}"></textarea>
	  </td>
    </tr>		
    <tr>
      <td align="center" colspan="3"><input style="width:50%" type="submit" class="form-control" value="Simpan" name="kirim" /></td>
    </tr>
  </table>
</form>

<br>
<br>
<h1>Daftar Pengeluaran Barang</h1>
<table border="1" style="border-collapse:collapse;text-align:left;" class="table table-striped">
  <tr>
    <th>Nomor Pengeluaran Barang</th>	
	<th>Nomor Permintaan Barang</th>	
    <th>Unit Kerja</th>
	<th>Nama Penanggung Jawab</th>
	<th>Keterangan</th>	
	<th>Tanggal Pembuatan Pengeluaran Barang</th>
    <th colspan="4"><p align="center">Action</p></th>
  </tr>

  <?php 
	$que = "select no_pengeluaran_barang,pengeluaran_brg.no_permintaan_barang,unit_kerja,nama_penanggungjawab,pengeluaran_brg.keterangan as keterangan_pengeluaran,tanggal_pengeluaran from pengeluaran_brg, permintaan_brg, user, unit_kerja where user.id_unit_kerja = unit_kerja.id_unit_kerja and permintaan_brg.kode_akun = user.kode_akun and pengeluaran_brg.no_permintaan_barang = permintaan_brg.no_permintaan_barang";
	foreach($masukpengeluaran->Que($que) as $value){ 
  ?>
  <tr>
    <td><?php echo $value['no_pengeluaran_barang']; ?></td> 
    <td><?php echo $value['no_permintaan_barang']; ?></td>
    <td><?php echo $value['unit_kerja'];?></td>
	<td><?php echo $value['nama_penanggungjawab']; ?></td>
	<td><?php echo $value['keterangan_pengeluaran']; ?></td>
	<td><?php echo $value['tanggal_pengeluaran']; ?></td>
    <td><a onclick="return update()" href="updatepengeluaran.php?no_pengeluaran_barang=<?php echo $value['no_pengeluaran_barang']; ?>"><input type="button" class="form-control" value="Update"></a></td>
    <td><a onclick="return hapus()" href="deletepengeluaran.php?no_pengeluaran_barang=<?php echo $value['no_pengeluaran_barang']; ?>"><input type="button" class="form-control" value="Delete"></a></td>
	<td><a href="./detail_pengeluaran/detail_pengeluaran.php?no_pengeluaran_barang=<?php echo $value['no_pengeluaran_barang']; ?>&no_permintaan_barang=<?php echo $value['no_permintaan_barang']; ?>"><input type="button" class="form-control" value="Detail Pengeluaran"></a></td>
	<td><a href="cetak_pengeluaran.php?no_pengeluaran_barang=<?php echo $value['no_pengeluaran_barang']; ?>&no_permintaan_barang=<?php echo $value['no_permintaan_barang']; ?>"><input type="button" class="form-control" value="Cetak"></a></td>	
  </tr>
  <?php } ?>
</table>
<?php include 'bot.html'; ?>