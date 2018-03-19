$(document).ready(function() {

    //⚠️ INITIALISATION DU CHAT

    convertir_smiley(); //⚠️ qd on arrive la 1ère fois, que smileys soient dejà la et remplacés

    $('#message_tchat').scrollTop($('#message_tchat')[0].scrollHeight);
    //⚠️ je veux que le ht de ma fenêtre soit scrollé de sa hauteur > pr que dernier msg soit visible
    //   (met l'ascenceur au + bas de la hauteur de la div)

    var url = 'inc/ajax.php'; //⚠️ url ac laquelle on va échanger en ajax
    // var lastid = 0;  // car déjà déclarée ds ajax.php
    var timer = setInterval (affichage_message, 10000);  // intervalle de vérif des messg : ttes les 10 sec si nv msg, ss raferaichissement

    var timer_membre_connecte = setInterval(affichage_membre_connecte, 15000); // Intervalle de vérif des membres 

    //⚠️ FCT QUI RAFRAICHIT FENETRE MSG 
    function affichage_message() {
        $.post(url, { 'action':'affichage_message', 'lastid' : lastid }, function(donnees) {    
        // lastid à 0 si pas d'autre msg / si 2 msg s'aff > lastid = 2 / 2 nvx > lastid = 4 (repart du dernier id connu, pr repartir de celui-ci en append)
            if ( donnees.validation == 'ok') {
                $('#message_tchat').append( donnees.resultat ); //⚠️ message_tchat = fenêtre qui contient les msg
                lastid = donnees.lastid;
                $('#message_tchat').scrollTop($('#message_tchat')[0].scrollHeight); //⚠️ de nv mettre l'ascenseur en bas
                convertir_smiley();
            }
        }, 'json');
    }

    //⚠️ FCT QUI RAFRAICHIT FENETRE MEMBRES CONNECTES
    function affichage_membre_connecte() {  // fenêtre qui contient liste membres

        $.post(url, {'action':'affichage_membre_connecte'}, function(donnees) { 
                                                         // function(donnees) <=> if readyState 4 & status 200)
            if (donnees.validation == 'ok') {  // on prévoit 'Entrée' de validation qui <=> à OK
            $('#liste_membre_connecte').empty().append(donnees.resultat); //⚠️ on vide d'abord et on rempli
            }
        },'json');
        
    }    

    //⚠️ FCT QUI RAJOUTE MSG
    $('#formulaire_tchat form').submit(function() { // div en bas où on rédige

        clearInterval(timer);

        var message = $('#formulaire_tchat form input[name=message]').val(); //⚠️ Je récup txt du msg saisi
        $.post(url, {'action':'envoi_message','message':message}, function(donnees) {
            if ( donnees.validation == 'ok') {  // si mesg tout bien passé, envoyé
                affichage_message();
                $('#formulaire_tchat form input[name=message]').val('').focus();
                //⚠️ je vide le contenu de l'input du msg que je viens d'envoyer, et mets le curseur actif deds)
            }
        }, 'json');

        timer = setInterval(affichage_message, 5000);   // intervalle de rafraich. ?
        return false;   // > pr pas que pg se rafraichisse (= preventDefault)
    })

    //⚠️ AFFICHER ICONES SMILEYS
    $(".smiley").on('click', function(event) { //⚠️ on écoute event smiley

        var prevMsg = $('#message').val();             // je stocke le msg en cours de saisie ds une var
        var emotiText = $(event.target).attr('alt');   // je récup la valeur de l'emot (alt) ki est l'objet du clic
        $('#message').val(prevMsg + emotiText);        // je réécris val msg + emot
        $('#message').focus();                         // remet curseur ds saisie
    });

        //⚠️ pour afficher image à la place des symboles typo
        function convertir_smiley() {   

            $('#message_tchat p').each( function() {    // pr chq paragraph de msg
            
                $('.smiley').each( function() {         // pr ts les smiley 
                    var symbole = $(this).attr('alt');
                    var source = $(this).attr('src');

                    //⚠️ je convertis le symbole en image pour le remplacer ds le html :
                    var textRemplace = $('#message_tchat').html().replace(symbole, '<img src="' + source + '">');   
                    $('#message_tchat').html(textRemplace );
                    /* => en 1 lg :  
                    ('#message_tchat').html( $('#message_tchat').html().replace(symbole, '<img src="' + source + '">') );   */
                });
            });
        }

    //⚠️ BOUTON DE DECONNEXION
    $('#deconnexion').on('click', function() {

        $.post(url, {'action' : 'deco'}, function(reponse) {

            if (reponse.validation == 'ok') {
                $(location).attr('href','index.php');  // en jQ <=> en php à : header (location:index.php)
                //⚠️ $(location).attr('href', ---> pr rediriger en jQ ---> vers url 'index.php');
            }

        }, 'json' );
    });





}) // Fin du document reday