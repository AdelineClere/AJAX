<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>AJAX SELECT</title>
</head>
<body>
    
    <form method="post" action="">

        <div id="employes">
            <select id="personne" name="personne">  <!--⚠️ j'initialise mon select -->
                <?php

                require_once('init.php');
                $result=$pdo->query("SELECT * FROM employes");
                //⚠️ à chq tour boucle lit résultats de la requête = tant que j'ai des employés, j'utilise fct qui génère id + val = le prénom qui s'affiche
                while ( $employe = $result->fetch(PDO::FETCH_ASSOC) ){
                    ?>
                    <option value="<?= $employe['id_employes'] ?>"><?= $employe['prenom'] ?></option>
                    <?php
                }

                ?>
            </select>
        </div>  

        <!-- 2.⚠️⚠️ on peut virer btn
        <input type="submit" value="voir" id="submit">
        -->

    </form>

    <div id="resultat"></div>
    
    <script src="ajax.js"></script>
</body>
</html>