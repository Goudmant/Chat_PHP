<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<form action='#' method='post'>
  <label for="pseudo">Pseudo:</label><br>
  <input type="text" id="fname" name="pseudo"><br>
  <label for="mail">Mail:</label><br>
  <input type="email" id="mail" name="mail"><br>
  <label for="password">Mot de passe:</label><br>
  <input type="password" id="password" name="password"><br>
  <input type="submit" name='submit' value="Submit">

</form>


<?php
require_once('C:\MAMP\htdocs\Chat_PHP\htdocs\models\modelUser.php');
require_once('C:\MAMP\htdocs\Chat_PHP\htdocs\models\modelUserManager.php');
$newUserManager = new UserManager('becode');

if(isset($_POST['submit'])){
    $newUser = new User([
        'pseudo' => $_POST['pseudo'],
        'mail' => $_POST['mail'],
        'password' => $_POST['password']
    ]);
    var_dump($newUser);
    $newUserManager->create($newUser);
}

?>

</body>
</html>



