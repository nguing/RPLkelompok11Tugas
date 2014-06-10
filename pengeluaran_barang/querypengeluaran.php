<?php
require '../queryumum.php';
class Querypengeluaran extends Queryumum 
{
    public function Insertpengeluaran($querypengeluar,$no_pengeluaran_barang,$no_permintaan_barang,$keterangan,$tanggal_pengeluaran)
	{
		if(!empty($no_permintaan_barang))
			{
			if(!empty($no_pengeluaran_barang))
				{
					if(!empty($keterangan))
						{
						if(!empty($tanggal_pengeluaran))
							{
								$this->no_permintaan_barang = mySQL_escape_string($no_permintaan_barang);
								$this->no_pengeluaran_barang = mySQL_escape_string($no_pengeluaran_barang);
								$this->keterangan = mySQL_escape_string($keterangan);
								$this->tanggal_pengeluaran = mySQL_escape_string($tanggal_pengeluaran);			
								$this->data = array(
								'no_permintaan_barang' 	=> $this->no_permintaan_barang,
								'no_pengeluaran_barang' => $this->no_pengeluaran_barang,
								'keterangan' 			=> $this->keterangan,
								'tanggal_pengeluaran' 	=> $this->tanggal_pengeluaran
								);
								$this->statement = $this->dbh->prepare($querypengeluar);
								$this->statement->execute($this->data);								
							}
							else
							{
							echo '<script type="text/javascript">confirm("Tanggal_pengeluaran kosong")</script>';						
							}
						}
					else
						{
						echo '<script type="text/javascript">confirm("Keterangan kosong")</script>';
						}
				}
			else
				{
				echo '<script type="text/javascript">confirm("No_pengeluaran_barang Kosong")</script>';
				}
		}
		else
			{
			echo '<script type="text/javascript">confirm("No_permintaan_barang kosong")</script>';
			}
	}	
	
}

// instansi class
$masukpengeluaran = new Querypengeluaran;
?>