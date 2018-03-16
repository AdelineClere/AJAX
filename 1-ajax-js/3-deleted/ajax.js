
document.addEventListener("DOMContentLoaded", function(event) {
// Si le doc est bien chargé, j'appelle ma fct ajax

//⚠️⚠️ 1. je clic sur btn
    document.getElementById('submit').addEventListener('click', function(event) {  //⚠️ sur clic je déclenche 1 fct 
        event.preventDefault(); 
        ajax(); 
    });

    function ajax(){

        if (window.XMLHttpRequest) r = new XMLHttpRequest();   //⚠️  On déclare var requête
        else r = new ActiveXObject('Microsoft.XMLHTTP');

        var p = document.getElementById('personne');
        var id = p.options[p.selectedIndex].value;  //⚠️ options (ts les prénoms) indexées à partir de 0 > 
        //⚠️  => l'option choisie a un index dc, à partir duquel la propriété 'selectedIndex' renvoie la valeur (de l'id sélect (par l'indice de l'array des prénoms)

        var parameters ="id=" + id;


        r.open("POST","ajax.php", true) //⚠️  ouverture en méthode post vers ajax.php
        r.setRequestHeader("Content-type","application/x-www-form-urlencoded"); 
        //⚠️  j'envoie à mon formul ajax.php que c ce header la qui sera soumis ()de type formulaire)


//⚠️⚠️ 2. j'appelle mon fichier php ac pour paramètre le prénom sélectionné
        r.send(parameters); // envoi avec les paramètres
    
        //⚠️⚠️ 5. 
        r.onreadystatechange = function(){
            if ( r.readyState == 4 && r.status == 200) {

                //⚠️⚠️ 5. Je traite la réponse (= je viens parser le JSON obtenu pour alimenter var obj > )
                var obj = JSON.parse( r.responseText ); // je récup la réponse (=select avc la liste des prénoms à jour)du fichier php au format JSON :
                    // { 'liste_a_jour' : '<select...></select>' }
                    // fichier php lié à html par fihier ajax (qui récup réponse et aff ds html)

                console.log(obj);

                //⚠️⚠️ 6. J'affiche dans ma div 'employes' mon entrée 'liste_a_jour'
                document.getElementById('employes').innerhtml = obj.liste_a_jour;   // on prévoit entrée 'liste_a_jour' qu'on fera ds php

            }
        }
    }

}); // fin du document ready (JS)

// JSON parse en js et JSON en php pour ê interprétable






document.addEventListener("DOMContentLoaded", function(event) {

//⚠️⚠️ 1. je clic sur btn   
        document.getElementById('submit').addEventListener('click', function(event) {  //⚠️ sur clic je déclenche 1 fct 
            event.preventDefault(); 
            ajax(); 
        });
    
        function ajax(){   
            if (window.XMLHttpRequest) r = new XMLHttpRequest();
            else r = new ActiveXObject('Microsoft.XMLHTTP');
    
            var p = document.getElementById('personne');
            var id = p.options[p.selectedIndex].value; 

            var parameters ="id=" + id;    
    
            r.open("POST","ajax.php", true) 
            r.setRequestHeader("Content-type","application/x-www-form-urlencoded"); 
    
//⚠️⚠️ 2. j'appelle mon fichier php ac pour paramètre le prénom sélectionné
            r.send(parameters); // envoi avec les paramètres
          
            r.onreadystatechange = function(){
                if ( r.readyState == 4 && r.status == 200) {
                    var obj = JSON.parse( r.responseText );
                    console.log(obj);
    
//⚠️⚠️ 6. J'affiche dans ma div 'employes' mon entrée 'liste_a_jour'
                    document.getElementById('employes').innerhtml = obj.liste_a_jour;    
                }
            }
        }
    
    }); // fin du document ready (JS)