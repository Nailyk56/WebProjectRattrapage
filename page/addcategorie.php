<?php
session_start();
$bdd= new PDO('mysql:dbname=webproject;host=localhost','root','');

if (!empty($_POST)) {
    $errors = array();
    
    if (!empty($_POST['nomcategorie']) && !preg_match('/^[a-zA-Z0-9_]+$/', $_POST['nomcategorie'])) {

        $errors = "Votre nom est incorrect, veuillez utiliser uniquement des mininuscules, majuscules, chiffres et _";
        var_dump($errors);
    }else{
        $req = $bdd->prepare("INSERT INTO categorie SET nom=?");
        $req ->execute([$_POST['nomcategorie']]);               
    }
       
}







?>


<html>
    <head>
        <meta charset="utf-8" />
        <link rel="stylesheet" href="../css/Addcategorie.css">
        <title>Ajouter une catégorie</title>    
    </head>
    <?php
    include 'Header.php';
    ?>
    
     <section>
        <div class="FormNewCategorie">
            <form action="" method="POST">
                <input class="remplissage" type="text" name="nomcategorie" placeholder="Nouvelle catégorie">
                <button class="remplissage" name="Creer" type="submit" method="POST">Créer</button>
                
            </form>
              <a href="Forum.php"><button  name="Retour" type="submit">Retour</button></a>

        </div>


    </section>



    <?php
    include 'Footer.php';
    ?>
    
    
    
</html>