<?php

require_once('init.php');
extract($_POST);


if ($action == 'affichage'){

    // Requete pour aller chercher tous mes employes
    $result = $pdo->query("SELECT * FROM employes ORDER BY id_employes DESC");

    $tab['resultat'] = '<table border="1"><tr>';
    // je génére mes entetes de colonnes à partir des colonnes SQL de la table
    for ( $i=0 ; $i < $result->columnCount() ; $i++ )
    {
        $infos_colonne = $result->getColumnMeta($i);
        $tab['resultat'] .= '<th>' . $infos_colonne['name'] . '</th>';
    }
    $tab['resultat'] .= '</tr>';
    // Je boucle sur mes enregistrements
    while ( $employe = $result->fetch(PDO::FETCH_ASSOC) )
    {
        $tab['resultat'] .= '<tr>';
        for ( $i=0 ; $i < $result->columnCount() ; $i++ )
        {
            $infos_colonne = $result->getColumnMeta($i);
            $nom_colonne = $infos_colonne['name'];
            // à chaque tour de la boucle for, je vais récup la valeur stockée dans la colonne pour l'memployé choisi
            $tab['resultat'] .= '<td>' . $employe[$nom_colonne] . '</td>';
        }
        $tab['resultat'] .= '</tr>';

        /*
         $tab['resultat'] .= '<tr>
		 <td>' . $employe['id_employes'] . '</td>
		 <td>' . $employe['prenom'] . '</td>
		 <td>' . $employe['nom'] . '</td>
		 <td>' . $employe['sexe'] . '</td>
		 <td>' . $employe['service'] . '</td>
		 <td>' . $employe['date_embauche'] . '</td>
		 <td>' . $employe['salaire'] . '</td>
		 </tr>';

        */       
    }
    $tab['resultat'] .= '</table>';
}

if ($action == "insert"){



}


echo json_encode($tab);