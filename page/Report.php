<?php
session_start();
$bdd= new PDO('mysql:dbname=webproject;host=localhost','root','');

 
$req = $bdd->prepare("SELECT * FROM utilisateur WHERE role= 0");
$req->execute();
 $listeBDE = $req->fetchAll();
 
 $contenumail = "D'après ".$_SESSION['nomuser']." ".$_SESSION['prenomuser'].", ce contenu est inapproprié : \r\n".$_POST['contenu']; 
 foreach ($listeBDE as $listeadmin){
      
     mail($listeadmin['email'], 'Mon Sujet', $contenumail);

 }
    echo "Envoie mail";
 

?>