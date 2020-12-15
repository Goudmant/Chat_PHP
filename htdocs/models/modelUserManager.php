<?php //connection à la BD et requêtes

require_once("C:\MAMP\htdocs\Chat_PHP\htdocs\models\modelDbConnect.php");

class UserManager extends DbConnect {

    // //Créer et mettre à jour dans une seule requete
    // //Nouvel objet -> utiliser create(un nouvel objet n'a pas d'ID)
    // //Objet pas nouveau -> utiliser update
    // public function save(User $newUser){
    //     if(is_null($newUser->id())){
    //         return $this->create($newUser);
    //     } else {
    //         return $this->update($newUser);
    //     }
    // }
    
    //passer en private si function save
    public function create(User $newUser) {
        $_pdo = $this->dbConnect();
        $createdUser = $_pdo->prepare('INSERT INTO users VALUES (NULL, :pseudo, :mail, :password)');
        $createdUser->bindValue(':pseudo', $newUser->pseudo(), PDO::PARAM_STR);
        $createdUser->bindValue(':mail', $newUser->mail(), PDO::PARAM_STR);
        $createdUser->bindValue(':password', $newUser->password(), PDO::PARAM_STR);

        $executeIsOk = $createdUser->execute();

        if(!$executeIsOk){
            return false;
        } else {
            //Je récupère l'ID auto-incrémenté (fonction native lastInsertId).
            $id = $_pdo->lastInsertId();
            $newUser = $this->read($id);
            return true;
        }
    }

    //Récupère un objet à partir d'un champs de la table (ex : Id)
    public function read($id){
        $_pdo = $this->dbConnect();
        $readedUser = $_pdo->prepare('SELECT * FROM users WHERE id = :id');
        $readedUser->bindValue(':id', $id, PDO::PARAM_INT);
        $executeIsOk = $readedUser->execute();

        if($executeIsOk){
           $user = $readedUser->fetchObject('User');
           if($user === false){
               return null;
           } else {
               return $user;
           }
        } else {
            return false;
        }
    }
    
    //Met à jour un objet de la base de donnée
    //Ici en private car la function save est public
    public function update(User $newUser){
        $_pdo = $this->dbConnect();
        $updatedUser = $_pdo->prepare('UPDATE users set pseudo=:pseudo, mail=:mail, password=:password WHERE id=:id LIMIT 1');
        $updatedUser->bindValue(':pseudo', $newUser->pseudo(), PDO::PARAM_STR);
        $updatedUser->bindValue(':mail', $newUser->mail(), PDO::PARAM_STR);
        $updatedUser->bindValue(':password', $newUser->password(), PDO::PARAM_INT);
        return $updatedUser->execute();
    }

    //Supprimer un élément de la base de donnée
    public function delete(User $newUser) {
        $_pdo = $this->dbConnect();
        $deletedUser = $_pdo->prepare('DELETE FROM user WHERE id = :id LIMIT 1');
        $deletedUser->bindValue(':id', $newUser->id(), PDO::PARAM_INT);
        return $deletedUser->execute();
    }
}