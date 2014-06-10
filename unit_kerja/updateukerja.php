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
require( 'queryukerja.php' );
$id_unit_kerja = isset($_GET['id_unit_kerja']) ? $_GET['id_unit_kerja'] : '';

// tampilkan data berdasarkan where
$que = 'SELECT * FROM unit_kerja WHERE id_unit_kerja="'.$id_unit_kerja.'"';

foreach($masukunitkerja->Que($que) as $value){
    $id_unit_kerja = $value['id_unit_kerja'];
    $unit_kerja = $value['unit_kerja'];
}
?>

<h1>Edit Data Unit Kerja</h1>
	<form action="updateukerja-proses.php" method="post">
	  <table border="0" style="border-collapse:collapse;text-align:left;" class="table table-striped">
		<tr>
		  <td>ID Unit Kerja</td>
		  <td>:</td>
		  <td><input type="text" class="form-control" readonly value="<?php echo $id_unit_kerja; ?>"required pattern="[A-Za-z0-9]{2,30}" name="id_unit_kerja" /></td>
		</tr>
		<tr>
		  <td>Nama Unit KErja</td>
		  <td>:</td>
		  <td><input type="text" class="form-control" value="<?php echo $unit_kerja; ?>" required pattern="[A-Za-z0-9 ]{2,30}" name="unit_kerja" /></td>
		</tr>
		<tr>
		  <td align="center" colspan="3"><input style="width:50%" type="submit" class="form-control" value="Update" name="Update" /></td>
		</tr>
	  </table>
	</form>
<?php include 'bot.html'; ?>