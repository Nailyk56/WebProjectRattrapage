<?php
session_start();
$bdd= new PDO('mysql:dbname=webproject;host=localhost','root','');

if (!empty($_POST) && !empty($_POST['email'])) {
    
    $req = $bdd->prepare("UPDATE utilisateur SET role=1 WHERE email=? ");
    $req ->execute([$_POST['email']]);
    
}

?>
