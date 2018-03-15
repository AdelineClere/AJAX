<?php

require_once('init.php');
extract($_POST);


if ( $action == 'affichage' ) 
{
    // Requete pour aller chercher tous mes employes
    $result = $pdo->prepare("SELECT * FROM employes ORDER BY id_employes DESC");

    $tab['resultat'] = '<table border="1"><tr>';
    // Je génère mes entêtes de col à partir des col SQL de la table

    for ( $i=0 ; $i < $result->columnCount() ; $i++ ) // lire le nb de colonnes
    {
        $infos_colonne = $result->getColumnMeta($i);   // va chercher noms de colonne 0 au 1er tour, col 1 au 2è etc...
        $tab['resultat'] .= '<th>' . $infos_colonne['name'] . '</th>';  // on stock
                // Rq. : chq entrée du tablo est un nom de col
    }
    $tab['resultat'] = '</tr>';
    // Je boucle sur mes enregistrements
    while ( $employe = $result->fetch(PDO::FETCH_ASSOC) )
    {
        $tab['resultat'] .= '<tr>';
        for ( $i=0 ; $i < $result->columnCount() ; $i++ )  // cette 2è boucle lit la ligne de l'id demandé ds le select
        {
            $infos_colonne = $result->getColumnMeta($i); 
            $nom_colonne = $infos_colonne['name'];
            // à chq tour de la boucle for je récup la val stockée ds la col pour l'employé choisi
            $tab['resultat'] .= '<td>' . $employe[$nom_colonne] . '</td>';
        }
        $tab['resultat'] .= '</tr>';

        /*
        $tab['resultat'] .= '<tr>
        <td>' . $employe['id_employes'] . '</td>
        <td>' . $employe['id_prenom'] . '</td>
        <td>' . $employe['id_nom'] . '</td>
        <td>' . $employe['id_sexe'] . '</td>
        <td>' . $employe['id_service'] . '</td>
        <td>' . $employe['id_date_emb'] . '</td>
        </tr>
        */
    }

    $tab['resultat'] .= '</tr>';
}
   
if ( $action == "insert") {

}



echo json_encode($tab); // transmet l'objet JSON à js
