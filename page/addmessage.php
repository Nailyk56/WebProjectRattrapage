<?php
session_start();
$bdd= new PDO('mysql:dbname=webproject;host=localhost','root','');

if (!empty($_POST)) {
    $errors = array();
    
    if (!empty($_POST['contenu']) && !preg_match('/^[a-zA-Z0-9_\s]+$/', $_POST['contenu'])) {

        $errors = "Votre message est incorrect, veuillez utiliser uniquement des mininuscules, majuscules, chiffres";
        
    }else{
        $req = $bdd->prepare("INSERT INTO message SET contenu=?, date_post=NOW(), id_posteur=?, id_sujet=?");
        $req ->execute([$_POST['contenu'],$_SESSION['iduser'],$_COOKIE['idSujet']]);
    }
       
}

?>


<html>
    <head>
        <meta charset="utf-8" />
        <link rel="stylesheet" href="../css/Addmessage.css">
        <title>Ajouter une catégorie</title>    
    </head>
    <?php
    include 'Header.php';
    ?>
    
     <section>
        <div class="FormNewMessage">
            <form action="" method="POST">
                <textarea class="remplissage alignement" type="text" name="contenu" placeholder="Contenu du message"></textarea>
                <button class="remplissage alignement" name="Repondre" type="submit" method="POST">Répondre</button>
                
            </form>
              <a href="Forum.php"><button  name="Retour" type="submit">Retour</button></a>

        </div>


    </section>



    <?php
    include 'Footer.php';
    ?>
    
    
    
</html>