<?php require_once('C:\MAMP\htdocs\Chat_PHP\htdocs\models\modelMessageManager.php');?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<form action='#' method='post'>
  <!-- <label for="pseudo">Pseudo:</label><br>
  <input type="text" id="fname" name="pseudo"><br> Pas de speudo car récupéré via session-->
  <label for="mail">Message:</label><br>
  <input type="text" id="message" name="message"><br>
  <input type="submit" name='submit' value="Submit">
</form>

<?php
$newAllMessage = new MessageManager ('becode');
if(isset($_POST['submit'])){
    $newMessage = new Message([
        'pseudo' => $_POST['pseudo'],
        'mail' => $_POST['mail'],
        'password' => $_POST['password']
    ])
$essai = $newAllMessage->getAllMessages();
var_dump($essai);

