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
$no_faktur				= isset($_POST['no_faktur']) ? $_POST['no_faktur'] : '';
$id_brg	 				= isset($_POST['id_barang']) ? $_POST['id_barang'] : '';
$jumlah 				= isset($_POST['jumlah']) ? $_POST['jumlah'] : '';
$harga_brg 				= isset($_POST['harga_brg']) ? $_POST['harga_brg'] : '';
// eksekusi class

$que = 	'
		SELECT * FROM detail_pengadaan,pengadaan_brg where detail_pengadaan.no_faktur = pengadaan_brg.no_faktur
		and detail_pengadaan.no_faktur = "'.$no_faktur.'"
		and id_brg = "'.$id_brg.'"
		';

		foreach($masukdetailpengadaan->Que($que) as $value){
			$cek_id_brg = $value['id_brg'];
		}		

		if($cek_id_brg != $id_brg)
		{
			$querydetailpenga ='INSERT INTO detail_pengadaan( no_faktur,id_brg,jumlah,harga_brg ) VALUES( :no_faktur,:id_brg,:jumlah,:harga_brg )';
			$masukdetailpengadaan->Insertdetailpengadaan($querydetailpenga,$no_faktur,$id_brg,$jumlah,$harga_brg);
		}
		else
		{
			echo '<script type="text/javascript">confirm("Barang yang diadakan sudah ada dalam daftar di pesan dalam pengeluaran ini")</script>';
		}		
		
echo "<meta http-equiv='refresh' content='0;URL=detail_pengadaan.php?no_faktur=$no_faktur '>";
?>

Kembali ke : <a href="detail_pengadaan.php?no_faktur=<?php echo $no_faktur; ?>">Home</a>
<?php include 'bot.html'; ?>