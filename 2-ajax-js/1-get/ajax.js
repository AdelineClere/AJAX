
//⚠️ commence tjrs par le document ready = est-ce qu'il est cplt chargé
$(document).ready( function () {


    // sélection des élts de la comm en css. on désigne le btn, puis l'action (click, on..)
    $('#action').on('click',function() {     // idem : $(#action).click(function(){})
        
        //⚠️ faire appel à ajax pr aller chercher fichier txt :
        $.ajax( {
            url :'fichier.txt',              // des entrées et des val dedans
            dataType : 'text',               // type de données à recevoir
            success : function( reponse ){   // si tt ok, on app fct qui reçoit rép au format précisé avt
                $("#demo").html( reponse );  // et la met ds div demo de index
                }        
        } );
    });   

});  // Fin du doc ready