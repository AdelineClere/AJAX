<?php

require_once('inc/init.php');

if ( isset($_POST['connexion']) )   //⚠️ si j'ai cliqué sur connexion
{
    if ( !empty($_POST['pseudo']) ) {  //⚠️ 1ère vérif ! si pseudo pas vide > tt la suite...

        $result = $pdo->prepare("SELECT * FROM membre WHERE pseudo = :pseudo"); //⚠️ on prépare le marqueur pour pseudo
        $result->execute(array(
            'pseudo' => $_POST['pseudo']
        ));

        $membre = $result->fetch(PDO::FETCH_ASSOC); //comme id -> unique -> directt fetch

        if ( $result->rowCount() == 0)
        {
            // insertion nv membre
            $insert = $pdo->prepare("INSERT INTO membre VALUES (NULL, :pseudo, :civilite, :ville, :date_naiss, :ip, ".time().") ");
            $insert->execute(array(
                'pseudo'        => $_POST['pseudo'],
                'civilite'      => $_POST['civilite'],
                'ville'         => $_POST['ville'],
                'date_naiss'    => $_POST['date_naiss'],
                'ip'            => $_SERVER['REMOTE_ADDR']
            ));
            $id_membre = $pdo->lastInsertId(); // dernier id inséré pour ce membre
        }
        elseif ($result->rowCount() > 0 && $membre['ip'] == $_SERVER['REMOTE_ADDR'])   
        // ! possibl de se connecter qu'ac son propre ordi !
        {
            // le pseudo est connu, il a la même adresse IP > Mise à jour de sa dernière date d'activité
            $update = $pdo->prepare("UPDATE membre SET date_connexion = ".time()." WHERE id_membre = :id_membre");
            $update->execute(array(
                'id_membre' => $membre['id_membre']
            ));
            $id_membre = $membre['id_membre'];  // je le reconnais ac son id_membre, je lui affecte pouer s'en servir après
        }
        else
        {
            // Le pseudo est déjà pris. L'informer qu'il doit le changer
            $msg .= '<div class="erreur">Ce pseudo est déjà utilisé</div>';
        }

        if ( empty($msg) )
        {
            $_SESSION['id_membre'] = $id_membre;     // je stock ses infos dssuper globale de session
            $_SESSION['pseudo'] = $_POST['pseudo'];  // car val déjà ds le post (puisque saisie ds le champ)
            header('location:index.php');            // redirection vers index.php    
        }
    }
    else
    {
        $msg = '<div class="erreur"> Merci de renseigner votre pseudo </div>';
    }
}



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Tchat</title>
    <link rel="stylesheet" href="inc/style.css">

</head>

<body>

    <?= $msg ?> <!-- voir si formulaire s'aff bien -->

    <form method="post" action="">
        <fieldset>
            
            <label for="pseudo"> Pseudo
                <input type="text" id="pseudo" name="pseudo">
            </label> <br>
            <p> Laissez les champs suivants vides si vous êts déjà membre</p>

            <label for="ville"> Ville
                <input type="text" id="ville" name="ville">
            </label> <br>

            <label for="date_naiss"> Date de naissance
                <input type="text" id="date_naiss" name="date_naiss">
            </label> <br>

            <label for="civilite"> Vous êtes : <br>
                <input type="radio" name="civilite" value="m" checked> un homme <br> 
                <input type="radio" name="civilite" value="f" checked> une femme <br> 
            </label> <br>

            <input type="submit" name="connexion" value="Se connecter au chat">

        </fieldset>

</body>
</html>