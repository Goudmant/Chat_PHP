<?php //connection à la BD et requêtes

require_once("C:\MAMP\htdocs\Chat_PHP\htdocs\models\modelDbConnect.php");

class MessageManager extends DbConnect {
    
    //Récupère tous les messages du tableau.
    //@param : pas de paramètre, donc on utilise query
    public function getAllMessages() {
        $_pdo = $this->dbConnect();
        $allMessages = $_pdo->query('SELECT message, DATE_FORMAT(post_date, \'%d/%m/%Y à %Hh%imin%ss\') AS message_date FROM messages ORDER BY message_date DESC LIMIT 0, 30');
        // return $allMessages;
        $arrayMessages = [];
        $allMessages->execute();
        while ($donnees = $allMessages->fetch(PDO::FETCH_ASSOC)){
            $arrayMessages[] = $donnees;
        }
        return $arrayMessages;
    }
    
    // public function getUserMessages($id_user) {
    //     $_pdo = $this->dbConnect();
    //     $userMessages = $_pdo->prepare('SELECT message, DATE_FORMAT(post_date, \'%d/%m/%Y à %Hh%imin%ss\') AS messages_user FROM messages WHERE id_user=:id_user ORDER BY messages_user DESC LIMIT 0, 30');
    //     $userMessages->bindValue(':id_user', $id_user, PDO::PARAM_INT);
    //     $userMessages->execute();
    //     return $userMessages;
    //     // $userMessages = $messages->fetch();
    //     // return $userMessages;
    // }
            
    // public function createMessage(Message $newMessage){
    //     $_pdo = $this->dbConnect();
    //     $createdMessage = $db->prepare('INSERT INTO messages VALUES(NULL, :message, NOW(), :id_user)');
    //     $createdMessage->bindValue(':message', $newMessage->message(), PDO::PARAM_STR);
    //     $createdMessage->bindValue(':id_user', $newMessage->idUser(), PDO::PARAM_INT)
    //     $executeIsOk = $createdMessage->execute();
    //     if(!$executeIsOk){
    //         return false;
    //     } else {
    //         //Je récupère l'ID auto-incrémenté (fonction native lastInsertId).
    //         $id = $this->_db->lastInsertId();
    //         $newMessage = $this->read($id);
    //         return true;
    //     }
    // }
    //     return $affectedLines;
    // }

        
    //         //REQUETES
    //         //Insérer un objet dans la base de données(objet en argument).
    //         //@param L'objet passé en argument n'a pas d'identifuant car il est auto-incrémenté. Le passage à la base de donnée doit lui conférer un ID unique.
    //         //@return bool true si l'objet est ajouté, false si une erreur survient.
    //         //Ici en private car la function save est public
    //         private function create(Post $newPost) {
    //             $this->_pdoStatement = $this->_db->prepare('INSERT INTO blog_articles VALUES (NULL, :titre, :contenu)');
    //             $this->_pdoStatement->bindValue(':titre', $newPost->titre(), \PDO::PARAM_STR);
    //             $this->_pdoStatement->bindValue(':contenu', $newPost->contenu(), \PDO::PARAM_STR);
        
    //             $executeIsOk = $this->_pdoStatement->execute();
        
    //             if(!$executeIsOk){
    //                 return false;
    //             } else {
    //                 //Je récupère l4ID auto-incrémenté (fonction native lastInsertId).
    //                 $id = $this->_db->lastInsertId();
    //                 $newPost = $this->read($id);
    //                 return true;
    //             }
    //         }
        
    //         //Récupère un objet à partir d'un champs de la table (ex : Id)
    //         public function read($id){
    //             $this->_pdoStatement = $this->_db->prepare('SELECT * FROM blog_articles WHERE id = :id');
    //             $this->_pdoStatement->bindValue(':id', $id, \PDO::PARAM_INT);
    //             $executeIsOk = $this->_pdoStatement->execute();
        
    //             if($executeIsOk){
    //                $post = $this->_pdoStatement->fetchObject('POO\Post');
    //                if($post === false){
    //                    return null;
    //                } else {
    //                    return $post;
    //                }
    //             } else {
    //                 return false;
    //             }
    //         }
        
            
        

        
    //         //Supprimer un élément de la base de donnée
    //         public function delete(Post $newPost) {
    //             $this->_pdoStatement = $this->_db->prepare('DELETE FROM blog_articles WHERE id = :id LIMIT 1');
    //             $this->_pdoStatement->bindValue(':id', $newPost->id(), \PDO::PARAM_INT);
    //             return $this->_pdoStatement->execute();
    //         }
        
    //         //Créer et mettre à jour dans une seule requete
    //         //Nouvel objet -> utiliser create(un nouvel objet n'a pas d'ID)
    //         //Objet pas nouveau -> utiliser update
    //         public function save(Post $newPost){
    //             if(is_null($newPost->id())){
    //                 return $this->create($newPost);
    //             } else {
    //                 return $this->update($newPost);
    //             }
    //         }
    //     }
}