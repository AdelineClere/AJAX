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
	<title>EXO 5. Tablo employés + form. pour insérer</title>
	<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script src="ajaxExo.js"></script>
</head>
<body>

<form action="#" method="post" id="myForm">

		<input type="hidden" name="action" id="action" value="insert">	
		<!-- Action insert devient 1 champ de mon form	-->

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
	

</body>
</html>