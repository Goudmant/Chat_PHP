<?php
class message extends Controller{

    function index (){
        $d = array();
        $this->loadModel ('message2');
        $this->messagem->table;
        $d['id'] = array(
            'pseudo' => 'Navy',
            'discription' => 'Je créé un MVC',
            
        );
        $this->set($d);
        $this->render('index');
    }

}


?>