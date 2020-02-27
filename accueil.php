<?php
	// connexion à la base de données
    require_once('inc/connec.php');
    // récupération du nom et prénom
    require_once('inc/header.php'); 
?>
<!DOCTYPE html>
<html lang="fr">
<head>
	<meta charset="utf-8">
	<link rel="stylesheet" href="style_css/accueil.css">
	<title>page d'accueil</title>
</head>
<body>
	<!-- présentation de gbaf -->
	<h1> Le Groupement Banque Assurance Français </h1><br/>
		<p class="gbaf">
			Le Groupement Banque Assurance Français (GBAF) est une fédération représentant les 6 grands groupes français : </br></p>
				<ul class="gbaf">
					<li> BNP Paribas </li>
					<li> BPCE </li>
					<li> Crédit Agricole </li>
					<li>Crédit Mutuel-CIC </li>
					<li> Société Générale </li>
					<li> La Banque Postale </li>
				</ul>
		<p class="gbaf">Même s’il existe une forte concurrence entre ces entités, elles vont toutes travailler de la même façon pour gérer près de 80 millions de comptes sur le territoire national. 
		Le GBAF est le représentant de la profession bancaire et des assureurs sur tous les axes de la réglementation financière française. Sa mission est de promouvoir l'activité bancaire à l’échelle nationale.
		C’est aussi un interlocuteur privilégié des pouvoirs publics.
		</p>
	<br/><br/><br/>

	<!-- partenaires -->
	<h2>Partenaires</h2>

	<!-- partenaire formation_co -->
		<div>	
			<img class="alignLeft"; src="image/formation_co">
			<h3>Formation & Co</h3>
			<p>Formation&co est une association française présente sur tout le territoire...</p>
			<button class="alignRight";> <a href="partenaires.php?id=1">lire la suite</a></button>
		</div>
		<br/>

		<!-- partenaire protectpeople -->
		<div>	
			<img class="alignLeft"; src="image/protectpeople">
			<h3>Protectpeople</h3>
			<p>Protectpeople finance la solidarité nationale... </p>
			<button class="alignRight";> <a href="partenaires.php?id=2">lire la suite</a></button>
		</div>
		<br/>

				<!--partenaire Dsa_france -->
		<div>	
			<img class="alignLeft"; src="image/Dsa_france">
			<h3>Dsa France</h3>
			<p>Dsa France accélère la croissance du territoire et s’engage avec les collectivités territoriales... </p>
			<button class="alignRight";> <a href="partenaires.php?id=3">lire la suite</a></button>
		</div>
		<br/>


		<!-- partenaire CDE -->
		<div>	
			<img class="alignLeft"; src="image/CDE">
			<h3>CDE</h3>
			<p>La CDE (Chambre Des Entrepreneurs) accompagne les entreprises dans leurs démarches de formation... </p>
			<button class="alignRight";> <a href="partenaires.php?id=4">lire la suite</a></button>
		</div>

</body>
</html>