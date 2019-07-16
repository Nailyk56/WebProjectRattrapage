function SupprimerCategorie(idcategorie){

    var suppcategorie = new XMLHttpRequest(); 
    var params = "idcategorie="+idcategorie;

 

    suppcategorie.onreadystatechange = function() {     // partie qui vérifie si le script s'est bien exécuté vérifie les potentielles erreurs lié au serveur par exemple 
	if (suppcategorie.readyState == 4 && (suppcategorie.status == 200 || suppcategorie.status == 0)) {
		
                var element = document.getElementById("categorie"+idcategorie);
                element.parentNode.innerHTML = this.responseText;
                
            }
    };

    suppcategorie.open("POST", "suppcategorie.php", true); //envoie de donnée
    suppcategorie.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    suppcategorie.send(params);  
        
}


function AccesSujet(idcategorie,numPage,filtre){
    var recupsujet = new XMLHttpRequest(); 
    var params = "idcategorie="+idcategorie;
    
    if(numPage != null){
        var params = params+"&numPage="+numPage;
    }
    
    if(filtre != null){
        var params = params+"&filtre="+filtre;
    }
    
    recupsujet.onreadystatechange = function() { 
      
        if (recupsujet.readyState == 4 && (recupsujet.status == 200 || recupsujet.status == 0)) {
         
            document.getElementById('liste').innerHTML = this.responseText;
        
        }
        
    }
    
    recupsujet.open("POST", "RecuperationSujet.php", true); //envoie de donnée
    recupsujet.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    recupsujet.send(params); 
    
}

function AccesMessage(idSujet,nomSujet,filtre,numPage){
    
    var recupmessage = new XMLHttpRequest();
    var params = "idSujet="+idSujet+"&nomSujet="+nomSujet;
    
    if(numPage != null){
        var params = params+"&numPage="+numPage;
    }
    
    if(filtre != null){
        var params = params+"&filtre="+filtre;
    }
    
    recupmessage.onreadystatechange = function() {        
        if (recupmessage.readyState == 4 && (recupmessage.status == 200 || recupmessage.status == 0)) {
            
            document.getElementById('liste').innerHTML = this.responseText;

        }
    }
   
    recupmessage.open("POST", "RecuperationMessage.php", true); //envoie de donnée
    recupmessage.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    recupmessage.send(params); 
    
}


function SupprimerMessage(idMessage){
    var suppmessage = new XMLHttpRequest(); 
    var params = "idMessage="+idMessage;

 

    suppmessage.onreadystatechange = function() {     // partie qui vérifie si le script s'est bien exécuté vérifie les potentielles erreurs lié au serveur par exemple 
	if (suppmessage.readyState == 4 && (suppmessage.status == 200 || suppmessage.status == 0)) {
		
                var element = document.getElementById("messageId"+idMessage);
                element.parentNode.removeChild(element);
                 
            }
    };

    suppmessage.open("POST", "suppMessage.php", true); //envoie de donnée
    suppmessage.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    suppmessage.send(params);  
}


function SupprimerSujet(idSujet){
    var suppSujet = new XMLHttpRequest(); 
    var params = "idSujet="+idSujet;

 

    suppSujet.onreadystatechange = function() {     // partie qui vérifie si le script s'est bien exécuté vérifie les potentielles erreurs lié au serveur par exemple 
	if (suppSujet.readyState == 4 && (suppSujet.status == 200 || suppSujet.status == 0)) {
		
                var element = document.getElementById("idSujet"+idSujet);
                element.parentNode.removeChild(element);
                 
            }
    };

    suppSujet.open("POST", "suppSujet.php", true); //envoie de donnée
    suppSujet.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    suppSujet.send(params);  
}


function BannirEleve(email){
    
    var bannireleve = new XMLHttpRequest(); 
    var params = "email="+email;


    bannireleve.onreadystatechange = function() {     // partie qui vérifie si le script s'est bien exécuté vérifie les potentielles erreurs lié au serveur par exemple 
	if (bannireleve.readyState == 4 && (bannireleve.status == 200 || bannireleve.status == 0)) {
           document.getElementById(email).parentNode.innerHTML = '<button id="'+email+'" onclick="DebannirEleve(\''+email+'\')">Debannir</button>';
            }
    };

    bannireleve.open("POST", "BannirEleve.php", true); //envoie de donnée
    bannireleve.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    bannireleve.send(params);  
}

function DebannirEleve(email){
    
    var debannireleve = new XMLHttpRequest(); 
    var params = "email="+email;


    debannireleve.onreadystatechange = function() {     // partie qui vérifie si le script s'est bien exécuté vérifie les potentielles erreurs lié au serveur par exemple 
	if (debannireleve.readyState == 4 && (debannireleve.status == 200 || debannireleve.status == 0)) {
           document.getElementById(email).parentNode.innerHTML = '<button id="'+email+'" onclick="BannirEleve(\''+email+'\')">Bannir</button>';
            }
    };

    debannireleve.open("POST", "DebannirEleve.php", true); //envoie de donnée
    debannireleve.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    debannireleve.send(params);  
}

function Report(contenu){
    
    var ReportMassage = new XMLHttpRequest(); 
    var params = "contenu="+contenu;
    
     ReportMassage.onreadystatechange = function() {     // partie qui vérifie si le script s'est bien exécuté vérifie les potentielles erreurs lié au serveur par exemple 
	if (ReportMassage.readyState == 4 && (ReportMassage.status == 200 || ReportMassage.status == 0)) {
                 alert(this.responseText);
            }
    };
    
    ReportMassage.open("POST", "Report.php", true); //envoie de donnée
    ReportMassage.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    ReportMassage.send(params);      
    
    
}