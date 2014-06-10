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
?>


<h1>Pencarian Barang</h1>
<br>
<form action="cari_barang.php" enctype="multipart/form-data" name="barang" method="post" >
  <table border="0" class="table table-striped">
    <tr>
      <td align="left" ><p align="center">Jenis Barang</p>
	  <select name="id_jenis_barang" class="form-control"> 
		  <?php 
			$que = "select id_jenis,jenis_brg from jenis_barang";
			foreach($masukb->Que($que) as $value){ 
		  ?>
			<option value="<?php echo $value['id_jenis']; ?>"><?php echo $value['id_jenis']; echo " -- "; echo $value['jenis_brg']; ?></option>
		  <?php } ?>       
      </select>
	  </td>
      <td align="left" ><p align="center">Kategori Pencarian</p>
	  	  <select name="kategori" class="form-control"> 
			<option value="nol">Tampil Semua</option>
			<option value="id_barang">ID Barang</option>    
			<option value="barcode_barang">Barcode Barang</option>   
			<option value="nama_barang">Nama Barang</option>     
      </select>
	  </td>
      <td><p>Keyword</p><input type="text" class="form-control" name="keyword" pattern="[A-Za-z0-9]{0,30}"/></td>
      <td><p>Action</p><input type="submit" class="form-control" value="Kirim" name="kirim" /></td>
    </tr>
  </table>
</form>

<br>
<br>
<h1>Daftar Jenis Barang</h1>
<br>
<table border="1" style="border-collapse:collapse;text-align:left;" class="table table-striped">
  <tr>
    <th>ID Barang</th>	
	<th>Nama Barang</th>	
	<th>Jenis Barang</th>
	<th>Satuan</th>
    <th><p align="center">Action</p></th>
  </tr>

<?php	
	if (isset($_POST['kirim']))
	{
		$keyword 			= isset($_POST['keyword']) ? $_POST['keyword'] : '';
		$kategori 			= isset($_POST['kategori']) ? $_POST['kategori'] : '';
		$id_jenis_barang	= isset($_POST['id_jenis_barang']) ? $_POST['id_jenis_barang'] : '';
		
		if($kategori == "id_barang")
		{
		$que = "select * from barang, jenis_barang where barang.id_jenis_barang=jenis_barang.id_jenis 
				and barang.id_jenis_barang='".$id_jenis_barang."' 
				and barang.id_brg = '".$keyword."'
				";
		foreach($masukb->Que($que) as $value)
			{ 
			echo '
				  <tr>
					<td> '.$value["id_brg"].' </td>
					<td> '.$value["nama_barang"].' </td>
					<td> '.$value["jenis_brg"].' </td>
					<td> '.$value["satuan"].' </td>
					<td align="center"><a onclick="return update()" href="updateb.php?id_brg= '.$value["id_brg"].' "><input type="button" class="form-control" value="Pilih"></a></td>
				  </tr>
				  ';
			}		
		}
		elseif($kategori ==  "barcode_barang")
		{
		$que = "select * from barang, jenis_barang where barang.id_jenis_barang=jenis_barang.id_jenis 
				and barang.id_jenis_barang='".$id_jenis_barang."' 
				and barang.id_brg = '".$keyword."'
				";
		foreach($masukb->Que($que) as $value)
			{ 
			echo '
				  <tr>
					<td> '.$value["id_brg"].' </td>
					<td> '.$value["nama_barang"].' </td>
					<td> '.$value["jenis_brg"].' </td>
					<td> '.$value["satuan"].' </td>
					<td align="center"><a onclick="return update()" href="updateb.php?id_brg= '.$value["id_brg"].' "><input type="button" class="form-control" value="Pilih"></a></td>
				  </tr>
				  ';
			}	
		}
		elseif($kategori == "nama_barang")
		{
		$que = "select * from barang, jenis_barang where barang.id_jenis_barang=jenis_barang.id_jenis 
				and barang.id_jenis_barang='".$id_jenis_barang."' 
				and barang.nama_barang like '".$keyword."'
				";
		foreach($masukb->Que($que) as $value)
			{ 
			echo '
				  <tr>
					<td> '.$value["id_brg"].' </td>
					<td> '.$value["nama_barang"].' </td>
					<td> '.$value["jenis_brg"].' </td>
					<td> '.$value["satuan"].' </td>
					<td align="center"><a onclick="return update()" href="updateb.php?id_brg= '.$value["id_brg"].' "><input type="button" class="form-control" value="Pilih"></a></td>
				  </tr>
				  ';
			}	
		}
		elseif($kategori == "nol")
		{
		$que = "select * from barang, jenis_barang where barang.id_jenis_barang=jenis_barang.id_jenis ";
		foreach($masukb->Que($que) as $value)
			{ 
			echo '
				  <tr>
					<td> '.$value["id_brg"].' </td>
					<td> '.$value["nama_barang"].' </td>
					<td> '.$value["jenis_brg"].' </td>
					<td> '.$value["satuan"].' </td>
					<td align="center"><a onclick="return update()" href="updateb.php?id_brg= '.$value["id_brg"].' "><input type="button" class="form-control" value="Pilih"></a></td>
				  </tr>
				  ';
			}	
		}		
		else
		{
		echo '<script type="text/javascript">confirm("Kategori yang dimasukan tidak sesuai")</script>';
		}	
	}
	else
	{
	}
	
?>	
</table>
<?php include 'bot.html'; ?>
