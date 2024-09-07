<?php
  class Database{
    public $conn;
    public $sName = 'localhost';
    public $uName = 'root';
    public $pass = '';
    public $db_name = 'smartfarm';
    public function __construct() {
      try {
          $this -> conn = new PDO("mysql:host=$this->sName;dbname=$this->db_name", $this->uName, $this->pass);
          // set the PDO error mode to exception
          $this -> conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch(PDOException $e) {
          $e->getMessage();
        }
    }

    public function __destruct() {
      /** Dong ket noi */
      try {
        $this-> conn = null;
      } catch(PDOException $e) {$e->getMessage();	
      }
    }
  }
 
?>