<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>projet de groupe chat-PHP</title>
</head>
<body>
<h1>BlablaChat sY tV A-N le FLO !<h1>
    <div class="form">
        <form> method="POST" action="default.php">
            <h4>Votre pseudo : <input type="text" name="pseudo"></h4>
            <h4>Votre message : <input type="text" name="message"></h4>
            <input type="submit" name="submit" value="envoyer">   
        </form>
    </div>
    <div class="message">
        <?php 
        try {
        include ('controller.php');
        $afficher = $bdd->query("SELECT * FROM 'users' ORDER BY id DESC LIMIT 'ROOT, 'ROOT' ");
        while ($donnees = $afficher->fetch()) {
        ?>
        <p>
        <?php echo $donnees['dates_heure']; ?> <strong><?php echo $donnees['pseudo']; ?> ; </strong> <?php echo $donnees['message']; ?>
        </p>
        <?php 
        }
    }
        catch (Exception $e) {
            die('Erreur : ' .$e->getMessage());
        }
        ?>
    </div>
</body>
</html>
