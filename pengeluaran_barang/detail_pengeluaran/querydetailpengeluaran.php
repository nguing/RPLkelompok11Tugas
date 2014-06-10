<?php
require '../../queryumum.php';
class Querydetailpengeluaran extends Queryumum 
{
    public function Insertdetailpengeluaran($querydetailpengeluaran,$id_brg,$no_pengeluaran_barang,$jumlah)
	{
		if(!empty($no_pengeluaran_barang))
			{
			if(!empty($id_brg))
				{
				if(!empty($jumlah))
					{
						$this->no_pengeluaran = mySQL_escape_string($no_pengeluaran_barang);
						$this->id_brg = mySQL_escape_string($id_brg);
						$this->jumlah = mySQL_escape_string($jumlah);
						$this->data = array(
						'no_pengeluaran' => $this->no_pengeluaran,
						'id_brg' => $this->id_brg,
						'jumlah' => $this->jumlah
						);
						$this->statement = $this->dbh->prepare($querydetailpengeluaran);
						$this->statement->execute($this->data);							
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
			echo '<script type="text/javascript">confirm("no_pengeluaran_barang kosong")</script>';
			}
    } 

	
	
    public function Updetailpengeluaran($queryupdetailpengeluaran,$id_detail_pengeluaran,$id_brg,$jumlah)
	{
		if(!empty($id_detail_pengeluaran))
			{
			if(!empty($id_brg))
				{
				if(!empty($jumlah))
					{
						$this->id_detail_pengeluaran = mySQL_escape_string($id_detail_pengeluaran);
						$this->id_brg = mySQL_escape_string($id_brg);
						$this->jumlah = mySQL_escape_string($jumlah);
						$this->data = array(
						'id_detail_pengeluaran' => $this->id_detail_pengeluaran,
						'id_brg' => $this->id_brg,
						'jumlah' => $this->jumlah
						);
						$this->statement = $this->dbh->prepare($queryupdetailpengeluaran);
						$this->statement->execute($this->data);							
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
			echo '<script type="text/javascript">confirm("id_detail_pengeluaran kosong")</script>';
			}
    }		
}

// instansi class
$masukdetailpengeluaran = new Querydetailpengeluaran;
?>