<?php

require_once('init.php');
extract($_POST);
// = $id

//⚠️⚠️ 3. Je traite l'appel venant du fichier js

$result = $pdo->prepare("DELETE FROM employes WHERE id_employes = :id_employes");
$result->execute( array(
    'id_employes' => $id
));

// Créateur d'un tableau avec un index 'liste_a_jour' qui va contenir l'intégralité de ma balise HTML select
$tab = array();
$tab['liste_a_jour'] = '<select name="personne" id="personne">'; // début du select

$result = $pdo->query("SELECT * FROM employes"); // comme c après DELETE, c bien une VO à jour des employés

while ( $employe = $result->fetch(PDO::FETCH_ASSOC) ){
    // je viens ajouter autant d'options que d'employés / l'entrée liste à jour est uhne grosse chaine de caractère concaténée :
    $tab['liste_a_jour'] .= '<option value="'.$employe['id_employes'].'">'.$employe['prenom'].'</option>';
}

$tab['liste_a_jour'] .= '</select>';

//⚠️⚠️4. J'envoie la réponse
echo json_encode($tab);
// transforme mon tablo en objet JSON (encode en JSON)



