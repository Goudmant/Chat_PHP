<?php
 class User {
     private $_id;
     private $_pseudo;
     private $_mail;
     private $_password;

     //GETTERS
    public function id(){
        return $this->_id;
    }
    public function pseudo(){
        return $this->_pseudo;
    }
    public function mail(){
        return $this->_mail;
    }
    public function password(){
        return $this->_password;
    }

    //SETTERS
    //Si l'ID est géréré automatiquement par msql (auto-increment), il sera généré par le SGBDR, donc pas de setter à prévoir.
    public function setPseudo($_pseudo){
        if(is_string($_pseudo)){
            $this->_pseudo = $_pseudo;
        }
        else{
            echo 'Le pseudo est trop long';
        }
    }
    public function setMail($_mail){
        if(is_string($_mail)){
            $this->_mail = $_mail;
        }
        else{
            echo 'Le mail n\'est pas au bon format';
        }
    }
    public function setPassword($_password){
        if(is_string($_password)){
            $this->_password = $_password;
        }
        else{
            echo 'Le password n\'est pas au bon format';
        }
    }

    //HYDRATATION DE L'OBJET
    public function hydrate(array $donnees){
        foreach ($donnees as $key => $value){
            $method = 'set'.ucfirst($key);
            if(method_exists($this, $method)){
                $this->$method($value);
            }
        }
    }

    //Implémenter __construct pour qu'on puisse directement hydrater l'objet lors de l'instanciation de la class User
    public function __construct (array $donnees = array()){
        if(!empty($donnees)) {
            $this->hydrate($donnees);
        }
    }
}
