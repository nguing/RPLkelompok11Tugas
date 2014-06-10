<?php
require '../../queryumum.php';
class Querydetailpengadaan extends Queryumum 
{
    public function Insertdetailpengadaan($querydetailpenga,$no_faktur,$id_brg,$jumlah,$harga_brg)
	{
		if(!empty($no_faktur))
			{
			if(!empty($id_brg))
				{
				if(!empty($jumlah))
					{
					if(!empty($harga_brg))
						{
						$this->no_faktur = mySQL_escape_string($no_faktur);
						$this->id_brg = mySQL_escape_string($id_brg);
						$this->jumlah = mySQL_escape_string($jumlah);
						$this->harga_brg = mySQL_escape_string($harga_brg);
						$this->data = array(
						'no_faktur' => $this->no_faktur,
						'id_brg' => $this->id_brg,
						'jumlah' => $this->jumlah,
						'harga_brg' => $this->harga_brg
						);
						$this->statement = $this->dbh->prepare($querydetailpenga);
						$this->statement->execute($this->data);							
						}	
					else
						{
						echo '<script type="text/javascript">confirm("Harga Kosong Kosong")</script>';
						}
					}
				else
					{
					echo '<script type="text/javascript">confirm("Jumlah Kosong")</script>';
					}					
				}
			else
				{
				echo '<script type="text/javascript">confirm("Nama Barang Kosong")</script>';				
				}
			}
		else
			{
			echo '<script type="text/javascript">confirm("Nomor Faktur kosong")</script>';
			}
    }	
	
    public function Updetailpengadaan($queryupdetailpenga,$id_detail_pengadaan,$id_brg,$jumlah,$harga_brg)
	{
		if(!empty($id_detail_pengadaan))
			{
			if(!empty($id_brg))
				{
				if(!empty($jumlah))
					{
					if(!empty($harga_brg))
						{
						$this->id_detail_pengadaan = mySQL_escape_string($id_detail_pengadaan);
						$this->id_brg = mySQL_escape_string($id_brg);
						$this->jumlah = mySQL_escape_string($jumlah);
						$this->harga_brg = mySQL_escape_string($harga_brg);
						$this->data = array(
						'id_detail_pengadaan' => $this->id_detail_pengadaan,
						'id_brg' => $this->id_brg,
						'jumlah' => $this->jumlah,
						'harga_brg' => $this->harga_brg
						);
						$this->statement = $this->dbh->prepare($queryupdetailpenga);
						$this->statement->execute($this->data);							
						}	
					else
						{
						echo '<script type="text/javascript">confirm("Harga Kosong Kosong")</script>';
						}
					}
				else
					{
					echo '<script type="text/javascript">confirm("Jumlah Kosong")</script>';					
					}					
				}
			else
				{
				echo '<script type="text/javascript">confirm("Nama Barang Kosong")</script>';
				}
			}
		else
			{
			echo '<script type="text/javascript">confirm("ID Detail Pengadaan kosong")</script>';
			}
    }		
}

// instansi class
$masukdetailpengadaan = new Querydetailpengadaan;
?>