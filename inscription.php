<?php
// connexion à la base de données
require_once('inc/connec.php');

if(isset($_POST['inscription'])) 
{
	$nom = htmlspecialchars($_POST['nom']);
	$prenom = htmlspecialchars($_POST['prenom']);
  $username = htmlspecialchars($_POST['username']);
  $password = password_hash($_POST['password'], PASSWORD_ARGON2I);
  $question = $_POST['question'];
  $reponse = htmlspecialchars($_POST['reponse']);
    if(!empty($_POST['nom']) AND !empty($_POST['prenom']) AND !empty($_POST['username']) AND !empty($_POST['password']) AND !empty($_POST['question']) AND !empty($_POST['reponse'])) 
   	{
      $usernamelength = strlen($username);
      if($usernamelength <= 255) 
      {
        $requsername = $bdd->prepare("SELECT * FROM membres WHERE username = ?");
        $requsername->execute(array($username));
        $usernameexist = $requsername->rowCount();
          if($usernameexist == 0) 
          {
            $insertmbr = $bdd->prepare("INSERT INTO membres(nom, prenom, username, password, question, reponse) VALUES(?, ?, ?, ?, ?, ?)");
            $insertmbr->execute(array($nom, $prenom, $username, $password, $question, $reponse));
            $erreur = "Votre compte a bien été créé ! <a href=\"connexion.php\">Me connecter</a>";
          } 
	    }
    }
}
?>
<html lang="fr">
   <head>
      <meta charset="utf-8">
      <title>Inscription</title>
      <link rel="stylesheet" href="style_css/inscriptions.css">
   </head>
   <body>
      <img class="logo" src="image/logo-gbaf" alt="logo gbaf">  
          
      <div class="form">

        <div>
          <h1> Formulaire d'inscription</h1>
          <form method="POST" action="">
          <label class="form-label" for="nom"> Nom </label> <br/>
          <input class="form-input" type="text"  placehorder="nom" name="nom" id="nom" value="<?php if(isset($nom)) { echo $nom; }?>"> 
		    </div>

		    <div>
          <label class="form-label" for="prenom"> Prenom </label> <br/>
          <input class="form-input" type="text" placehorder="prenom" name="prenom" id="prenom" value="<?php if(isset($prenom)) { echo $prenom; }?>">
		    </div>

		    <div>
          <label class="form-label" for="username">	Pseudonyme </label> <br/>
          <input class="form-input" type="text" placehorder="username" name="username" id="username" value="<?php if(isset($username)) { echo $username; }?>">
		    </div>

		    <div>
          <label class="form-label" for="password">	Mot de passe </label> <br/>
          <input class="form-input" type="password" placehorder="password" name="password" id="password"> 
		    </div>

        <div>
          <label class="form-label" for="question" > Question secrète <br/>
          <select class="form-input" name="question" >
          <option value="1"> Quel est le nom de votre mère ? </option>
          <option value="2"> Quel est la destination de vos rêves ? </option>
          <option value="3"> Quel est le métier de votre père ? </option>
          </label>
          </select>
        </div>

		    <div>
          <label class="form-label" for="reponse"> Réponse question secrète</label> <br/> 
          <input class="form-input" type="text" placehorder="reponse" name="reponse" id="reponse"> 
		    </div>

		    <div>
          <input type="submit" name="inscription" value="Valider"> 
		    </div>
          
          <p class="para"> Si vous possédez déjà un compte,connectez-vous <a class="para" href="connexion.php">ICI</a>! </p>
          </form>
         
        <?php
         if(isset($erreur)) {
            echo '<font color="red">'.$erreur."</font>";
         }
         ?>
      </div>
        
        <?php require_once('inc/footer.php'); ?>
   </body>
</html>