<?php
session_start();
if(isset($_SESSION['username']))
	{
	
	}
else
	{
	header('location:../../login.php');
	}
	
include 'top.php';
require( 'querydetailpermintaan.php' );
$id_detail_permintaan				= isset($_POST['id_detail_permintaan']) ? $_POST['id_detail_permintaan'] : '';
$id_brg								= isset($_POST['id_brg']) ? $_POST['id_brg'] : '';
$no_permintaan_barang				= isset($_POST['no_permintaan_barang']) ? $_POST['no_permintaan_barang'] : '';
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

foreach($masukdetailpermintaan->Que($que) as $value){
    $id_brg = $value['id_brg'];
	$stok = $value['stok'];
}

if($stok>$jumlah)
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
				
		foreach($masukdetailpermintaan->Que($que) as $value){
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
				
		foreach($masukdetailpermintaan->Que($que) as $value){
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
			$queryupdetailperminta = 'UPDATE detail_permintaan SET id_brg=:id_brg, jumlah=:jumlah WHERE id_detail_permintaan=:id_detail_permintaan';
			$masukdetailpermintaan->Updetailperminta($queryupdetailperminta,$id_detail_permintaan,$id_brg,$jumlah);
		}
		else
		{
			echo '<script type="text/javascript">confirm("Pagu telah mencapai batas")</script>';
		}		

	}
else
	{	
		echo '<script type="text/javascript">confirm("stok ridak mencukupi")</script>';
	}
echo "<meta http-equiv='refresh' content='0;URL=detail_permintaan.php?no_permintaan_barang=$no_permintaan_barang'>";		
?>
Kembali ke : <a href="detail_permintaan.php?no_permintaan_barang=<?php echo $no_permintaan_barang; ?>">Home</a>
<?php include 'bot.html'; ?>