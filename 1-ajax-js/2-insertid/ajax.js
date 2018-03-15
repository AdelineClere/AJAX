
document.addEventListener("DOMContentLoaded", function(event) {
    //⚠️ j'attends que mon doc soit totalt chargé avant de faire tout ce qu'il y a au milieu

    document.getElementById('submit').addEventListener('click', function(event) {  //⚠️ sur clic je déclenche 1 fct 

        event.preventDefault(); //⚠️ on commence par annuler le comportt habituel du btn submit (= recharge pg)
        ajax(); // => mais appel à la fct ajax (pas grave avt ou ap la fct)
    });

    function ajax(){

        if (window.XMLHttpRequest) r = new XMLHttpRequest();  // est=ce que fct XML... existe ds navigater⚠️! window !⚠️ > true ou false / Tt sur même lg -> on peut se passer des {}
        else r = new ActiveXObject('Microsoft.XMLHTTP'); // pour IE 

        var personne = document.getElementById('personne').value; 
        // on récup var prenom saisi que l'on souhaite insérer ds BDD

        var parameters ="personne=" + personne;   // on veut envoyer le param + sa valeur saisie (personne = toto)
        // si plusieurs prs ... && ...)

        r.open("POST","ajax.php", true) // on envoi vers fichier php, en mode asynchrone || ouverture en méthode post vers ajax.php
        r.setRequestHeader("Content-type","application/x-www-form-urlencoded"); // je défini les entêtes de ma requête
        // = j'envoie à mon formul ajax.php que ce header la qui sera soumis = c'est de type formulaire
        // Déclarat° des entêtes sur le type de contenu envoyer pour aimenter $_POST
        r.send(parameters); // envoi avec paramètres


        r.onreadystatechange = function(){
            if ( r.readyState == 4 && r.status == 200) {
                document.getElementById('resultat').innerHTML = 'employé ' + personne + " ajouté !"; // => insérer ds html
                document.getElementById('personne').value='';   // => vide le champ
            }
        }
    }

}); // fin du document ready (JS)