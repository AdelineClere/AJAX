<?php

//⚠️ connexion à ma BDD

$pdo = new PDO('mysql:host=localhost;dbname=chat','root','',array( PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING, PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));

//⚠️ Ouverture de session
session_start();


//⚠️ déclarer une variable (pr accueillir mssg erreur par exe etc.)
$msg = '';


//----------------------- FONCTIONS -----------------------------------


//⚠️ calculer âge. Date doit arriver au format AAA-MM-JJ
function age ( $naiss )
{
    /* ⚠️ J'explose chaine de caract en array : index 0 > année, 1 > mois, 2 > jour 
       (liste de variables = un array (= explode ('-',$naiss); )) */
    // j'explose la date de naiss en 3 variables et je stock l'année ds $y, mois ds $m, jour ds $d
    list($y , $m, $d) = explode('-',$naiss);

    //⚠️  Donner âge sans erreur !
    if ( $diff = (date('m') - $m) < 0 ) // ex (mois-courant) = 3 - (mois-naiss) -> si mois courant n'est pas encore son anniv j'ajoute 1 an à année de naiss pr lui donner son âge réel
    {
        $y++;
    } 
    elseif( $m == 0 && date('d') - $d < 0 ) // idem : si mois-naiss et mois-date = 0 >> regarder quel jour on est, etc..
    {
        $y++;
    }
    return date('Y') - $y;

}

