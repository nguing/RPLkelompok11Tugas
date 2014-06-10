<?php
require '../queryumum.php';
class Querypengadaan extends Queryumum 
{
    public function Insertpengadaan($querypenga,$no_faktur,$tanggal_pengadaan,$id_rekanan,$keterangan)
	{
		if(!empty($no_faktur))
			{
			if(!empty($tanggal_pengadaan))
				{
				if(!empty($id_rekanan))
					{
					if(!empty($keterangan))
						{
						$this->no_faktur = mySQL_escape_string($no_faktur);
						$this->tanggal_pengadaan = mySQL_escape_string($tanggal_pengadaan);
						$this->id_rekanan = mySQL_escape_string($id_rekanan);
						$this->keterangan = mySQL_escape_string($keterangan);
						$this->data = array(
						'no_faktur' => $this->no_faktur,
						'tanggal_pengadaan' => $this->tanggal_pengadaan,
						'id_rekanan' => $this->id_rekanan,
						'keterangan' => $this->keterangan
						);
						$this->statement = $this->dbh->prepare($querypenga);
						$this->statement->execute($this->data);							
						}	
					else
						{
						echo '<script type="text/javascript">confirm("Keterangan Pengadaan Kosong")</script>';
						}
					}
				else
					{
					echo '<script type="text/javascript">confirm("Rekanan Kosong")</script>';
					}					
				}
			else
				{
				echo '<script type="text/javascript">confirm("Tanggal Pengadaan Kosong")</script>';
				}
			}
		else
			{
			echo '<script type="text/javascript">confirm("Nomor Faktur kosong")</script>';
			}
    }	
}

// instansi class
$masukpengadaan = new Querypengadaan;
?>