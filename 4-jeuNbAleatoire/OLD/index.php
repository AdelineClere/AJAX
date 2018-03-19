<?php

require_once('inc/init.php');

?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Jeu Chiffre aléatoire</title>
</head>
<body>

   
            <button id="debut" type="button">LanDémarerr le jeu</button>

            
            <form method="post" action="#">
                <fieldset>
                <input class="text" type="text" id="chiffre" name="chiffre" maxlength="255"> 
                <input type="submit" name="envoi" value="envoi" class="submit">
                </fieldset>
            </form>

            <div>
                <p class="">J'ai choisi un nombre entre 1 et 100</p>
                <p class="">Mon nombre est plus grand</p>
                <p class="">Mon nombre est plus petit</p>
                <p class="">Vous avez épuisé votre nombre d'essai</p>
                <p class="">Bravo, vous avez trouvé   en      essais</p>
                
            </div>
        </div>      

    </div>

    
</body>
</html>

