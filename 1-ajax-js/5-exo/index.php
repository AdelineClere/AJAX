<?php

// EXO
/*
Aff un tablo ac ts les employes ds une <div>
Un formul pour insérer un employé et met à jour le tablo en AJAX
*/
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>EXO</title>
</head>
<body>


<form method="post" action="">
<fieldset>
    <legend>Insérer un employé</legend>
    
        <label for="nom">Nom</label>
        <input type="text" class="form-control" id="nom" name="nom" placeholder="nom"><br>

        <label for="prenom">Prénom</label>
        <input type="text" class="form-control" id="prenom" name="prenom" placeholder="prenom"><br>
        
        <label for="sexe">Sexe</label>
        <select class="form-control" id="sexe" name="sexe">
            <option value="m">Homme</option>
            <option value="f">Femme</option>
        </select><br>

        <label for="service">Service</label>
        <input type="text" class="form-control" id="service" name="service" placeholder="service"><br>

        <label for="date_emb">Date d'embauche</label>
        <input type="text" class="form-control" id="date_emb" name="date_emb" placeholder="date_emb"><br>
    	
    <button type="submit">Insérer</button>
</fieldset>
</form>




    
    <div id="employes">
        <?php

        require_once('init.php');

        ?>
    </div>

    <script src="ajaxExo.js"></script>

</body>
</html>