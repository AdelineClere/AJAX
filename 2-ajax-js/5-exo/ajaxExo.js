
$(document).ready( function () {

    affiche_employe();  

    $('#submit').on('click', function(event) {
        event.preventDefault();
        ajax_insert();
    })

        function affiche_employe() {
            $.post('ajaxExo.php', {'action':'affichage'}, function(reponse) {
                $('#employes').html(reponse.resultat);
            }, 'json');
        }

        function ajax_insert() {

            var parameters = $('#myForm').serialize();
            /*⚠️ serialize = fct ki récup chps du form. et les ecrit au FORMAT "GET" (de php)
                  càd: action=insert&nom=clere&preniom=adele&sexe=f&service=...                 */

            /* parameters peut avoir 2 formats :
                > 'nomchamp1=valeur1&nomchamp2=valeur2'
                > {'nomchamp1' : 'valeur', 'nomchamp2' : 'valeur2'}  (si valeur est une var > {'nomchamp1' : var...})  */

            $.post('ajaxExo.php', parameters, function(reponse) {
                if (reponse.validation == 'ok')
                {
                    affiche_employe();
                    $('#myForm').trigger("reset");  
                    //⚠️ en jQ fait appel (trigger = déclencheur) à évt reset (vide formulaire)
                }
            }, 'json');
        }

});  // Fin du doc ready