<?php
    class db{
        // 속성
        private $dbhost = 'localhost';
        private $dbuser = 'root';
        private $dbpass = 'root940617';
        private $dbname = 'u4bi';

        // 콘텐트
        public function connect(){
            
            $mysql_connect_str = "mysql:host=$this->dbhost;dbname=$this->dbname";
            
            $dbConnection = new PDO($mysql_connect_str, $this->dbuser, $this->dbpass);
            $dbConnection -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            
            return $dbConnection;
        }
    }