<?php
require 'database.php';
class Queryumum extends Database {

    public function Que($que){
        // fungsi menampilkan data dari database 

        $this->statement = $this->dbh->prepare($que);		
        $this->statement->execute();
        return $this->statement->fetchAll();
    }
}

// instansi class
//$tampil = new Queryumum;
?>