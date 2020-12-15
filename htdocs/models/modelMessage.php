<?php
 class Message {
     private $_id;
     private $_message;
     private $_post_date;
     private $_id_user;

     //GETTERS
    public function id(){
        return $this->_id;
    }
    public function message(){
        return $this->_message;
    }
    public function post_date(){
        return $this->_post_date;
    }
    public function id_user(){
        return $this->_id_user;
    }

    //SETTERS
    //Si l'ID est géréré automatiquement par msql (auto-increment), il sera généré par le SGBDR, donc pas de setter à prévoir.
    public function setMessage($_message){
        if(is_string($_message)){
            $this->_message = $_message;
        }
        else{
            echo 'Le pseudo est trop long';
        }
    }
    public function setMail($_post_date){
        if(is_string($_post_date)){
            $this->_mail = $_mail;
        }
        else{
            echo 'Le mail n\'est pas au bon format';
        }
    }
    public function setPassword($_id_user){
        if(is_string($_id_user)){
            $this->_id_user = $_id_user;
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
