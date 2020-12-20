<?php
    $pdo_otpions[PDO:: ATTR_ERRMODE] = PDO:: ERRMODE_EXCEPTION;
    $bdd = new PDO('mysql: host=localhost; dbname=my_database', 'ROOT', '', $pdo_otpions);
?>