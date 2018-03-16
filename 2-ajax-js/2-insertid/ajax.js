
//⚠️ commence tjrs par le document ready = est-ce qu'il est cplt chargé
$(document).ready( function () {

    $('#submit').on('click', function(event) {
        event.preventDefault(); // annule comportt du btn submit
        ajax();                 // on app fct ajax
    })

    function ajax(){

        personne = $('#personne').val()    // récup val qu'il y a ds champ prenom pr la stocker ds personne



    //⚠️ $.post (autre afçon d'écrire que précédent) :
    
        // ⚠️ Préparer envoi : $.post (à qui je l'envoie, ac quels paramètrs, ce que je fais de la réponse, ds quel format je la reçois)
        // 'personne=' + personne => pr réceptionner ' personne = valeur '
       
        // Avec méthode json => on met 'json' pour dataType (dessous)

        /* $.post('ajax.php', 'personne=' + personne) = méthode ajax :
           $.post(destination , parametres , function(){} (appelée en cas de succès) , le format)  */

       
        $.post('ajax.php', {'personne' : personne}, function(reponse) { // -> déjà parsé en json ici
           
            if (reponse.validation == 'ok') {
                $('#resultat').append('employe '+ personne +' ajouté(e) !');  // insère ds tablo
                $('#personne').val(""); // vide personne saisie
            }
        }, 'json'); 

        
            /*  // on peut aussi déclarer fct en dehors $.post pour éclaircir...
                $.post('ajax.php', {'personne' : personne}, confirmation, 'json');              
                        function confirmation (reponse) {         
                            if (reponse.validation == 'ok') {
                                $('#resultat').append('employe '+ personne +' ajouté(e) !');
                                $('#personne').val("");
                            }
                        }       */
    }


})  // Fin du doc ready


// on pourrait déclarer fct en dehors $.post pour éclaircir...