<?php
require '../queryumum.php';
class Queryjenisbarang extends Queryumum 
{
    public function Insertjb($queryjbrg,$id_jenis,$jenis_brg)
	{
		if(!empty($id_jenis))
			{
				if(!empty($jenis_brg))
					{
					$this->queryjbrg = $queryjbrg;
					$this->id_jenis = mySQL_escape_string($id_jenis);
					$this->jenis_brg = mySQL_escape_string($jenis_brg);
					$this->data = array(
					'id_jenis' => $this->id_jenis,
					'jenis_brg' => $this->jenis_brg
					);
					$this->statement = $this->dbh->prepare($queryjbrg);
					$this->statement->execute($this->data);		
					}
				else
					{
					echo '<script type="text/javascript">confirm("Jenis Barang Kosong")</script>';
					}
			}
		else
			{
			echo '<script type="text/javascript">confirm("ID jenis Barang kosong")</script>';
			}
    }
	
    public function Updatesavejb($queujb,$id_jenis,$jenis_brg)
	{
		if(!empty($id_jenis))
		{
			if(!empty($jenis_brg))
				{
					$this->queryjbrg = $queryjbrg;
					$this->id_jenis = mySQL_escape_string($id_jenis);
					$this->jenis_brg = mySQL_escape_string($jenis_brg);					
					$this->data = array(
					'id_jenis' => $this->id_jenis,
					'jenis_brg' => $this->jenis_brg
					);
					$this->statement = $this->dbh->prepare($queujb);
					$this->statement->execute($this->data);
				}
			else
				{
				echo '<script type="text/javascript">confirm("Jenis Barang Kosong")</script>';
				}
		}
		else
			{
			echo '<script type="text/javascript">confirm("ID jenis Barang kosong")</script>';
			}
	}	
	
}

// instansi class
$masukjb = new Queryjenisbarang;
?>