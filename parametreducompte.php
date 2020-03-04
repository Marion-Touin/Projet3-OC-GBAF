<?php
// connexion à la base de données
require_once('inc/connec.php');
// récupération du nom et prénom
require_once('inc/header.php'); 

// récupération du membre connecté
if(isset($_SESSION['id'])) 
{
   $requser = $bdd->prepare("SELECT * FROM membres WHERE id = ?");
   $requser->execute(array($_SESSION['id']));
   $user = $requser->fetch();

      // changement des différents champs
      if(isset($_POST['newnom']) AND !empty($_POST['newnom']) AND $_POST['newnom'] != $user['nom']) 
      {
        $newnom = htmlspecialchars($_POST['newnom']);
        $insertusername = $bdd->prepare("UPDATE membres SET nom = ? WHERE id = ?");
        $insertusername->execute(array($newnom, $_SESSION['id']));
        header('Location: accueil.php?id='.$_SESSION['id']);
      }
      if(isset($_POST['newprenom']) AND !empty($_POST['newprenom']) AND $_POST['newprenom'] != $user['prenom']) 
      {
        $newprenom = htmlspecialchars($_POST['newprenom']);
        $insertusername = $bdd->prepare("UPDATE membres SET prenom = ? WHERE id = ?");
        $insertusername->execute(array($newprenom, $_SESSION['id']));
        header('Location: accueil.php?id='.$_SESSION['id']);
      }
      if(isset($_POST['newusername']) AND !empty($_POST['newusername']) AND $_POST['newusername'] != $user['username']) 
      {
        $newusername = htmlspecialchars($_POST['newusername']);
        $insertusername = $bdd->prepare("UPDATE membres SET username = ? WHERE id = ?");
        $insertusername->execute(array($newusername, $_SESSION['id']));
        header('Location: accueil.php?id='.$_SESSION['id']);
      }
      if(isset($_POST['newpassword']) AND !empty($_POST['newpassword']) AND $_POST['newpassword'] != $user['password']) 
      {
        $newpassword = htmlspecialchars($_POST['newpassword']);
        $insertmail = $bdd->prepare("UPDATE membres SET password = ? WHERE id = ?");
        $insertmail->execute(array($newpassword, $_SESSION['id']));
        header('Location: accueil.php?id='.$_SESSION['id']);
      }
      if(isset($_POST['question']) AND !empty($_POST['question']) AND $_POST['question'] != $user['question']) 
      {
        $question = htmlspecialchars($_POST['question']);
        $insertusername = $bdd->prepare("UPDATE membres SET question = ? WHERE id = ?");
        $insertusername->execute(array($question, $_SESSION['id']));
        header('Location: accueil.php?id='.$_SESSION['id']);
      }
      if(isset($_POST['newreponse']) AND !empty($_POST['newreponse']) AND $_POST['newreponse'] != $user['reponse']) 
      {
        $newreponse = htmlspecialchars($_POST['newreponse']);
        $insertusername = $bdd->prepare("UPDATE membres SET reponse = ? WHERE id = ?");
        $insertusername->execute(array($newreponse, $_SESSION['id']));
        header('Location: accueil.php?id='.$_SESSION['id']);
      }
?>
<html>
   <head>
      <title>Paramètre du compte</title>
      <meta charset="utf-8">
      <link rel="stylesheet" href="style_css/parametreducompte.css">
   </head>
   <body>
      <div>
        <img class="logo" src="image/logo-gbaf" alt="logo gbaf">
         <div class="form">
          <h1>Édition de mon profil</h1>
            <form method="POST" action="" enctype="multipart/form-data">
              <label class="form-label">Nom </label> <br/>
              <input class="form-input" type="text" name="newnom" placeholder="Nom" /><br />

              <label class="form-label">Prénom:</label> <br/>
              <input class="form-input" type="text" name="newprenom" placeholder="Prénom" /><br />

              <label class="form-label">Pseudonyme</label> <br/>
              <input class="form-input" type="text" name="newusername" placeholder="Pseudonyme" /><br />

              <label class="form-label">Mot de passe </label> <br/>
              <input class="form-input" type="password" name="newpassword" placeholder="Mot de passe" /><br />

              <label class="form-label" for="question" > Question <br/>
              <select class="form-input" name="question">
              <option value="1"> Quel est le nom de votre mère ? </option>
              <option value="2"> Quel est la destination de vos rêves ? </option>
              <option value="3"> Quel est le métier de votre père ? </option>
              </label>
              </select> <br/> 
              
              <label class="form-label">Réponse</label> <br/>
              <input class="form-input" type="text" name="newreponse" placeholder="Réponse" /><br/><br/>

              <input class="form-submit" type="submit" value="Mettre à jour mon profil !"/>
            </form>
            <?php if(isset($msg)) { echo $msg; } ?>
         </div>
      </div>
      <?php require_once('inc/footer.php'); ?>
   </body>
</html>
<?php   
}
else {
   header("Location: connexion.php");
}
?>

