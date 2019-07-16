<?php
session_start();
$bdd= new PDO('mysql:dbname=webproject;host=localhost','root','');

if (!empty($_POST)) {

    $errors = array();

    if (!empty($_POST['nom']) && !preg_match('/^[a-zA-Z0-9_]+$/', $_POST['nom'])) {

        $errors = "Votre nom est incorrect, veuillez utiliser uniquement des mininuscules, majuscules, chiffres et _";
        var_dump($errors);
    }
    if (!empty($_POST['prenom']) && !preg_match('/^[a-zA-Z0-9_]+$/', $_POST['prenom'])) {

        $errors = "Votre prénom est incorrect, veuillez utiliser uniquement des mininuscules, majuscules, chiffres et _";
        var_dump($errors);
    }
    if (!empty($_POST['email']) && !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
        //VERIFICATION D EMAIL
        $errors = "Veuillez utiliser une adresse mail correcte";
        var_dump($errors);
    }
    if (!empty($_POST['mdp']) && !preg_match('/^[a-zA-Z0-9_]+$/', $_POST['mdp'])) {

        $errors = "Votre mot de passe est incorrect, veuillez utiliser uniquement des mininuscules, majuscules, chiffres et _";
        var_dump($errors);
    }
    if (!empty($_POST['mdpconf']) && $_POST['mdpconf'] != $_POST['mdp']) {

        $errors = "Mot de passe non identique";
        var_dump($errors);
    }
    
    if(empty($errors)){
        $req= $bdd->prepare("INSERT INTO utilisateur SET nom=?, prenom=?, email=?, mot_de_passe=?");
        $req ->execute([$_POST['nom'],$_POST['prenom'],$_POST['email'],$_POST['mdp']]);
    }

}
?>




<html>
<?php
include 'Header.php';
?>  
    <head>
        <meta charset="utf-8" />
        <link rel="stylesheet" href="../css/Inscription.css">
        <title>Inscription</title>    
    </head>  

    <section>
        <div class="FormInscription">
            <form action="" method="POST">
                <input class="remplissage" type="text" name="nom" placeholder="Nom">
                <input class="remplissage" type="text" name="prenom" placeholder="Prénom">
                <input class="remplissage" type="email" name="email" placeholder="Email">
                <input class="remplissage" type="password" name="mdp" placeholder="Mot de Passe">
                <input class="remplissage" type="password" name="mdpconf" placeholder="Confirmation de votre mot de passe">
                <button class="remplissage" name="Envoyer" type="submit" method="POST">Inscription</button>

            </form>




        </div>




    </section>

<?php
include 'Footer.php';
?>


</html>
