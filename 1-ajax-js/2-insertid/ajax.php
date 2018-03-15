
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
$result->execute( array(      // remplace bindvalue : on envoi tablo de param 
    'personne' => $personne
));



/* decl° marqueur d&étaillée :

$result = $pdo->prepare("INSERT INTO employes(prenom) VALUES (:prenom)");

$personne = $result->fetch(PDO::FETCH_ASSOC);  
// Une fois exécutée, ⚠️️ on associe une méthode pour rendre le résultat exploitable.

echo '<pre>'; print_r($personne); echo '</pre>';     

$result->bindValue(':nom', 'Grand', PDO::PARAM_STR);    // ⚠️️ On associe une nvlle valeur au marqueur

$result->execute();   // Exécution de la requête

$personne = $result->fetch(PDO::FETCH_ASSOC);

echo '<pre>'; print_r($personne); echo '</pre>';     

*/