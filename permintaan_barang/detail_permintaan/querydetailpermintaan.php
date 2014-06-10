<?php
require '../../queryumum.php';
class Querydetailpermintaan extends Queryumum 
{
    public function Insertdetailpermintaan($querydetailperminta,$id_brg,$no_permintaan_barang,$jumlah)
	{
		if(!empty($no_permintaan_barang))
			{
			if(!empty($id_brg))
				{
				if(!empty($jumlah))
					{
						$this->no_permintaan_barang = mySQL_escape_string($no_permintaan_barang);
						$this->id_brg = mySQL_escape_string($id_brg);
						$this->jumlah = mySQL_escape_string($jumlah);
						$this->data = array(
						'no_permintaan_barang' => $this->no_permintaan_barang,
						'id_brg' => $this->id_brg,
						'jumlah' => $this->jumlah
						);
						$this->statement = $this->dbh->prepare($querydetailperminta);
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
			echo '<script type="text/javascript">confirm("No_permintaan_barang kosong")</script>';
			}
    }	
	
    public function Updetailperminta($queryupdetailperminta,$id_detail_permintaan,$id_brg,$jumlah)
	{
		if(!empty($id_detail_permintaan))
			{
			if(!empty($id_brg))
				{
				if(!empty($jumlah))
					{
						$this->id_detail_permintaan = mySQL_escape_string($id_detail_permintaan);
						$this->id_brg = mySQL_escape_string($id_brg);
						$this->jumlah = mySQL_escape_string($jumlah);
						$this->data = array(
						'id_detail_permintaan' => $this->id_detail_permintaan,
						'id_brg' => $this->id_brg,
						'jumlah' => $this->jumlah
						);
						$this->statement = $this->dbh->prepare($queryupdetailperminta);
						$this->statement->execute($this->data);							
					}
				else
					{
					echo '<script type="text/javascript">confirm("Jumlah Kosong")</script>';
					echo "Jumlah Kosong";
					}					
				}
			else
				{
				echo '<script type="text/javascript">confirm("Nama Barang Kosong")</script>';
				}
			}
		else
			{
			echo '<script type="text/javascript">confirm("Id_detail_permintaan kosong")</script>';
			}
    }		
}

// instansi class
$masukdetailpermintaan = new Querydetailpermintaan;
?>