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
$id_detail_pagu = isset($_GET['id_detail_pagu']) ? $_GET['id_detail_pagu'] : '';
$id_pagu_barang = isset($_GET['id_pagu_barang']) ? $_GET['id_pagu_barang'] : '';

$que = 'DELETE FROM detail_pagu WHERE id_detail_pagu="'.$id_detail_pagu.'"';
$masukdetailpagu->Que($que);
echo "<meta http-equiv='refresh' content='0;detail_pagu.php?id_pagu_barang=$id_pagu_barang'>";	
?>
Kembali ke : <a href="detail_pagu.php?id_pagu_barang=<?php echo $id_pagu_barang; ?>">Home</a>
<?php include 'bot.html'; ?>