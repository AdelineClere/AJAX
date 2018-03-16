<?php

require_once('init.php');
extract($_POST);

// => $id

$result = $pdo->prepare("SELECT * FROM employes WHERE id_employes=:tartenpion");
$result->execute ( array(
    'tartenpion' => $id
));

if ( $employe = $result->fetch(PDO::FETCH_ASSOC) )  // <=> j'ai une réponse =>
{
    $tab['validation'] = 'ok';

    $tab['resultat'] = '<table border="1"><tr>'; // faire ds css normalt ! / va contenir infos employé

    // Je génère mes entêtes de col à partir des col SQL de la table
    for ( $i=0 ; $i < $result->columnCount() ; $i++ ) // lire le nb de colonnes
    {
        $infos_colonne = $result->getColumnMeta($i);   // va chercher noms de colonne 0 au 1er tour, col 1 au 2è etc...
        $tab['resultat'] .= '<th>' . $infos_colonne['name'] . '</th>';  // on stock
                // Rq. : chq entrée du tablo est un nom de col

    }

    $tab['resultat'] .= '</tr><tr>';

        // je vais aff. infos de l'individu :
        for ( $i=0 ; $i < $result->columnCount() ; $i++ )  // cette 2è boucle lit la ligne de l'id demandé ds le select
        {
            $infos_colonne = $result->getColumnMeta($i); 
            $nom_colonne = $infos_colonne['name'];
            // à chq tour de la boucle for je récup la val stockée ds la col pour l'employé choisi
            $tab['resultat'] .= '<td>' . $employe[$nom_colonne] . '</td>';
        }
        $tab['resultat'] .= '</tr></table>';
}
else
{
    $tab['validation'] = 'not ok';
}

echo json_encode($tab); // transmet l'objet JSON à js