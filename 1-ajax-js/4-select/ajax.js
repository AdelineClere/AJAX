
document.addEventListener("DOMContentLoaded", function(event) {
    // Si le doc est bien chargé, j'appelle ma fct ajax
   
    
    ajax(); //3.⚠️⚠️ appeler fct° ajax ici (avant) pour que tablo de 1er nom que l'on voit en select soit déjà affiché


    // 1. ⚠️⚠️ je select prs et tablo ajax change dès qu'on select le nom (= plus au clic sur voir)
        document.getElementById('personne').addEventListener('change', function(event) {  
            // pas besoin de prevent default ici

            ajax(); 
        });
    
        function ajax(){
    
            if (window.XMLHttpRequest) r = new XMLHttpRequest();
            else r = new ActiveXObject('Microsoft.XMLHTTP');
    
            var p = document.getElementById('personne');
            var id = p.options[p.selectedIndex].value;  
            //⚠️ => l'option (prenom) choisie a un index à partir duquel la propriété 'selectedIndex' renvoie la valeur 
            var parameters ="id=" + id;
    
    
            r.open("POST","ajax.php", true) // ouverture en méthode POST vers ajax.php
            r.setRequestHeader("Content-type","application/x-www-form-urlencoded"); 
            // Déclarat° type de contenu envoyé vers php
    
    // 2. ⚠️⚠️ jenvoi vers php ac pour paramètre le prénom sélectionné ?
            r.send(parameters);
        
    
            r.onreadystatechange = function(){
                if ( r.readyState == 4 && r.status == 200) {
    
                    // 5. ⚠️⚠️ Je traite la réponse (= je viens parser le JSON obtenu pour alimenter var obj > )
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
    
    
    