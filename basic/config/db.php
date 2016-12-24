<?php
  class db{
    private $db_host = 'localhost';
    private $db_user = 'root';
    private $db_pass = 'rntnsdl';
    private $db_name = 'u4bi';
    
    /* 연결*/
    public function connect(){
      $mysql_connect_str ="mysql:host=$this->db_host; dbname=$this->db_name";
      $dbConnection = new PDO($mysql_connect_str, $this->db_user, $this->db_pass);
      /* http://php.net/manual/kr/pdo.connections.php */
      
      $dbConnection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      /* http://php.net/manual/kr/pdo.setattribute.php */
      return $dbConnection;
    }
  }
?>