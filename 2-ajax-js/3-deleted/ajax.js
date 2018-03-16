
//⚠️ commence tjrs par le document ready = est-ce qu'il est cplt chargé
$(document).ready( function () {

    $('#submit').on('click', function(event) {
        event.preventDefault(); // annule comportt du btn submit
        ajax();                 // on app fct ajax
    })

    function ajax(){

        //⚠️ find(':selected') = va chercher l'option qui a la propriété 'sélected' (nom choisi ds menu déroulant) :
        var id = $('#personne').find(':selected').val();
        var prenom = $('#personne').find(':selected').text();  //⚠️ pr afficher prénom ds message de div resultat
       
        //⚠️ à qui j'envoie id, ac quels param, ce que je fais de la rép, ds quel format je la reçois :
        $.post('ajax.php', {'id' : id}, function(reponse) { // -> déjà parsé en json ici
                $('#employes').html(reponse.liste_a_jour);  // j'envoi l'id du prenom à php
                $('#resultat').html('employé ' + prenom + ' supprimé')     // si on veut afficher ça ds div resultat de index
        }, 'json');          
    }


});  // Fin du doc ready

