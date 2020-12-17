<?php
class message2 extends Model {

    var $table = 'message1';
    
    function getLast($num=5){
        
        return $this->find (array(
            'limit'=>$num,
            'order'=>'id DESC'

        ));
    }
}

?>