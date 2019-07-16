<?php
session_start();
$bdd= new PDO('mysql:dbname=webproject;host=localhost','root','');

if (!empty($_POST) && !empty($_POST['idMessage'])) {
    
    $req = $bdd->prepare("DELETE FROM `message` WHERE `message`.`id` = ?");
    $req ->execute([$_POST['idMessage']]);  
    
}

?>
