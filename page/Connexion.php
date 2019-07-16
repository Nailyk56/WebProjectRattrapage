<?php
session_start();



$bdd= new PDO('mysql:dbname=webproject;host=localhost','root','');

if(isset($_POST['Envoyer'])){
   
    $mailconnect= htmlspecialchars($_POST['email']);
    $mdpconnect= htmlspecialchars($_POST['mdp']);
    $errors2 = array();
    
    if(!empty($_POST['email']) && !empty(($_POST['mdp']))){
        
        $requser = $bdd->prepare("SELECT * FROM utilisateur WHERE email =? AND mot_de_passe = ?");
        $requser->execute(array($mailconnect, $mdpconnect));
        $userexist = $requser->rowCount();
        if($userexist == 1){
            
            $userinfo = $requser->fetch();
            $_SESSION['nomuser'] = $userinfo['nom'];
            $_SESSION['prenomuser'] = $userinfo['prenom'];
            $_SESSION['roleuser'] = $userinfo['role'];
            $_SESSION['iduser']=$userinfo['id'];
            header("Location: Accueil.php");
            
            
        }
        else{
           $errors2 = "L'email ou le mot de passe est incorrect";
           var_dump($errors2);
        }
        
    }
    else{
        $errors2 = "Veuillez remplir tous les champs";
        var_dump($errors2);
    }
}

?>









<html>
    <?php
    include 'Header.php';
    ?>  
    <head>
        <meta charset="utf-8" />
        <link rel="stylesheet" href="../css/Connexion.css">
        <title>Connexion</title>    
    </head>  

    <section>
        <div class="FormConnexion">
            <form action="" method="POST">
                <input class="remplissage" type="email" name="email" placeholder="Email">
                <input class="remplissage" type="password" name="mdp" placeholder="Mot de Passe">
                <button class="remplissage" name="Envoyer" type="submit" method="POST">Se Connecter</button>

            </form>




        </div>




    </section>










    <?php
    include 'Footer.php';
    ?>




</html>
