<?php
session_start();
?>
<html>
    <head>
        <meta charset="utf-8" />
        <link rel="stylesheet" href="../css/Accueil.css">
        <title>Accueil</title>    
    </head>
<?php
include 'Header.php';
?>
    <section class="presentation">
        <div class="imgbp">
            <img src="../ImgSite/Bierepong.jpeg"/>
        </div>

        <div class="textebde">
            <h2>Votre BDE</h2>
            <p>La vie étudiante est un des piliers dans une école d’ingénieur. 
                Et on souhaite que le CESI de Saint Nazaire ne déroge pas à la règle ! 
                Pour qu’une école soit dynamique ça commence tout d’abord par une vie associative riche et variée! 
                La principale activité du BDE est donc l’organisation d’évènements en tout genre pour toucher le plus d’étudiants possibles 
                : soirées au bar, boîte de nuit, challenge, weekend d’intégration, weekend de désintégration, gala, sorties en tout genre…
            </p>
        </div>
    </section>
    <section class="contact">
        <div class ="partiegauche">
            <h2>Nous Contacter</h2>
            <div class="contentform">
                <div class="formulaire">
                    <form>
                        <input type="text" name="nom" placeholder="Nom">
                        <input type="text" name="prenom" placeholder="Prénom">
                        <input type="email" name="email " placeholder="Email">  
                        <textarea name="commentaire"></textarea>
                        <button name="Envoyer" type="submit" method="post">Envoyer</button>
                    </form>
                </div> 

            </div>

        </div>

        <div class="partiedroite">
            <div class="contentcarte">
                <div class="Carte">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2708.1424751428035!2d-2.2596805494863603!3d47.25291722023516!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x4805689157541fdd%3A0x8a57536453c1e875!2sCampus+CESI!5e0!3m2!1sfr!2sfr!4v1529531833693" width="100%" height="100%" frameborder="0" style="border:0" allowfullscreen></iframe>
                </div>

            </div>

        </div>




    </section>

<?php
include 'Footer.php';
?>



</html>