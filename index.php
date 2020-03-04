 <?php
// connexion à la base de données REDACTION
require_once('inc/connec.php');

  //pagination
  $articleparpage = 1;
  $articletotalReq = $bdd->query('SELECT id FROM articles');
  $articletotal = $articletotalReq->rowCount();
  $pagestotal = ceil($articletotal/$articleparpage);

    if(isset($_GET['page']) AND !empty($_GET['page']) AND $_GET['page'] > 0 AND $_GET['page'] > 0 AND $_GET['page'] <= $pagestotal) 
    {
      $_GET['page'] = intval($_GET['page']);
      $pagebis = $_GET['page'];
    } else 
    {
      $pagebis = 1;
    }
      $depart = ($pagebis-1)*$articleparpage;

      // récupération tous les articles
      $req = $bdd->query('SELECT id, titre, contenu, DATE_FORMAT(date_creation, \'%d/%m/%Y à %Hh%imin%ss\') AS date_creation_fr FROM articles ORDER BY date_creation DESC LIMIT '.$depart.','.$articleparpage);

      while ($donnees = $req->fetch())
{
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title>Articles</title>
    <link href="style.css" rel="stylesheet" /> 
    </head>        
    <body>
      <div class="news">
        <h1>
        <!-- On affiche l'article -->
        <img src="miniatures/<?= $donnees['id'] ?>.png" width="100" /> <br/>
        <?= $donnees['titre']; ?>
        </h1>
        <?= $donnees['contenu']; ?> <br/>
        <li><a href="partenaires.php?id=<?php echo $donnees['id']; ?>">Commentaires</a></li>
      </div>

<!--pagination -->
<?php
      for($i=1;$i<=$pagestotal;$i++) {
         if($i == $pagebis) {
            echo $i.' ';
         } else {
            echo '<a href="index.php?page='.$i.'">'.$i.'</a> ';
         }
      }
?>
<?php
} // Fin de la boucle des billets
$req->closeCursor();
?>
    </body>
</html>
