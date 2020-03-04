<?php
	// connexion à la base de données
    require_once('inc/connec.php');
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
			Le Groupement Banque Assurance Français (GBAF) est une fédération représentant les 6 grands groupes français :</br></p>
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

	<img class="illustration" src="image/illustration.png">

	<h2>Partenaires</h2>
	<!-- partenaire formation_co -->
	<div class="conteneur">	
		<div class="logo">
			<img src="image/formation_co.png" alt="logo formation&co">
		</div>
		<div>
			<h3>Formation & Co</h3>
			<p>Formation&co est une association française présente sur tout le territoire...</p>
			<button class="bouton"> <a href="partenaires.php?id=1">lire la suite</a></button>
		</div>
	</div>
		<br/>

		<!-- partenaire protectpeople -->
	<div class="conteneur">
		<div class="logo clear">	
			<img  src="image/protectpeople.png" alt="logo protectpeople">
		</div>
		<div>
			<h3>Protectpeople</h3>
			<p>Protectpeople finance la solidarité nationale... </p>
			<button class="bouton" > <a href="partenaires.php?id=2">lire la suite</a></button>
		</div>
	</div>	
		<br/>

		<!--partenaire Dsa_france -->
	<div class="conteneur">
		<div class=" logo clear">	
			<img  src="image/Dsa_france.png" alt="logo Dsa_france">
		</div>
		<div>
			<h3>Dsa France</h3>
			<p>Dsa France accélère la croissance du territoire et s’engage avec les collectivités territoriales... </p>
			<button class="bouton"> <a href="partenaires.php?id=3">lire la suite</a></button>
		</div>
	</div>
		<br/>

		<!-- partenaire CDE -->
	<div class="conteneur">
		<div class=" logo clear">	
			<img src="image/CDE.png" alt="logo CDE">
		</div>
		<div>
			<h3>Chambre Des Entrepreneurs</h3>
			<p>La CDE (Chambre Des Entrepreneurs) accompagne les entreprises dans leurs démarches de formation... </p>
			<button class="bouton"> <a href="partenaires.php?id=4">lire la suite</a></button> 
		</div>
	</div> 
	<br/>
<?php require_once('inc/footer.php'); ?>
</body>
</html>
