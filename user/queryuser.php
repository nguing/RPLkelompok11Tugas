<?php
require '../queryumum.php';
class Queryuser extends Queryumum 
{
    public function Insertuser($queryuser,$username,$id_unit_kerja,$password,$nama_penanggungjawab)
	{
		if(!empty($username))
			{
			if(!empty($id_unit_kerja))
				{
				if(!empty($password))
					{
					if(!empty($nama_penanggungjawab))
						{
								$this->username = mySQL_escape_string($username);
								$this->id_unit_kerja = mySQL_escape_string($id_unit_kerja);
								$this->password = mySQL_escape_string($password);
								$this->nama_penanggungjawab = mySQL_escape_string($nama_penanggungjawab);				
								$this->data = array(
								'username' => $this->username,
								'id_unit_kerja' => $this->id_unit_kerja,
								'password' => $this->password,
								'nama_penanggungjawab' => $this->nama_penanggungjawab
								);
								$this->statement = $this->dbh->prepare($queryuser);
								$this->statement->execute($this->data);	
						}
					else
						{
						echo '<script type="text/javascript">confirm("Nama penanggung jawab kosong")</script>';
						}
					}
				else
					{
					echo '<script type="text/javascript">confirm("Password kosong")</script>';
					}
				}
			else
				{
				echo '<script type="text/javascript">confirm("Unit kerja Kosong")</script>';
				}
		}
		else
			{
			echo '<script type="text/javascript">confirm("Username kosong")</script>';
			}
	}	
	
    public function Updateuser($queryupuser,$kode_akun,$username,$id_unit_kerja,$nama_penanggungjawab)
	{
		if(!empty($kode_akun))
			{
			if(!empty($username))
				{
				if(!empty($id_unit_kerja))
					{
					if(!empty($nama_penanggungjawab))
						{
								$this->username = mySQL_escape_string($username);
								$this->id_unit_kerja = mySQL_escape_string($id_unit_kerja);
								$this->kode_akun = mySQL_escape_string($kode_akun);
								$this->nama_penanggungjawab = mySQL_escape_string($nama_penanggungjawab);			
								$this->data = array(
								'username' => $this->username,
								'id_unit_kerja' => $this->id_unit_kerja,
								'kode_akun' => $this->kode_akun,
								'nama_penanggungjawab' => $this->nama_penanggungjawab
								);
								$this->statement = $this->dbh->prepare($queryupuser);
								$this->statement->execute($this->data);	
						}
					else
						{
						echo '<script type="text/javascript">confirm("Nama penanggung jawab kosong")</script>';
						}
					}
				else
					{
					echo '<script type="text/javascript">confirm("Id_unit_kerja kosong")</script>';
					}
				}
			else
				{
				echo '<script type="text/javascript">confirm("Username Kosong")</script>';
				}
		}
		else
			{
			echo '<script type="text/javascript">confirm("Kode akun kosong")</script>';
			}
	}

    public function Updatepwuser($queryuppwuser,$kode_akun,$password)
	{
		if(!empty($kode_akun))
			{
			if(!empty($password))
				{

								$this->kode_akun = mySQL_escape_string($kode_akun);
								$this->password = mySQL_escape_string($password);			
								$this->data = array(
								'kode_akun' => $this->kode_akun,
								'password' => $this->password
								);
								$this->statement = $this->dbh->prepare($queryuppwuser);
								$this->statement->execute($this->data);	
				}
			else
				{
				echo '<script type="text/javascript">confirm("Kode barang sudah ada")</script>';
				echo "password Kosong";
				}
		}
		else
			{
			echo '<script type="text/javascript">confirm("Kode barang sudah ada")</script>';
			echo "kode akun  kosong";
			}
	}	
	
}

// instansi class
$masukuser = new Queryuser;
?>