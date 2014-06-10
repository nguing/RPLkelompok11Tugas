<?php
session_start();
if(isset($_SESSION['username']))
	{
	if ($_SESSION['role'] == "gudang")
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
require( 'querydetailpengadaan.php' );
$id_detail_pengadaan	= isset($_POST['id_detail_pengadaan']) ? $_POST['id_detail_pengadaan'] : '';
$no_faktur				= isset($_POST['no_faktur']) ? $_POST['no_faktur'] : '';
$id_brg	 				= isset($_POST['id_brg']) ? $_POST['id_brg'] : '';
$jumlah 				= isset($_POST['jumlah']) ? $_POST['jumlah'] : '';
$harga_brg 				= isset($_POST['harga_brg']) ? $_POST['harga_brg'] : '';

$queryupdetailpenga = 'UPDATE detail_pengadaan SET id_brg=:id_brg, jumlah=:jumlah, harga_brg=:harga_brg WHERE id_detail_pengadaan=:id_detail_pengadaan';
$masukdetailpengadaan->Updetailpengadaan($queryupdetailpenga,$id_detail_pengadaan,$id_brg,$jumlah,$harga_brg);
echo "<meta http-equiv='refresh' content='0;URL=detail_pengadaan.php?no_faktur=$no_faktur '>";
?>
Kembali ke : <a href="detail_pengadaan.php?no_faktur=<?php echo $no_faktur; ?>">Home</a>
<?php include 'bot.html'; ?>