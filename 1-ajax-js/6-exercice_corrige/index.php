<?php

/* Exercice
Afficher un tableau avec TOUS les employes dans une <DIV>

Sur chaque ligne prévoir une action de suppression s'executant en AJAX

*/
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>  
		
	<form action="#" method="post">
		<fieldset>
		<legend>Insérer un employé</legend>
		
		<label for="prenom"> Prénom <input type="text" id="prenom" name="prenom"> </label><br>
		<label for="nom"> Nom <input type="text" id="nom" name="nom"> </label><br>
		<label for="sexe"> Sexe 
		<select id="sexe" name="sexe">
			<option value="m">Homme</option>
			<option value="f">Femme</option>
		</select>
		</label><br>
		<label for="service"> Service <input type="text" id="service" name="service"> </label><br>
		<label for="date_emb"> Date Embauche <input type="text" id="date_emb" name="date_emb" placeholder="AAAA-MM-JJ"></label><br>
		<label for="salaire"> Salaire <input type="text" id="salaire" name="salaire"> </label><br>
		<input type="submit" id="submit" value="insérer">
		</fieldset>
	</form>
	
	<div id="employes"></div>
	
    <script src="ajax.js"></script>
</body>
</html>