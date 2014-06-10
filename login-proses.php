<?php									
		require( 'querylogin.php' );
		$iusername 				= $_POST["username"];
		$ipass					= $_POST["password"];											
		$ipassword 				= base64_encode("$ipass");
		
		$que = "
				SELECT username, 
				password , unit_kerja.unit_kerja as uk, role, nama_penanggungjawab
				FROM user, unit_kerja
				WHERE user.id_unit_kerja = unit_kerja.id_unit_kerja
				AND username =  '".$iusername."'
				AND password =  '".$ipassword."'
				";
				
		foreach($loginque->Que($que) as $value){ 
		$username = $value['username'];
		$password = $value['password'];
		$unit_kerja = $value['uk'];
		$role = $value['role'];
		$nama_penanggungjawab = $value['nama_penanggungjawab'];
	   } 	
	   
		if(isset($_POST['butsubmit']))
			{											
			if($ipassword==$password && $iusername==$username && !empty($iusername) && !empty($ipassword))
				{
				error_reporting(E_ALL ^ E_NOTICE);
				session_start();
				$_SESSION['username']=$iusername;
				$_SESSION['unit_kerja']=$unit_kerja;
				$_SESSION['role']=$role;
				$_SESSION['nama_penanggungjawab']=$nama_penanggungjawab;
				if(!isset($_SESSION['username']))
					{
					die("Username Anda belum tersimpan");
					}
				else
					{
					echo "<script>alert('Berhasil Login, Selamat datang $iusername');</script>";
					echo "<meta http-equiv='refresh' content='0;URL=./index.php'>";
					}
				}
			elseif($ipassword!=$password)
				{
				echo"<script>alert('gagal login');</script>";
				echo "<meta http-equiv='refresh' content='0;URL=login.php'>";
				}		
			else
				{
				echo "<meta http-equiv='refresh' content='0;URL=login.php'>";
				}
			}			
			
?>