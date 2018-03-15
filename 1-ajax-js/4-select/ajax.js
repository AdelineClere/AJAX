
document.addEventListener("DOMContentLoaded", function(event) {
    // Si le doc est bien chargé, j'appelle ma fct ajax
    
    ajax(); //3.⚠️⚠️ appeler fct° ajax ici (avant) pour que tablo de 1er nom que l'on voit en select soit déjà affiché

    //⚠️⚠️1. je select prs
        document.getElementById('personne').addEventListener('change', function(event) {  
            //1.⚠️⚠️ On veut que appeler tablo ajax dès qu'on select le nom (= plus au clic sur voir)
            // pas besoin de prevent default ici

            ajax(); 
        });
    
        function ajax(){
    
            if (window.XMLHttpRequest) r = new XMLHttpRequest();
            else r = new ActiveXObject('Microsoft.XMLHTTP');
    
            var p = document.getElementById('personne');
            var id = p.options[p.selectedIndex].value;  //⚠️ options (ts les prénoms) indexées à partir de 0 > l'option choisie renvoie la valeur de l'index de cette option
            // = La propiété 'selectedIndex' dit quel est l'id de l'indice de l'option (prénom) choisie (puisque options = attribut de type tablo) 
            // = récupérer la valeur de l'id sélectionné (par l'indice de l'array des prénoms)
            var parameters ="id=" + id;
    
    
            r.open("POST","ajax.php", true) // envoi vers fichier php, en mode asynchrone || ouverture en méthode post vers ajax.php
            r.setRequestHeader("Content-type","application/x-www-form-urlencoded"); // je défini les entêtes de ma requête
            // = j'envoie à mon formul ajax.php que ce header la qui sera soumis = c'est de type formulaire
            // Déclarat° des entêtes sur le type de contenu envoyer pour aimenter $_POST
    
    //⚠️⚠️2. j'appelle mon fichier php ac pour paramètre le prénom sélectionné
            r.send(parameters); // envoi avec les paramètres
        
    
            r.onreadystatechange = function(){
                if ( r.readyState == 4 && r.status == 200) {
    
                    //⚠️⚠️ 5. Je traite la réponse (= je viens parser le JSON obtenu pour alimenter var obj > )
                    var obj = JSON.parse( r.responseText ); 
                    // je récup la réponse (=select ds liste des prénoms) du fichier php au format JSON
                       
                    if ( obj.validation == 'ok') {
                        document.getElementById('resultat').innerHTML=obj.resultat; 
                        // c l' obj.resultat que l'on veut mettre deds html
                    }     
                }
            }
        }
    
    }); // fin du document ready (JS)
    
    // JSON parse en js et JSON en php pour ê interprétable
    
    
    