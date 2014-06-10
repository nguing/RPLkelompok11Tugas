<?php
require '../queryumum.php';
class Queryukerja extends Queryumum 
{
    public function Insertukerja($queryukerja,$id_unit_kerja,$unit_kerja)
	{
		if(!empty($id_unit_kerja))
			{
				if(!empty($unit_kerja))
					{
					$this->id_unit_kerja = mySQL_escape_string($id_unit_kerja);
					$this->unit_kerja = mySQL_escape_string($unit_kerja);
					$this->data = array(
					'id_unit_kerja' => $this->id_unit_kerja,
					'unit_kerja' => $this->unit_kerja
					);
					$this->statement = $this->dbh->prepare($queryukerja);
					$this->statement->execute($this->data);		
					}
				else
					{
					echo '<script type="text/javascript">confirm("Nama Unit Kerja Kosong")</script>';
					}
			}
		else
			{
			echo '<script type="text/javascript">confirm("ID Unit Kerja kosong")</script>';
			}
    }	
}

// instansi class
$masukunitkerja = new Queryukerja;
?>