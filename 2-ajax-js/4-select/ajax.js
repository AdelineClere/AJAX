
$(document).ready( function () {

    maj();  // lancer fct 1ere fois pr aff tablo 1er nom (Rq. :⚠️ () => fct immédiate)

    // Appel à cette fct maj au chgt de prs sélect :
    $('#personne').on('change', maj);   // qd nom sélect change (⚠️ici => fct s'exécute au chgt)
    // idem : $('#personne').on('change',function() { maj(); }); 

        function maj() {
            var id=$('#personne').find(':selected').val();      //⚠️ Je récup id de prs sélect

        $.post('ajax.php', {'id':id}, reception, 'json');       //⚠️ j'envoi ac param...

            function reception( donnees ){
                if ( donnees.validation == 'ok' ) {             //⚠️ à la réception des données
                    $('#resultat').html( donnees.resultat );    //⚠️ aff infos prs ds div resultat de html
                }
            }
        }

});  // Fin du doc ready
