<?php
session_start();
$bdd= new PDO('mysql:dbname=webproject;host=localhost','root','');

if (isset($_POST['contenu'])) {
    $errors = array();
    
    if (!empty($_POST['contenu']) && !preg_match('/^[a-zA-Z0-9_\s]+$/', $_POST['contenu'])) {

        $errors = "Votre message est incorrect, veuillez utiliser uniquement des mininuscules, majuscules, chiffres";
        
    }else{
        $req = $bdd->prepare("UPDATE message SET contenu=? WHERE id=?");
        $req ->execute([$_POST['contenu'],$_POST['idMessage']]);
    }
       
}

?>


<html>
    <head>
        <meta charset="utf-8" />
        <link rel="stylesheet" href="../css/Modifmessage.css">
        <title>Ajouter une catégorie</title>    
    </head>
    <?php
    include 'Header.php';
    ?>
    
     <section>
        <div class="FormNewMessage">
            <form action="" method="POST">
                <textarea class="remplissage alignement" type="text" name="contenu" placeholder="Contenu du message"></textarea>
                <button class="remplissage alignement" name="Modifier" type="submit" method="POST">Modifier</button>
                <input name='idMessage' value='<?php echo $_POST['idMessage']?>' style="visibility: hidden"></input>
                
            </form>
              <a href="Forum.php"><button  name="Retour" type="submit">Retour</button></a>

        </div>


    </section>



    <?php
    include 'Footer.php';
    ?>
    
    
    
</html>