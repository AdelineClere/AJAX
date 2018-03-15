<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>AJAX INSERT ID</title>
</head>
<body>
    
    <form method="post" action="#"> <!-- si pas # il recharge la pg. Ac le # + js on le stop -->
        <input type="text" name="personne" id="personne" placeholder="Prénom à insérer">
        <input type="submit" value="ok" id="submit">
    </form>
    <div id="resultat"></div>
    <!--⚠️Objectif : sur clic btn de formulaire on veut insérer 1 prénom ds table employé, et recevoir une confirmation par ajax.js 
    (Rq : je le fais en ajax = de manière asynchrone, pour confort : pas besoin rafraichir pg, mais on fait bien appel à php)  -->

    <script src="ajax.js"></script>

</body>
</html>