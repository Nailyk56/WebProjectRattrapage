<?php
session_start();
$bdd= new PDO('mysql:dbname=webproject;host=localhost','root','');

if (!empty($_POST) && !empty($_POST['idcategorie'])) {
    var_dump($_POST['idcategorie']);
    
    $req = $bdd->prepare("DELETE FROM message WHERE message.id_sujet IN (SELECT sujet.id FROM sujet WHERE sujet.id_categorie = ?)");
    $req ->execute([$_POST['idcategorie']]);  
    $req->closeCursor();
     
    $req2 = $bdd->prepare("DELETE FROM sujet WHERE sujet.id_categorie = ?");
    $req2 ->execute([$_POST['idcategorie']]);  
    $req2->closeCursor();
     
    
    $req3 = $bdd->prepare("DELETE FROM categorie WHERE categorie.id = ?");
    $req3 ->execute([$_POST['idcategorie']]);  
    $req3->closeCursor();
     
}

    
?>
