<?php
session_start();
?>
<html>
    <?php
    include 'Header.php';
    ?>  
    <section>
        <img>
        <button>S'inscrire !</button>
        <button>Voter !</button>
        <a href="#formulaireProposition" target="_self">
            <button>Proposer !</button>
        </a>
        

    </section>

    <section>
        <h2></h2>
        <div>
            <div>
                <img>
                <h3></h3>
                <p></p> 
                <button>S'inscrire</button>
            </div>
            <div>
                <img>
                <h3></h3>
                <p></p> 
                <button>S'inscrire</button>
            </div>
            <div>
                <img>
                <h3></h3>
                <p></p> 
                <button>S'inscrire</button>
            </div>

        </div>


    </section>
    <section>
        <h2></h2>
        <div>
            <div>
                <img>
                <h3></h3>
                <p></p> 
                <button>Voter</button>
            </div>
            <div>
                <img>
                <h3></h3>
                <p></p> 
                <button>Voter</button>
            </div>
            <div>
                <img>
                <h3></h3>
                <p></p> 
                <button>Voter</button>
            </div>

        </div>


    </section>
    <section>
        <h2></h2>
        <form id="formulaireProposition">
            <input type="text" name="TitreEventPropose" placeholder="Titre de l'évènement">
            <input type="date" name="DateEventPropose"> 
            <button type='submit' name="AjoutPhoto">Ajouter vos photos</button>
            <textarea name="commentaire"></textarea>
            <button name="Envoyer" type="submit" method="post">Envoyer</button>       
        </form>
    </section>


    <?php
    include 'Footer.php';
    ?>
    

</html>


