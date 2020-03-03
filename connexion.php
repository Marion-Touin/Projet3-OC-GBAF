<?php
// connexion à la base de données
require_once('inc/connec.php');

// envoie du formulaire
if(isset($_POST['formconnexion'])) 
{
  // empêcher d'écrite de l'html
  $username = htmlspecialchars($_POST['username']);
  $password = htmlspecialchars($_POST['password']);

  //vérification que les champs soient remplis
  if(!empty($username) AND !empty($password)) 
  {    
    $requser = $bdd->prepare("SELECT * FROM membres WHERE username = :username");
    $requser->execute(array(
      'username' => $_POST['username']));
      $userinfo = $requser->fetch();

      // vérification du mot de passe
      $passwordcorrect = password_verify($_POST['password'], $userinfo['password']);

        if($passwordcorrect)
        {
          session_start();
          $_SESSION['id'] = $userinfo['id'];
          $_SESSION['nom'] = $userinfo['nom'];
          $_SESSION['prenom'] = $userinfo['prenom'];
          header("Location: accueil.php?id=".$_SESSION['id']);
        } 
        else 
        {
          $erreur = "Mauvais pseudo ou mot de passe !";
        }    
   }  
  else 
  {
    $erreur = "Tous les champs doivent être complétés !";
  }
}
?>
<html>
  <head>
    <title>Connexion</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="style_css/connex.css">
  </head>
  <body>
    <!-- Logo gbaf -->
    <img class="logo" src="image/logo-gbaf" alt="Logo gbaf">

      <div>
        <!-- Formulaire -->
        <form class="form" method="post" action="">
        <h1> Connexion</h1>
        
        <div>
          <label class="form-label" for="username">  Pseudonyme </label> <br/>
          <input class="form-input" type="text" placehorder="username" name="username" > </br> </br>
        </div>

        <div>
          <label class="form-label" for="password"> Mot de passe </label> <br/>
          <input class="form-input" type="password" placehorder="password" name="password" > </br> </br>
        </div>

        <div>
          <input type="submit" name="formconnexion" value="Se connecter !">
        </div>

          <p> Si vous  ne possédez pas de compte, veuillez vous inscrire <a href="inscription.php">ICI</a>! </p>
          <a class="mdp" href="mdpoublie.php"> Mot De Passe Oublié </a>
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
