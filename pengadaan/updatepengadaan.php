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
$no_faktur = isset($_GET['no_faktur']) ? $_GET['no_faktur'] : '';

// tampilkan data berdasarkan where
$que = 'select * from pengadaan_brg,rekanan where pengadaan_brg.id_rekanan=rekanan.id_rekanan and no_faktur="'.$no_faktur.'"';

foreach($masukpengadaan->Que($que) as $value){
    $no_faktur = $value['no_faktur'];
    $tanggal_pengadaan = $value['tanggal_pengadaan'];
	$id_rekanan = $value['id_rekanan'];
	$keterangan = $value['keterangan'];
	$rekanan = $value['rekanan'];
}
?>

<h1>Edit Data Pengadaan</h1>
<form action="updatepengadaan-proses.php" method="post">
  <table border="0" class="table table-striped">
    <tr>
      <td>Nomor Faktur</td>
      <td>:</td>
      <td><input type="text" class="form-control" name="no_faktur" value="<?php echo $no_faktur; ?>" readonly required pattern="[A-Za-z0-9]{2,30}"  /></td>
    </tr>
    <tr>
      <td>Tanggal Pengadaan</td>
      <td>:</td>
      <td><input type="date" class="form-control" name="tanggal_pengadaan" value="<?php echo $tanggal_pengadaan; ?>" required/></td>
    </tr>
    <tr>
      <td>Nama Rekanan</td>
      <td>:</td>
      <td>
	  <select name="id_rekanan" class="form-control"> 
		<option value="<?php echo $id_rekanan; ?>"><?php echo $id_rekanan; ?> -- <?php echo $rekanan; ?></option>
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
	  <textarea name="keterangan" class="form-control" required pattern="[A-Za-z0-9 ]{2,}"><?php echo $keterangan; ?></textarea>
	  </td>
    </tr>
    <tr>
      <td align="center" colspan="3"><input type="submit" style="width:50%" class="form-control" value="Update" name="Update" /></td>
    </tr>
  </table>
</form>
<?php include 'bot.html'; ?>