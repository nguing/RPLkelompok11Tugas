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
require( 'querypengadaan.php' );
?>
	<script type="text/javascript">
			function hapus()
			{
				var hapus = confirm("Data Pengadaan Barang akan dihapus");
				
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
				var update = confirm("Data Pengadaan Barang akan di update");
				
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
<h1>Input Data Pengadaan Barang</h1>
<form action="insertpengadaan.php" enctype="multipart/form-data" method="post" >
  <table border="0" style="border-collapse:collapse;text-align:left;" class="table table-striped">
    <tr>
      <td>Nomor Faktur</td>
      <td>:</td>
      <td><input type="text" class="form-control" name="no_faktur" required pattern="[A-Za-z0-9]{2,30}"  /></td>
    </tr>
    <tr>
      <td>Tanggal Pengadaan</td>
      <td>:</td>
      <td><input type="date" class="form-control" value="<?php echo date('Y-m-d'); ?>" name="tanggal_pengadaan" required/></td>
    </tr>
    <tr>
      <td>Nama Rekanan</td>
      <td>:</td>
      <td>
	  <select name="id_rekanan" class="form-control"> 
		  <?php 
			$que = "select id_rekanan, rekanan from rekanan";
			foreach($masukpengadaan->Que($que) as $value){ 
		  ?>
			<option value="<?php echo $value['id_rekanan']; ?>"><?php echo $value['id_rekanan']; echo " -- "; echo $value['rekanan']; ?></option>
		  <?php } ?>       
      </select>
	  </td>
    </tr>
    <tr>
      <td>Keterangan</td>
      <td>:</td>
      <td>
	  <textarea name="keterangan" class="form-control" required pattern="[A-Za-z0-9 ]{2,}"></textarea>
	  </td>
    </tr>	
    <tr>
      <td align="center" colspan="3"><input style="width:50%" type="submit" class="form-control" value="Kirim" name="kirim" /></td>
    </tr>
  </table>
</form>


<br>
<br>
<h1>Daftar Data Pengadaan Barang</h1>
<table border="1" style="border-collapse:collapse;text-align:left;" class="table table-striped">
  <tr>
    <th>Nomor Pengadaan</th>
    <th>Tanggal Pengadaan</th>
	<th>ID Rekanan</th>
	<th>Nama Rekanan</th>
	<th>Keterangan</th>
    <th colspan="4"><p align="center">Action</p></th>
  </tr>

  <?php 
	$que = "select * from pengadaan_brg,rekanan where pengadaan_brg.id_rekanan=rekanan.id_rekanan";
	foreach($masukpengadaan->Que($que) as $value){ 
  ?>
  <tr>
    <td><?php echo $value['no_faktur']; ?></td>
    <td><?php echo $value['tanggal_pengadaan']; ?></td>
	<td><?php echo $value['id_rekanan']; ?></td>	
	<td><?php echo $value['rekanan']; ?></td>
	<td><?php echo $value['keterangan']; ?></td>
    <td><a onclick="return update()" href="updatepengadaan.php?no_faktur=<?php echo $value['no_faktur']; ?>"><input type="button" class="form-control" value="Update"></a></td>
    <td><a onclick="return hapus()" href="deletepengadaan.php?no_faktur=<?php echo $value['no_faktur']; ?>"><input type="button" class="form-control" value="Delete"></a></td>
	<td><a href="detail_pengadaan/detail_pengadaan.php?no_faktur=<?php echo $value['no_faktur']; ?>"><input type="button" class="form-control" value="Detail Pengadaan"></a></td>
	<td><a href="cetak_pengadaan.php?no_faktur=<?php echo $value['no_faktur']; ?>"><input type="button" class="form-control" value="Cetak"></a></td>	
  </tr>
  <?php } ?>
</table>
<?php include 'bot.html'; ?>