<?php
session_start();
$bdd= new PDO('mysql:dbname=webproject;host=localhost','root','');


    $req = $bdd->prepare("SELECT nom,prenom,email,role FROM utilisateur WHERE role!=0 AND role!=3" );
    $req ->execute();
    
    






?>








<html>
    <head>
        <meta charset="utf-8" />
        <link rel="stylesheet" href="../css/Bannir.css">
        <script type="text/javascript" src="../js/CategorieJS.js"></script>
        <title>Ajouter un sujet</title>    
    </head>
    <?php
    include 'Header.php';
    ?>
    
     <section>
        <div class="FormNewSujet">
            <table>
                <tr>
                    <td class="bordure"><strong>Nom</strong></td>
                    <td class="bordure"><strong>Prenom</strong></td>
                    <td class="bordure"><strong>Email</strong></td>
                    <td></td>
                </tr>
<?php

$maliste = $req->fetchAll();

foreach ($maliste as $eleves){
    
    echo "<tr><td class='bordure'>".$eleves['nom']."</td><td class='bordure'>".$eleves['prenom']."</td><td class='bordure'>".$eleves['email']."</td>";
    if($eleves['role']==1){
        
        echo "<td ><button id='".$eleves['email']."' onclick='BannirEleve(\"".$eleves['email']."\")'>Bannir</button></td>";
        
    }else if($eleves['role']==2){
            echo "<td><button id='".$eleves['email']."' onclick='DebannirEleve(\"".$eleves['email']."\")'>Debannir</button></td>";
    }
echo "</tr>";
}


?>
                
            </table>
            
            
              <a href="Forum.php"><button  name="Retour" type="submit">Retour</button></a>

        </div>


    </section>



    <?php
    include 'Footer.php';
    ?>
    
    
    
</html>