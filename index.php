<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta http-equiv="content-type" content="text/html; charset=UTF-8">
		<meta charset="utf-8">
		<title>Inventory Fakultas Teknik Universitas Andalas</title>
		<meta name="generator" content="Bootply" />
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
		<link href="css/bootstrap.min.css" rel="stylesheet">
		<link href="css/font-awesome.min.css" rel="stylesheet">		
		
		<!--[if lt IE 9]>
			<script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script>
		<![endif]-->
		<link href="css/styles.css" rel="stylesheet">
	</head>
	<body>
<nav class="navbar navbar-trans navbar-fixed-top" role="navigation">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-collapsible">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="/inventory_ft/index.php"><img src="css/unand.png"> Inventory Fakultas Teknik</a>
    </div>
    <div class="navbar-collapse collapse" id="navbar-collapsible">
      <ul class="nav navbar-nav navbar-left">
	  <?php
	  $role 			= isset($_SESSION['role']) ? $_SESSION['role'] : '';
	  if ($role == "admin")
	  {
		echo 
			 '
				<li><a href="/inventory_ft/pagu_barang/pagu_barang.php">Pagu barang</a></li>
				<li><a href="/inventory_ft/user/user.php">User</a></li>
				<li><a href="/inventory_ft/stok/laporan_stok.php">Stok</a></li>
				<li><a href="/inventory_ft/permintaan_barang/daftar_permintaan.php">Daftar Permintaan</a></li>
			 ';
	  }
	  else if($role == "gudang")
	  {
		echo 
		'
        <li>
            <a class="dropdown-toggle" data-toggle="dropdown">Barang</a>
              <ul class="dropdown-menu">
                <li><a href="/inventory_ft/barang/barang.php">Data Barang</a></li>
                <li><a href="/inventory_ft/jenis_barang/jenis_barang.php">Jenis Barang</a></li>
              </ul>
        </li>
        <li><a href="/inventory_ft/pengadaan/pengadaan.php">Pengadaan</a></li>        
        <li>
            <a class="dropdown-toggle" data-toggle="dropdown">Permintaan</a>
              <ul class="dropdown-menu">
                <li><a href="/inventory_ft/permintaan_barang/permintaan.php">Data Permintaan</a></li>
                <li><a href="/inventory_ft/permintaan_barang/daftar_permintaan.php">Daftar Permintaan</a></li>
              </ul>
        </li>		
        <li><a href="/inventory_ft/pengeluaran_barang/pengeluaran.php">Pengeluaran</a></li>
        <li><a href="/inventory_ft/rekanan/rekanan.php">Rekanan</a></li>
        <li><a href="/inventory_ft/unit_kerja/unit_kerja.php">Unit Kerja</a></li>	
		<li><a href="/inventory_ft/stok/laporan_stok.php">Stok</a></li>		
		';	  
	  }	  
	  else
	  {
		echo 
			'
			<li><a href="/inventory_ft/permintaan_barang/permintaan.php">Data Permintaan</a></li>
			<li><a href="/inventory_ft/stok/laporan_stok.php">Stok</a></li>	
			';
	  }
	  ?>			
		<li><a href="#"></a></li>
      </ul>
      <form class="navbar-form pull-right" style="left:-120px">
        <div class="form-group" style="display:inline;">
          <div class="input-group"> 
			<div class="dropdown">
			<a href="" data-toggle="dropdown"><i class="fa fa-sign-in fa-2x"></i></a>			
			<ul class="dropdown-menu left animated flipInY" role="menu" style="left:-180px">	
			
			<?php
			if(isset($_SESSION['username']))
				{
				echo '
					<li><a href=""><i class="st-user"></i><i class="fa fa-align-justify fa-lg"></i> Nama :  '.$_SESSION['nama_penanggungjawab'].' </a></li>
					<li><a href=""><i class="st-cloud"></i><i class="fa fa-university fa-lg"></i> Unit Kerja : '.$_SESSION['unit_kerja'].' </a></li>
					<li><a href="logout.php"><i class="im-exit"></i><i class="fa fa-sign-out fa-lg"></i>  Logout</a></li></ul>					
					';				
				}
			else
				{
				echo '<li><a href="login.php"><i class="im-exit"></i><i class="fa fa-sign-out fa-lg"></i>  Login</a></li>';
				}
			?>		
			</ul>
			</div>    
          </div>
        </div>
      </form>
    </div>
  </div>
</nav>

<section class="container-fluid" id="section2">
  <div class="row">
  	<div class="col-sm-8 col-sm-offset-2 text-center">
	<br>
	<br>
	<br>
	<br>
	<br>
	<br>
	<br>
	<br>
	<br>
	
	<div style="-moz-border-radius: 10px 10px 10px 10px;
				-webkit-border-radius:10px 10px 10px 10px; 
				background-color: #279ddd; border-radius:20px;
				border: 3px solid black;">
	<h1>SISTEM INFORMASI INVENTORY BARANG</h1>
	<h1>DEKANAT FAKULTAS TEKNIK</h1>
	<h1>UNIVERSITAS ANDALAS</h1>
	</div>
    </div>
  </div>
</section>

<footer id="footer">
	<p align="center"> &copy; SISTEM INFORMASI 2011 | Inventory Fakultas Teknik </p>
</footer>

	<!-- script references -->
		<script src="js/jquery.min.js"></script>
		<script src="js/bootstrap.min.js"></script>
		<script src="js/scripts.js"></script>
	</body>
</html>
