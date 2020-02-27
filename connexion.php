<?php
session_start();

// connexion à la base de données
require_once('inc/connec.php');

if(isset($_POST['formconnexion'])) {
   $usernameconnect = htmlspecialchars($_POST['username']);
   $passwordconnect = sha1($_POST['password']);
   if(!empty($usernameconnect) AND !empty($passwordconnect)) {
      $requser = $bdd->prepare("SELECT * FROM membres WHERE username = ? AND password = ?");
      $requser->execute(array($usernameconnect, $passwordconnect));
      $userexist = $requser->rowCount();
      if($userexist == 1) {
         $userinfo = $requser->fetch();
         $_SESSION['id'] = $userinfo['id'];
         $_SESSION['nom'] = $userinfo['nom'];
         $_SESSION['prenom'] = $userinfo['prenom'];
         header("Location: accueil.php?id=".$_SESSION['id']);
      } else {
         $erreur = "Mauvais mail ou mot de passe !";
      }
   } else {
      $erreur = "Tous les champs doivent être complétés !";
   }
}
?>
<html>
   <head>
      <title>TUTO PHP</title>
      <meta charset="utf-8">
      <link rel="stylesheet" href="style_css/connexion.css">
   </head>
   <body>
    <img class="alignCenter" src="image/logo-gbaf">
      <div align="center">
         <form class="form" method="post" action="">
           <h2> Connexion</h2>
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
   </body>
</html>