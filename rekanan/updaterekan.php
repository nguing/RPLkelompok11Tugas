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
require( 'queryrekan.php' );
$id_rekanan = isset($_GET['id_rekanan']) ? $_GET['id_rekanan'] : '';

// tampilkan data berdasarkan where
$que = 'SELECT * FROM rekanan WHERE id_rekanan="'.$id_rekanan.'"';

foreach($masukrekanan->Que($que) as $value){
    $id_rekanan = $value['id_rekanan'];
    $rekanan = $value['rekanan'];
	$telp = $value['telp'];
	$alamat = $value['alamat'];
	
}
?>

<h1>Edit Data Rekanan</h1>
<form action="updaterekan-proses.php" method="post">
  <table border="0" style="border-collapse:collapse;text-align:left;" class="table table-striped">
    <tr>
      <td>ID Rekanan</td>
      <td>:</td>
      <td><input type="text" class="form-control" name="id_rekanan" value="<?php echo $id_rekanan; ?>" readonly required pattern="[A-Za-z0-9]{2,30}"  /></td>
    </tr>
    <tr>
      <td>Nama Rekanan</td>
      <td>:</td>
      <td><input type="text" class="form-control" name="rekanan" value="<?php echo $rekanan; ?>" required pattern="[A-Za-z0-9 ]{2,}" /></td>
    </tr>
    <tr>
      <td>Contact Person</td>
      <td>:</td>
      <td><input type="text" class="form-control" name="telp" value="<?php echo $telp; ?>" required pattern="[0-9]{2,}" /></td>
    </tr>
    <tr>
      <td>Alamat</td>
      <td>:</td>
      <td>
	  <textarea name="alamat" class="form-control" required pattern="[A-Za-z0-9 ]{2,}"><?php echo $alamat; ?></textarea>
	  </td>
    </tr>
    <tr>
      <td align="center" colspan="3"><input style="width:50%" type="submit" class="form-control" value="Update" name="Update" /></td>
    </tr>
  </table>
</form>
<?php include 'bot.html'; ?>