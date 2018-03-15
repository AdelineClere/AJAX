
//⚠️ j'écoute l'action clic sur le btn qui porte l'id action : le clic va déclencher l'action loadDoc
document.getElementById('action').addEventListener('click', loadDoc); 

function loadDoc()
{
    // alert('je suis appelée');        // (pr tester si fct bien appelée)
    var xhttp = new XMLHttpRequest();   //⚠️ on déclare variable
    
    xhttp.onreadystatechange = function() { 
    //⚠️ je test état readyState, à chaq chgt > déclenche fct° anonyme et lui dis :

        if ( xhttp.readyState == 4 && xhttp.status == 200 )  
        // si est bien en readyState 4 et fichier correctement chargé (pas 1 pg d'erreur) = 200
        //https://developer.mozilla.org/en-US/docs/Web/API/XMLHttpRequest/readyState
        
        {
            document.getElementById('demo').innerHTML = xhttp.responseText;
            // alors je prepare l'envoi la reponse xhttp dans la div demo de index.html ac innerHTML
        }
    }
    // en fait d'abord ça :
    xhttp.open("GET","fichier.txt",true);   // true = attribué au mode asynchrone (oui il l'est)
    // j'ouvre une connexion vers mon fichier txt en GET
    xhttp.send();
    // j'envoie => fait passer le readyState de 0 à 4 => alors lg 11 est vérifié > fct° lancée
}
