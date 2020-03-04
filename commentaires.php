<?php
require_once('inc/connec.php');
require_once('inc/header.php'); 

if(isset($_SESSION['id']) && !empty($_SESSION['id']))
{ 
    $reqmember = $bdd->prepare("SELECT * FROM membres WHERE id = ? ");
    $reqmember->execute(array($_SESSION['id'])); 
    $memberinfo = $reqmember->fetch();

    //insère le commentaire
    if(isset($_POST['submit_commentaire']))
    {
        
        $_POST['id_user'] = $_SESSION['id'];
        $_POST['prenom'] = $_SESSION['prenom'];
        if(isset($_POST['prenom'], $_POST['commentaire'])) 
        {
            if(!empty($_POST['prenom']) AND !empty($_POST['commentaire'])) 
            {
                $prenom = htmlspecialchars($_POST['prenom']);
                $commentaire = htmlspecialchars($_POST['commentaire']);

                $inscommentaires = $bdd->prepare('INSERT INTO commentaires(id_article, id_user, prenom, commentaire, date_publi) VALUES (?, ?, ?, ?, NOW())');
                $inscommentaires->execute(array($_GET['id'], $_POST['id_user'], $_POST['prenom'], $commentaire));

                $erreur = 'Votre commentaire à bien été ajouté !';
            }
            else
            {
                $erreur = 'Veuillez remplir tous les champs!';
            }
        } 
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Rédaction</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="style_css/commentaire.css" />
</head>
<body> 
    <form class="form" method="POST">
        <label class="prenom"> Prénom : </label> <br/> <br/>
        <input class="forminput" type="text" name="name" value="<?php echo $memberinfo['prenom']?>" />  <br/> <br/> 
        <textarea class="formtext" name="commentaire" placeholder="Veuillez saisir votre commentaire"></textarea> <br/> <br/> 
        <input class="formbouton" type="submit" value="Envoyer le commentaire !" name="submit_commentaire" /> <br/>
    </form> 
        <?php if(isset($erreur)) {echo $erreur;}?>
</body>
</html>






