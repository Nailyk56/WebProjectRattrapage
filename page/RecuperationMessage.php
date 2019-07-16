<?php
setcookie('idSujet',$_POST['idSujet'],time()+3600);
session_start();
$bdd= new PDO('mysql:dbname=webproject;host=localhost','root','');

if (!empty($_POST) && !empty($_POST['idSujet'])) {
    
    $message_par_page = 10;
    $page = '';
    
    if(isset($_POST['numPage'])){
        $page = $_POST['numPage'];
    }else{
        $page = 1;
    }
    
    $start_from = ($page - 1) * $message_par_page;
    
    if(isset($_POST['filtre'])){
        $req = $bdd->prepare("SELECT DISTINCT message.id AS currentMessageId, contenu, date_post, "
                . "(SELECT CONCAT(nom, ' ' ,prenom) FROM utilisateur,message WHERE utilisateur.id = id_posteur AND message.id = currentMessageId) AS nom_post "
                . "FROM message,sujet WHERE message.id_sujet = ? AND contenu LIKE '%".$_POST['filtre']."%' LIMIT ".$start_from.",".$message_par_page);
    }else{
        $req = $bdd->prepare("SELECT DISTINCT message.id AS currentMessageId, contenu, date_post, "
                . "(SELECT CONCAT(nom, ' ' ,prenom) FROM utilisateur,message WHERE utilisateur.id = id_posteur AND message.id = currentMessageId) AS nom_post "
                . "FROM message,sujet WHERE message.id_sujet = ? LIMIT ".$start_from.",".$message_par_page);
    }
    $req ->execute([$_POST['idSujet']]);  
    
    
    
    echo "<h2>".$_POST['nomSujet']."</h2>";
    
    echo "<input id='textForm' type='text'></input><button type='submit' onclick='var text = document.getElementById(\"textForm\").value;AccesMessage(".$_POST['idSujet'].",\"".$_POST['nomSujet']."\",text)'>Rechercher</button>";
    
    $data = $req->fetchAll();
    
    echo "<table>";   
    echo "<tr><td class='bordure'><strong>Utilisateur</strong></td><td class='bordure'><strong>Message</strong></td></tr>";
    foreach($data as $donnees){
        
        echo '<tr id="messageId'.$donnees["currentMessageId"].'"><td class="bordure">De ' . $donnees['nom_post'] .'<br>Le '.$donnees['date_post'].'</td>'
            . '<td class="bordure">'.$donnees['contenu'].'</td>';
        if(!empty($_SESSION)){
            echo "<td><button onclick='Report(\"".$donnees['contenu']."\")'>Signaler</button></td>";
            if($_SESSION['roleuser']=="0"){
               echo "<td><button onclick='SupprimerMessage(".$donnees['currentMessageId'].")'>Supprimer le message</button></td>";
               echo "<td><form action='modifMessage.php' method='POST'><input type='submit' value='Modifier le message'></input><input name='idMessage' value='".$donnees['currentMessageId']."'style='visibility: hidden'></input> </form></td>";
            } 
        }
        echo '</tr>';
        
    }
    echo "</table>";
    
    if(isset($_POST['filtre'])){
        $req2 = $bdd->prepare("SELECT COUNT(id) FROM message WHERE id_sujet=? AND contenu LIKE '%".$_POST['filtre']."%'");
    }else{
         $req2 = $bdd->prepare("SELECT COUNT(id) FROM message WHERE id_sujet=?");
    }
    
    $req2 ->execute([$_POST['idSujet']]);  
    $nbPage = $req2->fetch();
    $total_page = ceil($nbPage[0]/$message_par_page);
    
    echo "Pages : ";
    for($j=1;$j<=$total_page;$j++){
        if(isset($_POST['filtre'])){
             echo "<button class='pagination' value='".$j."' onclick='AccesMessage(".$_POST['idSujet'].",\"".$_POST['nomSujet']."\",\"".$_POST['filtre']."\",".$j.")'>".$j."</button>";
        }else{
             echo "<button class='pagination' value='".$j."' onclick='AccesMessage(".$_POST['idSujet'].",\"".$_POST['nomSujet']."\",null,".$j.")'>".$j."</button>";
        }
    }
    
    if(!empty($_SESSION) && $_SESSION['roleuser']!= 2){
        echo "<form action='addmessage.php'> <input type='submit' value='Répondre'> </form>";
    }
    
    $req->closeCursor();
}