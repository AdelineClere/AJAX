
<?php

// var_dump($_POST);

require_once("init.php");

extract($_POST); // => va créer '$personne' et mettre dedans les valeurs de tous les index types text :
/*
        $_POST (
            'nom' => 'Clere',
            'prenom' => 'Adeline'
        )
    Conséquence du $extract($_POST) :
        $nom = "Clere"
        $prenom = "Adeline"
*/

$result = $pdo->prepare("INSERT INTO employes (prenom) VALUES (:personne)");  // je prépare requête

if ( $result->execute( array(      // array -> remplace bindvalue : on envoi tablo de param 
    'personne' => $personne
    ))
)
{
    $tab['validation'] = 'ok';
    echo json_encode($tab);     // =  j'envoie l'objet json : { 'validation' : 'ok' } au jQ
};





