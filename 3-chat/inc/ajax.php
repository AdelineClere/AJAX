<?php
require_once('init.php');

$tab = array();
extract($_POST);  
//⚠️ transforme les index (de tablo superglobale POST) des tableaux php en variables et valeurs en face qui vont ac
/*
$_POST (
    'action' => 'affichage_message'  // ds $_POST on a action associée à qqch
    'lastid => 2     
)
extract -> $action, $lastid   // extract génère 2 variables, ds le 1er met 'affichage message', ds les 2è il met '2'
*/
        // >>> systé"matiqut on extraye $_POST


//⚠️⚠️⚠️ AFFICHAGE DU MESSAGE
//⚠️ Rel° js/ajax : on a prévu 3 actions js qui corresp. à 3 act° php :
if ( $action == 'affichage_message') {  
// ac l'extract de $_POST je m'attends à ce qu'il y ai une action avec des valeurs
    $lastid = (integer)($lastid);
    $result = $pdo->prepare(
    "SELECT d.id_dialogue, m.pseudo, m.civilite, d.message, date_format (d.date, '%d/%m%Y - %H:%i:%s') as datefr 
    FROM dialogue d, membre m 
    WHERE d.id_dialogue > :lastid 
    AND d.id_membre = m.id_membre
    ORDER BY d.date ASC");  //⚠️ on souhaite les nvx messages à partir du dernier id connu

    if ($result->execute( array(
        'lastid' => $lastid
    )) ) {

    $tab['validation'] = 'ok';

        $tab['resultat'] = '';
        $tab['lastid'] = $lastid;
        while ( $message = $result->fetch(PDO::FETCH_ASSOC))  //⚠️ tant que j'ai des msg
        {
            if ($message['civilite'] == 'm') { $color = "bleu"; }
            if ($message['civilite'] == 'f') { $color = "rose"; }
                
            $tab['resultat'] .= '<p class="'.$color. '">' .$message['datefr'] .' <strong>' . $message['pseudo'] . '</string>&#9658; '. $message['message'] . '</p>';
            $tab['lastid'] = $message['id_dialogue'];                   
        }
    }
}

//⚠️⚠️⚠️ AFFICHAGE MEMBRE(S) CONNECTE(S)
if ( $action == 'affichage_membre_connecte') {

    //⚠️ réactuliser la liste des membres ac ceux qui ont une activité il y a + de 3600 sec
    $result = $pdo->query("SELECT * FROM membre WHERE date_connexion > " . (time() - 3600) . " ORDER by pseudo");
    $tab['resultat'] = '<h2> Membres connectés </h2>' ;
    if ( $result->rowCount() > 0 )
    {
        $tab['validation'] = 'ok';  //⚠️ condition à remplir pour effectuer la mise à jour
    }
    //⚠️ je liste les membres ayant eu une activité ds la dernière heure (3600 sec)
    while ( $membre = $result->fetch(PDO::FETCH_ASSOC) )
    {
        if ($membre['civilite'] == 'm') { $color = "bleu"; $civ="Homme";}
        if ($membre['civilite'] == 'f') { $color = "rose"; $civ="Femme";}
            
        $tab['resultat'] .= '<p class="' . $color . '" title="' . $civ . ',' .$membre['ville'] . ',' . age($membre['date_de_naissance']) . ' ans">' . ucfirst($membre['pseudo']) . '</p>';
        // la class de p = la $color (bleu ou rose)  / ⚠️ ucfirst => maj 1ère lettre
    }  
}

if ( $action == 'envoi_message' ) {

    $message = htmlspecialchars($message, ENT_QUOTES); //⚠️ convertit les caractères html, et ENT_QUOTES => '' et "" restent intacts
    if ( !empty($message) ) {

        //⚠️ insertion de msg
        $result = $pdo->prepare("INSERT INTO dialogue (id_membre, message, date)
                                 VALUES (:id_membre, :message, now() )");
        if ( $result->execute(array (
            'id_membre' => $_SESSION['id_membre'],
            'message' => $message
        ))) {
            $tab['validation'] = 'ok' ;
        }
        //⚠️ on va actualiser la dernière date d'activité du membre à chq fois qu'il écrit
        $result = $pdo->prepare("UPDATE membre SET date_connexion = :date_connexion WHERE id_membre = :id_membre");
        $result->execute(array (
            'date_connexion' => time(),
            'id_membre' => $_SESSION['id_membre']
        ));
    }
}

if ($action == "deco")
{
    session_destroy();
    $tab['validation'] = 'ok';
}


echo json_encode($tab);


?>