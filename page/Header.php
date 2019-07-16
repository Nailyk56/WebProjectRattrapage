<?php

var_dump($_SESSION);
?>


    <head>
        <meta charset="utf-8" />
        <link rel="stylesheet" href="../css/Header.css">  
    </head>
    <header>
        <div class="logo">
            <img src="../ImgSite/logo.jpg"/>
            <a href="Accueil"></a>           
        </div>
        <nav>
            <ul>
                <li><a href="Accueil.php">Accueil</a></li>
                <li><a href="Forum.php">Forum</a></li>
                <li><a href="BoiteAIdee.php">Boite à idées</a></li>
                <li><a>Boutique</a></li>
                <li><a href="Inscription.php">Inscription</a></li>
                
                <?php 
                if(!empty($_SESSION)){
                 echo "<li><a href='Deconnection.php'>Se Deconnecter</a></li>";
                }
                else{
                  echo "<li><a href='Connexion.php'>Se Connecter</a></li>";  
                }
                
                ?>
                
            </ul>
        </nav>
    </header>
