<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<?php
session_start();
include('phpscripts/functions.php');
$db = db_connect();
?>
<h1>Le Chat NavyFlo</h1>
<?php
// permettra de créer l'utilisateur lors de la validation du formulaire
if(isset($_POST['pseudo']) AND !preg_match("#^[-. ]+$#", $_POST['pseudo'])) {
}

/* Si l'utilisateur n'est pas connecté, 
d'où le ! devant la fonction, alors on affiche le formulaire */
if(!user_verified()) {
?>
<div class="unlog">
	<form action="" method="post">
	Indiquez votre pseudo afin de vous connecter au chat. 
	Aucun mot de passe n'est requis. Entrez simplement votre pseudo.<br><br>
				
	<!--<center>
		<input type="text" name="login" placeholder="Pseudo" /><br />
                <input type="password" name="pass" placeholder="Mot de passe" /><br /> 
		<input type="submit" value="Connexion" />
	</center>-->
	</form>
</div>
<?php
} else {
?>
<table class="post_message"><tr>

</body>
<?php
/* On crée la variable login qui prend la valeur POST envoyée
car on va l'utiliser plusieurs fois */
$id = $_POST['id'];
$pass = $_POST['pass'];
			
// On crée une requête pour rechercher un compte ayant pour nom $login
$query = $db->prepare("SELECT * FROM chat_accounts WHERE account_login = :login");
$query->execute(array(
	'login' => $login
));
// On compte le nombre d'entrées
$count=$query->rowCount();
			
// Si ce nombre est nul, alors on crée le compte, sinon on le connecte simplement
if($count == 0) {			
	// Création du compte
	$insert = $db->prepare('
		INSERT INTO chat_accounts (account_id, account_login, account_pass) 
		VALUES(:id, :login, :pass)
	');
	$insert->execute(array(
		'id' => '',
		'login' => htmlspecialchars($login),
		'pass' => md5($pass)
	));
				
	/* Création d'une session id ayant pour valeur le dernier ID créé
	par la dernière requête SQL effectuée */
	$_SESSION['id'] = $db->lastInsertId();
	$_SESSION['login'] = $login;
} else {
	$data = $query->fetch();	
				
	if($data['account_pass'] == md5($pass)) {			
		$_SESSION['id'] = $data['account_id'];
		$_SESSION['pseudo'] = $data['account_pseudo'];
	}
}
			
// On termine la requête
$query->closeCursor();
?>
</html>