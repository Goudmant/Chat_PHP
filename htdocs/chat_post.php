<?php
    try {
        include('config.php');
        $req = $bdd->prepare('INSERT INTO chat_post(pseudo, message, date_heure) VALUES(:pseudo, :message, NOW())');
        $req-> execute(array(
            'pseudo'=> $_POST['pseudo'],
            'message'=> $_POST['message']
        ));
        header('Location: index.php');
    }
catch (Exception $e) {
    
}
?>