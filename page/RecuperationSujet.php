<?php
session_start();
$bdd= new PDO('mysql:dbname=webproject;host=localhost','root','');

if (!empty($_POST) && !empty($_POST['idcategorie'])) {
    
    $sujet_par_page = 10;
    $page = '';
    
    if(isset($_POST['numPage'])){
        $page = $_POST['numPage'];
    }else{
        $page = 1;
    }
    
    $start_from = ($page - 1) * $sujet_par_page;
    if(isset($_POST['filtre'])){
        $req = $bdd->prepare("SELECT DISTINCT sujet.id AS currentSujetId, sujet.nom AS nomSujet, sujet.type_sujet, utilisateur.nom,utilisateur.prenom,sujet.date_creation, "
                . "(SELECT COUNT(message.id)-1 FROM message,sujet WHERE message.id_sujet = currentSujetId && message.id_sujet = sujet.id) AS nb_messages, "
                . "(SELECT CONCAT(nom, ' ' ,prenom) FROM utilisateur,message WHERE utilisateur.id = id_posteur AND message.id IN (SELECT MAX(message.id) FROM message,sujet WHERE id_sujet=sujet.id)) AS nom_dernier_message,"
                . "(SELECT message.date_post FROM utilisateur,message WHERE utilisateur.id = id_posteur AND message.id IN (SELECT MAX(message.id) FROM message,sujet WHERE id_sujet=sujet.id)) AS date_dernier_message "
                . "FROM sujet,utilisateur,message WHERE id_categorie=? AND id_user=utilisateur.id AND sujet.nom LIKE '%".$_POST['filtre']."%' LIMIT ".$start_from.",".$sujet_par_page);
    }else{
        $req = $bdd->prepare("SELECT DISTINCT sujet.id AS currentSujetId, sujet.nom AS nomSujet, sujet.type_sujet, utilisateur.nom,utilisateur.prenom,sujet.date_creation, "
            . "(SELECT COUNT(message.id)-1 FROM message,sujet WHERE message.id_sujet = currentSujetId && message.id_sujet = sujet.id) AS nb_messages, "
            . "(SELECT CONCAT(nom, ' ' ,prenom) FROM utilisateur,message WHERE utilisateur.id = id_posteur AND message.id IN (SELECT MAX(message.id) FROM message,sujet WHERE id_sujet=sujet.id)) AS nom_dernier_message,"
            . "(SELECT message.date_post FROM utilisateur,message WHERE utilisateur.id = id_posteur AND message.id IN (SELECT MAX(message.id) FROM message,sujet WHERE id_sujet=sujet.id)) AS date_dernier_message "
            . "FROM sujet,utilisateur,message WHERE id_categorie=? AND id_user=utilisateur.id LIMIT ".$start_from.",".$sujet_par_page);
    }
    $req ->execute([$_POST['idcategorie']]);  

    echo "<h2>Liste des sujets</h2>";
    if(!empty($_SESSION) && $_SESSION['roleuser']!=2){
        setcookie('idcategorie',$_POST['idcategorie'],time()+3600);
        echo "<form action='addsujet.php'> <input type='submit' value='Créer un sujet'> </form>";
        
    }
    
    echo "<input id='textForm' type='text'></input><button type='submit' onclick='var text = document.getElementById(\"textForm\").value;AccesSujet(".$_POST['idcategorie'].",null,text)'>Rechercher</button>";
    
    
    $data = $req->fetchAll();
    
    $i = 0;
    echo "<table>";   
    echo "<tr><td class='bordure'><strong>Sujet</strong></td><td class='bordure'><strong/>Réponses<strong></td><td class='bordure'><strong>Dernier message</strong></td></tr>";
    foreach($data as $donnees){
       if((!empty($_SESSION)) || (empty($_SESSION) && $donnees['type_sujet'] == 1)){
            echo '<tr id="idSujet'.$donnees['currentSujetId'].'"><td class="bordure" onclick="AccesMessage('.$donnees['currentSujetId'].',\''.$donnees['nomSujet'].'\')">' . $donnees['nomSujet'] .'<br>par '.$donnees['nom'].' '.$donnees['prenom'].' le '.$donnees['date_creation'].'</td>'
                . '<td class="bordure"><center>'.$donnees['nb_messages'].'</center></td>'
                . '<td class="bordure">Par '.$donnees['nom_dernier_message'].'<br>'.$donnees['date_dernier_message'].'</td>';
             if(!empty($_SESSION) && $_SESSION['roleuser']=="0"){
                echo "<td><button onclick='SupprimerSujet(".$donnees['currentSujetId'].")'>Supprimer le sujet</button></td>"
                    ."<td><form action='modifSujet.php' method='POST'><input type='submit' value='Modifier le sujet'><input name='idSujet' value='".$donnees['currentSujetId']."'style='visibility: hidden'></input> </form></td>";
            }   
            echo '</tr>';
            $i = $i + 1;
       }

       
    }
    echo "</table>";
    
    $stringReq ="SELECT COUNT(id) FROM sujet WHERE id_categorie=?";
    
    if(empty($_SESSION)){
        $stringReq = $stringReq." AND type_sujet = 1";
    }
    
    if(isset($_POST['filtre'])){
       $stringReq = $stringReq." AND nom LIKE '%".$_POST['filtre']."%'";
    }

    $req2 = $bdd->prepare($stringReq);
    
    
    $req2 ->execute([$_POST['idcategorie']]);  
    $nbPage = $req2->fetch();
    $total_page = ceil($nbPage[0]/$sujet_par_page);
    
    echo "Pages : ";
    for($j=1;$j<=$total_page;$j++){
        if(isset($_POST['filtre'])){
            echo "<button class='pagination' value='".$j."' onclick='AccesSujet(".$_POST['idcategorie'].",".$j.",\"".$_POST['filtre']."\")'>".$j."</button>";
        }else{
            echo "<button class='pagination' value='".$j."' onclick='AccesSujet(".$_POST['idcategorie'].",".$j.")'>".$j."</button>";
        }
    }

    if($i == 0){
        echo "<br>Il n'y a pas de sujet disponible";
    }
    
    $req->closeCursor();
    $req2->closeCursor();
    
}

    
?>
