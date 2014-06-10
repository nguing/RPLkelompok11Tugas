<?php
require '../../queryumum.php';
class Querydetailpagu extends Queryumum 
{
    public function Insertdetailpagu($querydetailpagu,$id_brg,$id_pagu_barang,$jumlah)
	{
		if(!empty($id_pagu_barang))
			{
			if(!empty($id_brg))
				{
				if(!empty($jumlah))
					{
						$this->id_pagu_barang = mySQL_escape_string($id_pagu_barang);
						$this->id_brg = mySQL_escape_string($id_brg);
						$this->jumlah = mySQL_escape_string($jumlah);
						$this->data = array(
						'id_pagu_barang' => $this->id_pagu_barang,
						'id_brg' => $this->id_brg,
						'jumlah' => $this->jumlah
						);
						$this->statement = $this->dbh->prepare($querydetailpagu);
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
			echo '<script type="text/javascript">confirm("Id_pagu_barang kosong")</script>';
			}
    }	
	
    public function Updetailpagu($queryupdetailpagu,$id_detail_pagu,$id_brg,$jumlah)
	{
		if(!empty($id_detail_pagu))
			{
			if(!empty($id_brg))
				{
				if(!empty($jumlah))
					{
						$this->id_detail_pagu = mySQL_escape_string($id_detail_pagu);
						$this->id_brg = mySQL_escape_string($id_brg);
						$this->jumlah = mySQL_escape_string($jumlah);
						$this->data = array(
						'id_detail_pagu' => $this->id_detail_pagu,
						'id_brg' => $this->id_brg,
						'jumlah' => $this->jumlah
						);
						$this->statement = $this->dbh->prepare($queryupdetailpagu);
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
			echo '<script type="text/javascript">confirm("Id_detail_pagu kosong")</script>';
			echo "id_detail_pagu kosong";
			}
    }		
}

// instansi class
$masukdetailpagu = new Querydetailpagu;
?>