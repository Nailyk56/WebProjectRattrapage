<?php
session_start();
$bdd= new PDO('mysql:dbname=webproject;host=localhost','root','');

if (!empty($_POST) && !empty($_POST['idSujet'])) {
    
    $req = $bdd->prepare("DELETE FROM `message` WHERE message.id_sujet = ?");
    $req ->execute([$_POST['idSujet']]);  
    
    $req2 = $bdd->prepare("DELETE FROM `sujet` WHERE sujet.id = ?");
    $req2 ->execute([$_POST['idSujet']]);  
}

?>
