<?php
session_start();
$bdd= new PDO('mysql:dbname=webproject;host=localhost','root','');

$req= $bdd->prepare("SELECT * FROM categorie");
$req->execute();


?>
<html>
    <?php
    include 'Header.php';
    ?>  
    <head>
        <meta charset="utf-8" />
        <link rel="stylesheet" href="../css/Forum.css">
        <script type="text/javascript" src="../js/CategorieJS.js"></script>
        <title>Forum</title>    
    </head>  

    <section id="liste">
        <h2>Liste des catégories de sujets</h2>
        <?php
        if(!empty($_SESSION) && $_SESSION['roleuser']=="0"){
           echo "<form action='addcategorie.php'> <input type='submit' value='Créer une catégorie'></form>";
           echo "<form action='Bannir.php'> <input type='submit' value='Bannir un élève'></form>";
        }    
        ?>


    <ul>
        
        <?php
        if (!empty($req)) {

            foreach ($req as $categorie) {
                
                echo "<div><li onclick='AccesSujet(".$categorie['id'].")' id=categorie".$categorie['id'].">".$categorie['nom']."</li>";
                if(!empty($_SESSION) && $_SESSION['roleuser']=="0"){
                    echo "<button onclick='SupprimerCategorie(".$categorie['id'].")'>Supprimer la catégorie</button>";
                    echo "<form action='modifCategorie.php' method='POST'><input type='submit' value='Modifier la categorie'><input name='idCategorie' value='".$categorie['id']."'style='visibility: hidden'></input></form>";
                }
                echo "</div>";
                
            }
        }
        ?>  
        
    </ul>



</section>










<?php
include 'Footer.php';
?>

   


</html>

