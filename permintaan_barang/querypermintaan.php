<?php
require '../queryumum.php';
class Querypermintaan extends Queryumum 
{
    public function Insertpermintaan($queryperminta,$no_permintaan_barang,$kode_akun,$keterangan,$tanggal_permintaan_barang)
	{
		if(!empty($no_permintaan_barang))
			{
			if(!empty($kode_akun))
				{
					if(!empty($keterangan))
						{
						if(!empty($tanggal_permintaan_barang))
							{
								$this->no_permintaan_barang = mySQL_escape_string($no_permintaan_barang);
								$this->kode_akun = mySQL_escape_string($kode_akun);
								$this->keterangan = mySQL_escape_string($keterangan);
								$this->tanggal_permintaan_barang = mySQL_escape_string($tanggal_permintaan_barang);
								$this->nama_barang = mySQL_escape_string($nama_barang);					
								$this->data = array(
								'no_permintaan_barang' => $this->no_permintaan_barang,
								'kode_akun' => $this->kode_akun,
								'keterangan' => $this->keterangan,
								'tanggal_permintaan_barang' => $this->tanggal_permintaan_barang
								);
								$this->statement = $this->dbh->prepare($queryperminta);
								$this->statement->execute($this->data);								
							}
							else
							{
							echo '<script type="text/javascript">confirm("tanggal_permintaan_barang kosong")</script>';
							}
						}
					else
						{
						echo '<script type="text/javascript">confirm("keterangan kosong")</script>';
						}
				}
			else
				{
				echo '<script type="text/javascript">confirm("kode_akun Kosong")</script>';
				}
		}
		else
			{
			echo '<script type="text/javascript">confirm("no_permintaan_barang kosong")</script>';
			}
	}	
	
}

// instansi class
$masukpermintaan = new Querypermintaan;
?>