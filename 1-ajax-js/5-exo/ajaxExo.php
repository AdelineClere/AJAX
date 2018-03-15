<?php

require_once('init.php');
extract($_POST);


//⚠️⚠️⚠️ pour afficher le tablo des employés ?
if ( $action == 'affichage' ) 
{
    //⚠️ Requete pour aller chercher tous mes employes
    $result = $pdo->query("SELECT * FROM employes ORDER BY id_employes DESC");

    $tab['resultat'] = '<table border="1"><tr>';

    //⚠️ 1ère lg tablo (Je génère mes entêtes de col à partir des col SQL de la table)
    for ( $i=0 ; $i < $result->columnCount() ; $i++ )
    {
        $infos_colonne = $result->getColumnMeta($i);
        $tab['resultat'] .= '<th>' . $infos_colonne['name'] . '</th>';
    }
    $tab['resultat'] .= '</tr>';

    //⚠️ Je pacours tous les employés (Je boucle sur mes enregistrements)
    while ( $employe = $result->fetch(PDO::FETCH_ASSOC) )
    {
        $tab['resultat'] .= '<tr>';
        for ( $i=0 ; $i < $result->columnCount() ; $i++ )
        {
            $infos_colonne = $result->getColumnMeta($i);
            $nom_colonne = $infos_colonne['name'];
            //⚠️ à chq tour de la boucle for je récup la val stockée ds la col pour chq employé
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
