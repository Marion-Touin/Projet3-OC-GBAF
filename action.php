<?php
session_start();
// connexion à la base de données
require_once('inc/connec.php');

//récupération du membre connecté
if(isset($_GET['id']) AND $_GET['id'] > 0) {
   $getid = intval($_GET['id']);
   $requser = $bdd->prepare('SELECT * FROM membres WHERE id = ?');
   $requser->execute(array($getid));
   $userinfo = $requser->fetch();

        if(isset($_GET['t'], $_GET['id']) AND !empty($_GET['t']) AND !empty($_GET['id']))
        {
            $getid = (int) $_GET['id']; 
            $gett = (int) $_GET['t'];

            //récupération des articles
            $session_id = $_SESSION['id'];
            $check = $bdd->prepare('SELECT id FROM articles WHERE id =?');
            $check->execute(array($getid));

            //récupération du membre
            $session_id = $_SESSION['id'];

                //Vérication si le nombre d'article est bon 
                if($check->rowCount() == 1) 
                {
                    if($gett == 1)
                    {   
                        // récuperer le likes
                        $check_like = $bdd->prepare('SELECT id FROM likes WHERE id_article = ? AND id_membre = ?');
                        $check_like->execute(array($_GET['id'], $session_id));

                        //enlever le dislikes si l'utilisateur en as un
                        $del = $bdd->prepare('DELETE FROM dislikes WHERE id_article = ? AND id_membre = ?');
                        $del->execute(array($_GET['id'], $session_id));
                    
                    if($check_like->rowCount() == 1)
                    {
                        //enlever le likes
                        $del = $bdd->prepare('DELETE FROM likes WHERE id_article = ? AND id_membre = ?');
                        $del->execute(array($_GET['id'], $session_id));
                    }
                    else
                    {   
                        //ajouter le likes
                        $ins = $bdd->prepare('INSERT INTO likes (id_article, id_membre) VALUES (?, ?)');
                        $ins->execute(array($getid, $session_id));
                    }   
                }
                elseif($gett == 2)
                {
                    // récupérer le dislikes
 			        $check_like = $bdd->prepare('SELECT id FROM dislikes WHERE id_article = ? AND id_membre = ?');
                    $check_like->execute(array($_GET['id'], $session_id));

                    // supprimer le likes si l'utilisateur en as un
                    $del = $bdd->prepare('DELETE FROM likes WHERE id_article = ? AND id_membre = ?');
                    $del->execute(array($_GET['id'], $session_id));

                if($check_like->rowCount() == 1)
                {
                    // enlever le dislikes
                    $del = $bdd->prepare('DELETE FROM dislikes WHERE id_article = ? AND id_membre = ?');
                    $del->execute(array($_GET['id'], $session_id));
                }
                else
                {
                    //insérer dislikes
                    $ins = $bdd->prepare('INSERT INTO dislikes (id_article, id_membre) VALUES (?, ?)');
                    $ins->execute(array($getid, $session_id));
                }
  		}
  		header('Location: http://localhost/projet_gbaf/partenaires.php?id='.$getid);
 	}
 }
}
?>