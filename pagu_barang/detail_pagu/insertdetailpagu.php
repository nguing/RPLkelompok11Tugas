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
$id_brg					= isset($_POST['id_barang']) ? $_POST['id_barang'] : '';
$id_pagu_barang			= isset($_POST['id_pagu_barang']) ? $_POST['id_pagu_barang'] : '';
$jumlah 				= isset($_POST['jumlah']) ? $_POST['jumlah'] : '';

// eksekusi class

$que = 'SELECT * FROM detail_pagu,pagu_brg where pagu_brg.id_pagu_barang = detail_pagu.id_pagu_barang and id_brg = "'.$id_brg.'" and pagu_brg.id_pagu_barang ="'.$id_pagu_barang.'"';

foreach($masukdetailpagu->Que($que) as $value){
    $cek_id_brg = $value['id_brg'];
}

if(empty($cek_id_brg))
	{
		$querydetailpagu ='INSERT INTO detail_pagu( id_brg,id_pagu_barang,jumlah ) VALUES( :id_brg,:id_pagu_barang,:jumlah )';
		$masukdetailpagu->Insertdetailpagu($querydetailpagu,$id_brg,$id_pagu_barang,$jumlah);
	}
else
	{
		echo '<script type="text/javascript">confirm("Data id barang sudah ada")</script>';
	}
echo "<meta http-equiv='refresh' content='0;detail_pagu.php?id_pagu_barang=$id_pagu_barang'>";	
?>

Kembali ke : <a href="detail_pagu.php?id_pagu_barang=<?php echo $id_pagu_barang; ?>">Home</a>
<?php include 'bot.html'; ?>