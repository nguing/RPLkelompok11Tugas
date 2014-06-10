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
require( 'queryb.php' );
$id_brg = isset($_GET['id_brg']) ? $_GET['id_brg'] : '';

$que = 'DELETE FROM barang WHERE id_brg="'.$id_brg.'"';
$masukb->Que($que);
echo "<meta http-equiv='refresh' content='0;URL=barang.php'>";	
?>
Kembali ke : <a href="barang.php">Home</a>
<?php include 'bot.html'; ?>