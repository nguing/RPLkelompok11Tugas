<?php
require '../queryumum.php';
class Querypagu extends Queryumum 
{
    public function Insertpagu($querypagu,$id_pagu_barang,$kode_akun_user)
	{
		if(!empty($id_pagu_barang))
			{
				if(!empty($kode_akun_user))
					{
					$this->id_pagu_barang = mySQL_escape_string($id_pagu_barang);
					$this->kode_akun_user = mySQL_escape_string($kode_akun_user);
					$this->data = array(
					'id_pagu_barang' => $this->id_pagu_barang,
					'kode_akun_user' => $this->kode_akun_user
					);
					$this->statement = $this->dbh->prepare($querypagu);
					$this->statement->execute($this->data);		
					}
				else
					{
					echo '<script type="text/javascript">confirm("Kode_akun_user Kosong")</script>';
					}
			}
		else
			{
			echo '<script type="text/javascript">confirm("Id_pagu_barang kosong")</script>';
			}
    }	
}

// instansi class
$masukpagu = new Querypagu;
?>