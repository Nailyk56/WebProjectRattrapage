<?php
session_start();
$bdd= new PDO('mysql:dbname=webproject;host=localhost','root','');

if (!empty($_POST)) {
    $errors = array();
    
    if (empty($_POST['nomsujet']) && empty($_POST['topic']) && !preg_match('/^[a-zA-Z0-9\s]+$/', $_POST['topic']) && !preg_match('/^[a-zA-Z0-9_]+$/', $_POST['nomsujet'])) {

        $errors = "Veuillez remplir tous les champs, veuillez utiliser uniquement des mininuscules, majuscules, chiffres et _ pour le nom du sujet.";
        var_dump($errors);
    }else{
        $req = $bdd->prepare("INSERT INTO sujet SET nom=?,date_creation=NOW(),type_sujet=?,id_user=?,id_categorie=?" );
        $req ->execute([$_POST['nomsujet'],$_POST['typetopic'],$_SESSION['iduser'],$_COOKIE['idcategorie']]);
        $req2 = $bdd->prepare("SELECT MAX(id) AS idsujet FROM sujet");
        $req2 ->execute();
        $monidsujet = $req2->fetch();
        $req3= $bdd->prepare("INSERT INTO message SET contenu=?, date_post=NOW(), id_posteur=?, id_sujet=?");
        $req3 ->execute([$_POST['topic'],$_SESSION['iduser'],$monidsujet['idsujet']]);
    }
   
}


?>

<html>
    <head>
        <meta charset="utf-8" />
        <link rel="stylesheet" href="../css/Addsujet.css">
        <title>Ajouter un sujet</title>    
    </head>
    <?php
    include 'Header.php';
    ?>
    
     <section>
        <div class="FormNewSujet">
            <form action="" method="POST">
                <input class="remplissage alignement" type="text" name="nomsujet" placeholder="Nom du nouveau sujet">
                <textarea name="topic" class="alignement" maxlength="1000" placeholder="Ecrivez votre commentaire"></textarea>
                <select name="typetopic">
                    <option value="0">Prive</option>
                    <option value="1">Public</option>
                </select>
                <button class="remplissage" name="Creer" type="submit" method="POST">Créer</button>
                
            </form>
              <a href="Forum.php"><button  name="Retour" type="submit">Retour</button></a>

        </div>


    </section>



    <?php
    include 'Footer.php';
    ?>
    
    
    
</html>