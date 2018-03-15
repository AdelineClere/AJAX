
//⚠️ j'écoute l'action clic sur le btn qui porte l'id action : le clic va déclencher l'action loadDoc
document.getElementById('action').addEventListener('click', loadDoc); 

function loadDoc()
{
    // alert('je suis appelée');        // (pr tester si fct bien appelée)
    var xhttp = new XMLHttpRequest();   //⚠️ on déclare variable

    //⚠️ j'ouvre une connexion vers mon fichier txt en GET :
    xhttp.open("GET","fichier.txt",true);   // true = attribué au mode asynchrone (oui il l'est)
    xhttp.send();
    //⚠️  => fait passer le readyState de 0 à 4 => alors lg 13 est vérifié (> fct° pourra se lancer)
    
    xhttp.onreadystatechange = function() { 
    //⚠️ je test état readyState, à chaq chgt > déclenche fct° anonyme et lui dis :

        if ( xhttp.readyState == 4 && xhttp.status == 200 )  
        // si est bien en readyState 4 et fichier correctement chargé (pas 1 pg d'erreur) = 200
        //https://developer.mozilla.org/en-US/docs/Web/API/XMLHttpRequest/readyState
        
        {
            document.getElementById('demo').innerHTML = xhttp.responseText;
            // ⚠️ alors je prepare l'envoi la reponse xhttp dans la div demo de index.html ac innerHTML à la place de ancien contenu de cette div
        }
    }

}







document.getElementById('action').addEventListener('click', loadDoc); 

function loadDoc()
{
    var xhttp = new XMLHttpRequest();  

    xhttp.open("GET","fichier.txt",true); 
    xhttp.send();
    
    xhttp.onreadystatechange = function() { 
        if ( xhttp.readyState == 4 && xhttp.status == 200 )  
        {
            document.getElementById('demo').innerHTML = xhttp.responseText;
        }
    }
    
}