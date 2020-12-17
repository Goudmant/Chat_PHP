<?php
class message extends Controller{

    function index (){
        
        $this->loadModel ('message2');
        $d ['navy'] - $this->message2->getLast();
        print_r($d);
        $this->set($d);
        $this->render('index');
    }

}


?>