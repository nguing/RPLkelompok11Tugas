<?php
class Database extends PDO {
    protected $dsn = 'mysql:dbhost=localhost;dbname=inventory_ft'; // server dan nama db
    protected $user = 'root'; // username db
    protected $password = ''; // paswword db
    
    public function __construct(){
        // koneksi database   
        try{
            $this->dbh = new PDO($this->dsn,$this->user,$this->password);
        // test koneksi
        //    echo 'Koneksi Berhasil <br />';
        }
        catch(PDOException $e){
        // test error
        //    echo 'Gagal Koneksi '.$e->getMessage();
        }
    }
}
?>