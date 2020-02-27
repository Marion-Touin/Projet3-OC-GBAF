<?php
session_start();

require_once('inc/connec.php');

if(isset($_GET['id']) AND $_GET['id'] > 0) {
   $getid = intval($_GET['id']);
   $requser = $bdd->prepare('SELECT * FROM membres WHERE id = ?');
   $requser->execute(array($getid));
   $userinfo = $requser->fetch();
?>
<html>
   <head>
      <title>Header</title>
      <meta charset="utf-8">
       <link rel="stylesheet" href="style_css/style.css">
   </head>
   <body>
      <header>
         <img class="logo_gbaf" src="image/gbaf" alt="Logo GBAF">
         <p class="membre"> <a href="parametreducompte.php"><img class="img_profil" src="image/img-profil" alt="Profil"></a><?php echo $_SESSION['prenom']." ".$_SESSION['nom'];?></p>
         <p class="deco"> <a href="deconnexion.php"> Se déconnecter </a> </p>        
      </header>
   </body>
</html>
<?php   
}
?>
