<?php
require '../queryumum.php';
class Queryrekanan extends Queryumum 
{
    public function Insertrekan($queryrekan,$id_rekanan,$rekanan,$telp,$alamat)
	{
		if(!empty($id_rekanan))
			{
			if(!empty($rekanan))
				{
				if(!empty($telp))
					{
					if(!empty($alamat))
						{
						$this->id_rekanan = mySQL_escape_string($id_rekanan);
						$this->rekanan = mySQL_escape_string($rekanan);
						$this->telp = mySQL_escape_string($telp);
						$this->alamat = mySQL_escape_string($alamat);
						$this->data = array(
						'id_rekanan' => $this->id_rekanan,
						'rekanan' => $this->rekanan,
						'telp' => $this->telp,
						'alamat' => $this->alamat
						);
						$this->statement = $this->dbh->prepare($queryrekan);
						$this->statement->execute($this->data);							
						}	
					else
						{
						echo '<script type="text/javascript">confirm("Alamat Rekanan Kosong")</script>';
						echo "Alamat Rekanan Kosong";
						}
					}
				else
					{
					echo '<script type="text/javascript">confirm("Contact Person Kosong")</script>';
					}					
				}
			else
				{
				echo '<script type="text/javascript">confirm("Nama Rekanan Kosong")</script>';
				}
			}
		else
			{
			echo '<script type="text/javascript">confirm("ID Rekanan kosong")</script>';
			}
    }	
}

// instansi class
$masukrekanan = new Queryrekanan;
?>