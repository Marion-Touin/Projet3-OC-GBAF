 <?php
require_once('inc/connec.php');

if(isset($_SESSION['id']) && !empty($_SESSION['id']))
{ 
    $reqmember = $bdd->prepare("SELECT * FROM membres WHERE id = ? ");
    $reqmember->execute(array($_SESSION['id'])); 
    $memberinfo = $reqmember->fetch();


//récupération de l'article
$req = $bdd->prepare('SELECT id, titre, contenu, DATE_FORMAT(date_creation, \'%d/%m/%Y \') AS date_creation_fr FROM articles WHERE id = ?');
$req->execute(array($_GET['id']));
$donnees = $req->fetch();

//insère le commentaire
if(isset($_POST['submit_commentaire']))
{
        $_POST['prenom'] = $_SESSION['prenom'];
        if(isset($_POST['prenom'], $_POST['commentaire'])) 
        {
                if(!empty($_POST['prenom']) AND !empty($_POST['commentaire'])) 
                {
                        $prenom = htmlspecialchars($_POST['prenom']);
                        $commentaire = htmlspecialchars($_POST['commentaire']);

                        $inscommentaires = $bdd->prepare('INSERT INTO commentaires(id_article, prenom, commentaire, date_publi) VALUES (?, ?, ?, NOW())');
                        $inscommentaires->execute(array($_GET['id'], $_POST['prenom'], $commentaire));

                        $erreur = 'Votre article à bien été ajouté !';
                }else
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
        <link href="style-css/commentaires.css" rel="stylesheet" />
</head>
<body>
        <!-- formulaire commentaire -->
        <h3>Commentaires</h3>
 
       
        <form method="POST">

                <input type="text" name="name" value="<?php echo $_SESSION['prenom']?>" /> <br/> <br/> 
                <textarea name="commentaire" placeholder="commentaire article"></textarea> <br/> <br/> 
                <input type="submit" value="Envoyer le commentaire !" name="submit_commentaire" /> <br/>
        </form> 
        <?php if(isset($erreur)) {echo $erreur;}?>
</body>
</html>






