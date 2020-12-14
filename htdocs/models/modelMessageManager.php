<?php //connection à la BD et requêtes

require_once("modelDbConnect.php");

class MessageManager extends DbConnect {
    
    //Récupère tous les messages du tableau.
    //@param : pas de paramètre, donc on utilise query
    public function getAllMessages() {
        $_pdo = $this->dbConnect();
        $messages = $_pdo->query('SELECT message, DATE_FORMAT(post_date, \'%d/%m/%Y à %Hh%imin%ss\') AS message_date FROM messages ORDER BY message_date DESC LIMIT 0, 30');
        $arrayMessages = [];
        $messages->execute();
        while ($donnees = $messages->fetch(PDO::FETCH_ASSOC)){
            $arrayMessages[] = $donnees;
        }
        return $arrayMessages;
    }
    
    public function getUserMessages($userId) {

        $messages = $_pdo->prepare('SELECT message, DATE_FORMAT(post_date, \'%d/%m/%Y à %Hh%imin%ss\') AS message_user FROM messages WHERE i_userd = ? ORDER BY message_date DESC');




        class PostManager {

            //PDO $pdo objet = instance de PDO lié à la base de données "openclassroom'. Comme la connexion va être initialisée dans plusieurs méthodes, il est utile de la stocker dans une variable d'objet.
            private $_db;
        
            //PDOStatement $pdoStatement objet PDOStatement résultant de l'utilisationdes méthodes PDO::query et PDO::prepare. PDOStatement est un objet qui sera utilisé plusieurs fois, donc on le stocke dans une variable afin de l'utiliser dans les méthodes.
            private $_pdoStatement;
        
            //Initialisation de la connexion à la base de données
            public function __construct($_db){
                $this->setDb($_db);
            }
        
            //SETTER
            public function setDb($_db){
                $this->_db = $_db;
            }
        
            //REQUETES
            //Insérer un objet dans la base de données(objet en argument).
            //@param L'objet passé en argument n'a pas d'identifuant car il est auto-incrémenté. Le passage à la base de donnée doit lui conférer un ID unique.
            //@return bool true si l'objet est ajouté, false si une erreur survient.
            //Ici en private car la function save est public
            private function create(Post $newPost) {
                $this->_pdoStatement = $this->_db->prepare('INSERT INTO blog_articles VALUES (NULL, :titre, :contenu)');
                $this->_pdoStatement->bindValue(':titre', $newPost->titre(), \PDO::PARAM_STR);
                $this->_pdoStatement->bindValue(':contenu', $newPost->contenu(), \PDO::PARAM_STR);
        
                $executeIsOk = $this->_pdoStatement->execute();
        
                if(!$executeIsOk){
                    return false;
                } else {
                    //Je récupère l4ID auto-incrémenté (fonction native lastInsertId).
                    $id = $this->_db->lastInsertId();
                    $newPost = $this->read($id);
                    return true;
                }
            }
        
            //Récupère un objet à partir d'un champs de la table (ex : Id)
            public function read($id){
                $this->_pdoStatement = $this->_db->prepare('SELECT * FROM blog_articles WHERE id = :id');
                $this->_pdoStatement->bindValue(':id', $id, \PDO::PARAM_INT);
                $executeIsOk = $this->_pdoStatement->execute();
        
                if($executeIsOk){
                   $post = $this->_pdoStatement->fetchObject('POO\Post');
                   if($post === false){
                       return null;
                   } else {
                       return $post;
                   }
                } else {
                    return false;
                }
            }
        
            
        
            //Met à jour un objet de la base de donnée
            //Ici en private car la function save est public
            private function update(Post $newPost){
                $this->_pdoStatement = $this->_db->prepare('UPDATE blog_articles set titre= :titre, contenu=:contenu WHERE id=:id LIMIT 1');
                $this->_pdoStatement->bindValue(':titre', $newPost->titre(), \PDO::PARAM_STR);
                $this->_pdoStatement->bindValue(':contenu', $newPost->contenu(), \PDO::PARAM_STR);
                $this->_pdoStatement->bindValue(':id', $newPost->id(), \PDO::PARAM_INT);
                return $this->_pdoStatement->execute();
            }
        
            //Supprimer un élément de la base de donnée
            public function delete(Post $newPost) {
                $this->_pdoStatement = $this->_db->prepare('DELETE FROM blog_articles WHERE id = :id LIMIT 1');
                $this->_pdoStatement->bindValue(':id', $newPost->id(), \PDO::PARAM_INT);
                return $this->_pdoStatement->execute();
            }
        
            //Créer et mettre à jour dans une seule requete
            //Nouvel objet -> utiliser create(un nouvel objet n'a pas d'ID)
            //Objet pas nouveau -> utiliser update
            public function save(Post $newPost){
                if(is_null($newPost->id())){
                    return $this->create($newPost);
                } else {
                    return $this->update($newPost);
                }
            }
        }
}