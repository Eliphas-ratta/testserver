<?php

// Connexion à la BDD
$pdo = new PDO('mysql:host=localhost;dbname=shop','root','root', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));

require_once("fonction.php");


$msg = "";

session_start();


?>