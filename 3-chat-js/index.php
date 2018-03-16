<?php

/*
$_SERVER['REMOTE_HOST'];
    Cette super globale $_SERVER renvoie l'adresse IP du client (remote = adresse distante) sur son entrée REMOTE_ADDR (SERVEUR_ADDR = ce serait serveur lui-même, là ou s'exécute le script)    

    (car pbl ici mdp = adresse IP !! Jamais !)
*/

require_once('inc/init.php');

//⚠️ si on a pas de pseudo en session <=> pas encore passé par pg de connexion => le rediriger
if ( !isset($_SESSION['pseudo']) )
{ 
    header('location:connexion.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Chat</title>
    <link rel="stylesheet" href="inc/style.css">
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script src="inc/ajax.js"></script>
</head>
<body>
    
    <div id="conteneur">

        <div id="message_tchat">

            <h2>Connecté en tant que <?= $_SESSION['pseudo'] ?></h2>
            <?php
                // Jointures de tables SQL :
                $result = $pdo->query("SELECT d.id_dialogue, m.pseudo, m.civilite, d.message, date_format(d.date, '%d/%m/%Y - %H:%i:%s') as datefr 
                FROM dialogue d, membre m 
                WHERE m.id_membre = d.id_membre 
                ORDER BY date") ;

                while ( $dialogue = $result->fetch(PDO::FETCH_ASSOC) )
                {
                    if ($dialogue['civilite'] == 'm') { $color = "bleu"; $civ="Homme";}
                    if ($dialogue['civilite'] == 'f') { $color = "rose"; $civ="Femme";}
                    ?>
                    <p class="<?= $color ?>">
                        <?= $dialogue['datefr'] ?>
                        <strong><?= $dialogue['pseudo'] ?></strong> &rarr;
                        <?= $dialogue['message'] ?>
                    </p>
                    <?php
                }
            ?>
        </div>

        <div id="liste_membre_connecte">

            <h2>Membre(s) connecté(s)</h2>
            <?php
            $result = $pdo->query("SELECT * FROM membre WHERE date_connexion > ". (time() - 3600)." ORDER BY pseudo");
            // si, on a une activité sur la dernière H => aff membres 
            while ($membre = $result->fetch(PDO::FETCH_ASSOC) )
            {
                if ($membre['civilite'] == 'm') { $color = "bleu"; $civ="Homme";}
                if ($membre['civilite'] == 'f') { $color = "rose"; $civ="Femme";}
                ?>
                <p class="<?= $color ?>" title="<?= $civ . ',' . $membre['ville'] . ',' . age($membre['date_de_naissance']) . ' ans ' ?>"><?= ucfirst($membre['pseudo']) ?></p>
                <?php
            }
            ?>
        </div>

        <div class="clear"> <!-- pr stopper effet flottant du float left -->
        </div>

        <div id="smiley">
        </div>

        <div id="formulaire_tchat">
            <form method="post" action"#">
                <input class="textarea" type="text" id="message" name="message" maxlength="255"> 
                <!-- car si varchar, il est limité à 255 car. en BDD -->
                <input type="submit" name="envoi" value="envoi" class="submit">
        </div>

    </div>

</body>
</html>