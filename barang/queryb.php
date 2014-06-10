<?php
require '../queryumum.php';
class Querybarang extends Queryumum 
{
    public function Insertb($querybrg,$id_brg,$id_jenis_barang,$satuan,$nama_barang,$barcode)
	{
		if(!empty($id_brg))
			{
			if(!empty($id_jenis_barang))
				{
				if(!empty($satuan))
					{
					if(!empty($nama_barang))
						{							
						$this->id_brg = mySQL_escape_string($id_brg);
						$this->id_jenis_barang = mySQL_escape_string($id_jenis_barang);
						$this->satuan = mySQL_escape_string($satuan);
						$this->nama_barang = mySQL_escape_string($nama_barang);		
						$this->barcode = mySQL_escape_string($barcode);											
						$this->data = array(
						'id_brg' => $this->id_brg,
						'id_jenis_barang' => $this->id_jenis_barang,
						'satuan' => $this->satuan,
						'nama_barang' => $this->nama_barang,
						'barcode' => $this->barcode
						);
						$this->statement = $this->dbh->prepare($querybrg);
						$this->statement->bindParam(':id_brg', $this->id_brg);
						$this->statement->execute($this->data);								
						}
					else
						{
						echo '<script type="text/javascript">confirm("Nama Barang kosong")</script>';
						}
					}
				else
					{
					echo '<script type="text/javascript">confirm("Satuan Barang kosong")</script>';
					}
				}
			else
				{
				echo '<script type="text/javascript">confirm("ID jenis Barang kosong")</script>';
				}
			}
		else
			{
			echo '<script type="text/javascript">confirm("ID Barang kosong")</script>';
			}
	}	
	
}

// instansi class
$masukb = new Querybarang;
?>