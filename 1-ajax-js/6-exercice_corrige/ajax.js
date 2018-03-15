document.addEventListener("DOMContentLoaded",function(event){

affiche_employes();

document.getElementById('submit').addEventListener('click',function(event){
    event.preventDefault();
    ajax_insert();
})


function affiche_employes(){
    // appel ajax pour afficher les employes
    if (window.XMLHttpRequest) r = new XMLHttpRequest();
    else r = new ActiveXObject('Microsoft.XMLHTTP'); // pour IE

    var parameters="action=affichage";

    r.open("POST","ajax.php",true);
    r.setRequestHeader("Content-type","application/x-www-form-urlencoded");
    r.send(parameters);
    r.onreadystatechange = function(){
        if ( r.readyState == 4 && r.status == 200){
            var obj = JSON.parse( r.responseText );	 
            // actions
            document.getElementById('employes').innerHTML =  obj.resultat;	
        }
    }

}

function ajax_insert(){
    // appel ajax pour inserer un employe
    if (window.XMLHttpRequest) r = new XMLHttpRequest();
	else r = new ActiveXObject('Microsoft.XMLHTTP'); // pour IE


    var nom = document.getElementById('nom').value;
    var prenom = document.getElementById('prenom').value;
    var sexe = document.getElementById('sexe').value;
    var service = document.getElementById('service').value;
    var date_emb = document.getElementById('date_emb').value;
    var salaire = document.getElementById('salaire').value;

    var parameters="nom=" + nom + "&prenom=" + prenom + "&sexe=" + sexe + "&service=" + service + "&date_emb=" + date_emb + "&salaire=" + salaire + "&action=insert";
    
    r.open("POST","ajax.php",true);
    r.setRequestHeader("Content-type","application/x-www-form-urlencoded");
    r.send(parameters);
    r.onreadystatechange = function(){
        if ( r.readyState == 4 && r.status == 200){
            var obj = JSON.parse( r.responseText );	 
            // actions
            if ( obj.validation = "ok" ) {
                 // si l'insertion se passe bien, je réaffiche les employes
                affiche_employes();
            }
        }
    }
   
}




}); // fin de chargement du document (cf document.ready)