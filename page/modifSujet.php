<?php
session_start();
$bdd= new PDO('mysql:dbname=webproject;host=localhost','root','');

if (isset($_POST['nomsujet'])) {
    $errors = array();
    
    if (!empty($_POST['nomsujet']) && !preg_match('/^[a-zA-Z0-9_\s]+$/', $_POST['nomsujet'])) {

        $errors = "Votre nom est incorrect, veuillez utiliser uniquement des mininuscules, majuscules, chiffres et _";
        
    }else{
        $req = $bdd->prepare("UPDATE sujet SET nom=? WHERE id=?");
        $req ->execute([$_POST['nomsujet'],$_POST['idSujet']]);
    }
       
}

?>


<html>
    <head>
        <meta charset="utf-8" />
        <title>Ajouter une catégorie</title>    
    </head>
    <?php
    include 'Header.php';
    ?>
    
     <section>
        <div class="FormNewSujet">
            <form action="" method="POST">
                <input class="remplissage" type="text" name="nomsujet" placeholder="Nom du sujet">
                <button class="remplissage" name="Modifier" type="submit" method="POST">Modifier</button>
                <input name='idSujet' value='<?php echo $_POST['idSujet']?>' style="visibility: hidden"></input>
                
            </form>
              <a href="Forum.php"><button  name="Retour" type="submit">Retour</button></a>

        </div>


    </section>



    <?php
    include 'Footer.php';
    ?>
    
    
    
</html>