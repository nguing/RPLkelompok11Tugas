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
$id_detail_pagu				= isset($_POST['id_detail_pagu']) ? $_POST['id_detail_pagu'] : '';
$id_brg						= isset($_POST['id_brg']) ? $_POST['id_brg'] : '';
$id_pagu_barang				= isset($_POST['id_pagu_barang']) ? $_POST['id_pagu_barang'] : '';
$jumlah 					= isset($_POST['jumlah']) ? $_POST['jumlah'] : '';

$que = 'SELECT * FROM detail_pagu where id_brg = "'.$id_brg.'"';

foreach($masukdetailpagu->Que($que) as $value){
    $cek_id_brg = $value['id_brg'];
}

if(!$cek_id_brg)
	{
		$queryupdetailpagu = 'UPDATE detail_pagu SET id_brg=:id_brg, jumlah=:jumlah WHERE id_detail_pagu=:id_detail_pagu';
		$masukdetailpagu->Updetailpagu($queryupdetailpagu,$id_detail_pagu,$id_brg,$jumlah);
	}
else
	{
		echo '<script type="text/javascript">confirm("Data id barang sudah ada")</script>';
	}
echo "<meta http-equiv='refresh' content='0;detail_pagu.php?id_pagu_barang=$id_pagu_barang'>";	
?>
Kembali ke : <a href="detail_pagu.php?id_pagu_barang=<?php echo $id_pagu_barang; ?>">Home</a>
<?php include 'bot.html'; ?>