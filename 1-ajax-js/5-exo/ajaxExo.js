
document.addEventListener("DOMContentLoaded", function(event) {

    affiche_employes(); // 1 j'app fct aff..

    document.getElementById('submit').addEventListener('click',function(event){
        event.preventDefault();
        ajax_insert();
    })

    function affiche_employes(){
        // appel ajax pour afficher employes (1. JE CREE OBJ AJAX)
        if (window.XMLHttpRequest) r = new XMLHttpRequest();
        else r = new ActiveXObject('Microsoft.XMLHTTP');  // pour IE

        var parameters="action=affichage";  //2.  je CREE des PARAM si besoin  / Paramètre qu'on envoie au fichier php pour imprimer
        
        // 3. j'ouvre connexion défini entete, envoi param definis au dessus
        r.open("POST","ajaxExo.php", true) // envoi vers fichier php, en mode asynchrone 
        r.setRequestHeader("Content-type","application/x-www-form-urlencoded"); // je défini les entêtes de ma requête
        r.send(parameters); // envoi avec les paramètres  (J'ENVOIE)     
        r.onreadystatechange = function(){
            if ( r.readyState == 4 && r.status == 200) {    //si tout ok
                var obj = JSON.parse( r.responseText );     // je créé une var qui va récup reponse en json
                // 4. actions :qu'est-ce que je fais de ma réponse :
                document.getElementById('employes').innerHTML = obj.resultat;   // METTRE ds la DIV
            }   // on a terminé fct affichage employé ds div
        }
    }

    function ajax_insert(){ // si clic btn submit je fais app à cette fct
        // appel ajax pour insérer un employe
        if (window.XMLHttpRequest) r = new XMLHttpRequest();
        else r = new ActiveXObject('Microsoft.XMLHTTP');

        var nom = document.getElementById('nom').value;   
        var prenom = document.getElementById('prenom').value; 
        var sexe = document.getElementById('sexe').value; 
        var service = document.getElementById('service').value; 
        var date_emb = document.getElementById('date_emb').value; 
        var salaire = document.getElementById('salaire').value; 
           
        var parameters="nom=" + nom + "$prenom=" + prenom + "&sexe=" + sexe +"&service=" + service + "&date_emb=" + date_emb + "&salaire=" + salaire + "&action=insert";
    
        r.open("POST","ajaxExo.php", true) 
        r.setRequestHeader("Content-type","application/x-www-form-urlencoded"); 
        r.send(parameters);     
        r.onreadystatechange = function(){
            if ( r.readyState == 4 && r.status == 200) {   
                var obj = JSON.parse( r.responseText );  
                // actions
                if ( obj.validation = "ok" ) {
                    // si insertion se passe bien, je réaffiche les employes
                    affiche_employes();
                }
        }    
}); // fin de chargement du document (cf document.ready) ⚠️
    