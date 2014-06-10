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

$que = 'select * from pengadaan_brg where id_rekanan = "'.$id_rekanan.'"';

foreach($masukrekanan->Que($que) as $value){
    $cek_id_rekanan = $value['id_rekanan'];
}

if (empty($cek_id_rekanan))
	{
		$que = 'DELETE FROM rekanan WHERE id_rekanan="'.$id_rekanan.'"';
		$masukrekanan->Que($que);
	}
else
	{
		echo '<script type="text/javascript">confirm("Data pengadaan_brgmasih ada ")</script>';
	}
echo "<meta http-equiv='refresh' content='0;URL=rekanan.php'>";	
?>
Kembali ke : <a href="rekanan.php">Home</a>
<?php include 'bot.html'; ?>