<?php

class DbConnect {

    private $_servname;
    private $_dbname;
    private $_user;
    private $_pass;
    private $_pdo;

    public function __construct($_dbname, $_servname = 'localhost', $_user = 'root', $_pass = 'root'){
        $this->_dbname = $_dbname;
        $this->_servname = $_servname;
        $this->_user = $_user;
        $this->_pass = $_pass;

        if($this->_pdo === null){
            try {                
                $this->_pdo = new PDO('mysql:host=localhost;dbname=' .$this->_dbname, $this->_user, $this->_pass, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
                $this->_pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); //PDO::ERRMODE_EXCEPTION - lance une exception.
            }
            catch(PDOException $e){
                $msg = 'ERREUR PDO dans ' . $e->getFile() . ' L.' . $e->getLine() . ' : ' . $e->getMessage();
                die($msg);
            }
        } 
    }

    // Connexion PDO
    protected function DbConnect(){
        return $this->_pdo;        
    }
}