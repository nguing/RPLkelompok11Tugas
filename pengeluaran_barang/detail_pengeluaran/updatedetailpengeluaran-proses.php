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
require( 'querydetailpengeluaran.php' );
$id_detail_pengeluaran				= isset($_POST['id_detail_pengeluaran']) ? $_POST['id_detail_pengeluaran'] : '';
$id_brg								= isset($_POST['id_brg']) ? $_POST['id_brg'] : '';
$no_pengeluaran_barang				= isset($_POST['no_pengeluaran_barang']) ? $_POST['no_pengeluaran_barang'] : '';
$jumlah 							= isset($_POST['jumlah']) ? $_POST['jumlah'] : '';


$que = 	'
			SELECT 
			a.id_brg, a.nama_barang, (SELECT COALESCE(SUM(jumlah), 0) 
			FROM detail_pengadaan d 
			WHERE d.id_brg = a.id_brg) 
			- 
			(SELECT COALESCE(SUM(jumlah), 0) 
			FROM detail_pengeluaran e 
			WHERE e.id_brg = a.id_brg) AS stok 
			FROM barang a LEFT JOIN detail_pengadaan b 
			ON a.id_brg = b.id_brg 
			LEFT JOIN detail_pengeluaran c 
			ON a.id_brg = c.id_brg 
			where a.id_brg = "'.$id_brg.'"
			GROUP BY a.id_brg
		';

foreach($masukdetailpengeluaran->Que($que) as $value){
	$stok = $value['stok'];
}

if($stok >= $jumlah)
	{
		$usernamepakai = $_SESSION['username'];
		$que = 	'
				SELECT 
				detail_pagu.id_brg, jumlah, id_detail_pagu, kode_akun

				from 
				detail_pagu,pagu_brg,user

				where 
				detail_pagu.id_pagu_barang = pagu_brg.id_pagu_barang 
				and pagu_brg.kode_akun_user = user.kode_akun
				and username = "'.$usernamepakai.'"
				and id_brg = "'.$id_brg.'"
				';	
				
		foreach($masukdetailpengeluaran->Que($que) as $value){
			$batas = $value['jumlah'];			
		}	
		
		$que = 	'
				SELECT barang.id_brg, COALESCE( SUM( jumlah ) , 0 ) AS jum
				FROM detail_pengeluaran, barang, pengeluaran_brg, permintaan_brg, user
				WHERE detail_pengeluaran.id_brg = barang.id_brg
				AND pengeluaran_brg.no_pengeluaran_barang = detail_pengeluaran.no_pengeluaran
				AND pengeluaran_brg.no_permintaan_barang = permintaan_brg.no_permintaan_barang
				AND permintaan_brg.kode_akun = user.kode_akun
				GROUP BY user.kode_akun
				and username = "'.$usernamepakai.'"
				and detail_pengeluaran.id_brg = "'.$id_brg.'"
				';	
				
		foreach($masukdetailpengeluaran->Que($que) as $value){
			$penggunaan = $value['jum'];			
		}			
		
		if(empty($penggunaan))
		{
			$pembatas = $batas;
		}
		else
		{
			$pembatas = $batas-$penggunaan;
		}
		
		if($pembatas >= $jumlah)
		{
			$queryupdetailpengeluaran = 'UPDATE detail_pengeluaran SET id_brg=:id_brg, jumlah=:jumlah WHERE id_detail_pengeluaran=:id_detail_pengeluaran';
			$masukdetailpengeluaran->Updetailpengeluaran($queryupdetailpengeluaran,$id_detail_pengeluaran,$id_brg,$jumlah);
		}
		else
		{
			echo '<script type="text/javascript">confirm("Pagu telah mencapai batas")</script>';
		}	
	}
else
	{	
		echo '<script type="text/javascript">confirm("Stok ridak mencukupi")</script>';
	}
echo "<meta http-equiv='refresh' content='0;URL=detail_pengeluaran.php?no_pengeluaran_barang=$no_pengeluaran_barang'>";	
?>
Kembali ke : <a href="detail_pengeluaran.php?no_pengeluaran_barang=<?php echo $no_pengeluaran_barang; ?>">Home</a>
<?php include 'bot.html'; ?>