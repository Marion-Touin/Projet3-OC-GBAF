<?php
// connexion à la base de données
require_once('inc/connec.php');
require('inc/header.php'); 

//récupération du membre connecté
if(isset($_SESSION['id']) && !empty($_SESSION['id']))
{ 
    $reqmember = $bdd->prepare("SELECT * FROM membres WHERE id = ? ");
    $reqmember->execute(array($_SESSION['id'])); 
    $memberinfo = $reqmember->fetch();

    // Récupération de l'article
    $req = $bdd->prepare('SELECT id, titre, contenu, DATE_FORMAT(date_creation, \'%d/%m/%Y à %Hh%imin%ss\') AS date_creation_fr FROM articles WHERE id = ?');
    $req->execute(array($_GET['id']));
    $donnees = $req->fetch();

    //like/dislike
    $likes = $bdd->prepare('SELECT id FROM likes WHERE id_article = ?');
    $likes->execute(array($_GET['id']));
    $likes = $likes->rowCount();

    $dislikes = $bdd->prepare('SELECT id FROM dislikes WHERE id_article = ?');
    $dislikes->execute(array($_GET['id']));
    $dislikes = $dislikes->rowCount();
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title>Partenaires</title>
        <link rel="stylesheet" href="style_css/part.css"/> 
    </head> 
    <body>
        <!-- affichage du titre et du contenu -->        
        <div>
            <h1>
                <img class="logo" src="miniatures/<?= $donnees['id'] ?>.png" width="100" /> 
            </h1>
            <h2 class="partenaire">  
                <?php echo htmlspecialchars($donnees['titre']); ?>
            </h2>
            <p class="description">
            <?php
            echo nl2br(htmlspecialchars($donnees['contenu']));
            ?>
            </p>
        </div>

        <!-- like/dislike -->
        <div class="like">
            <a href="action.php?t=1like&id=<?= $_GET['id'] ?>"><img class="pouce" src="image/likes.png"> </a> (<?=$likes ?>)
            <a href="action.php?t=2dislike&id=<?= $_GET['id'] ?>"><img class="pouce" src="image/dislikes.png"> </a> (<?=$dislikes ?>)
        </div>
        <div class="bouton">
            <button class="boutoncom"> <a href="commentaires.php?id=<?= $_GET['id']?>"> Nouveau Commentaire </a> </button> 
        </div>
        <h3>Commentaires</h3>
        <?php
        $req->closeCursor();

        // Récupération des commentaires
        $req = $bdd->prepare('SELECT id_article, id_user, prenom, commentaire, DATE_FORMAT(date_publi, \'%d/%m/%Y \') AS date_commentaire_fr FROM commentaires WHERE id_article = ? ORDER BY date_publi DESC');
        $req->execute(array($_GET['id']));

        while ($donnees = $req->fetch()) {

        ?>
        <div class="commentaire">
            <p class="nom"><?php echo $donnees['prenom']; ?></p>
            <p class="date">Le <?php echo $donnees['date_commentaire_fr']; ?> </p>
            <p class="com"><?php echo $donnees['commentaire']; ?></p>
        </div>
        <?php
        } // Fin de la boucle des commentaires
        $req->closeCursor();
        ?>
<?php require_once('inc/footer.php'); ?>
</body>
</html>
