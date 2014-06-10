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
require( 'queryjb.php' );
$id_jenis = isset($_GET['id_jenis']) ? $_GET['id_jenis'] : '';

// tampilkan data berdasarkan where
$que = 'SELECT * FROM jenis_barang WHERE id_jenis="'.$id_jenis.'"';

foreach($masukjb->Que($que) as $value){
    $id_jenis = $value['id_jenis'];
    $jenis_brg = $value['jenis_brg'];
}
?>

<h1>Edit Alamat Penduduk</h1>
<form action="updatejb-proses.php" method="post">
  <table border="0" class="table table-striped">
    <tr>
      <td>Nama</td>
      <td>:</td>
      <td><input type="text" class="form-control" required readonly value="<?php echo $id_jenis; ?>" name="id_jenis" /></td>
    </tr>
    <tr>
      <td>Alamat</td>
      <td>:</td>
      <td><input type="text" class="form-control" required pattern="[A-Za-z0-9 ]{2,}" value="<?php echo $jenis_brg; ?>" name="jenis_brg" /></td>
    </tr>
    <tr>
      <td align="center" colspan="3"><input style="width:50%" type="submit" class="form-control" value="Update" name="Update" /></td>
    </tr>
  </table>
</form>
<?php include 'bot.html'; ?>