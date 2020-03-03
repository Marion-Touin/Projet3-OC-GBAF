 <?php
session_start();

// connexion à la base de données
require_once('inc/connec.php');

if (isset($_POST['form_oublie']))
{
    // vérification que tout les champs sont remplis !
    if (!empty($_POST['username']) AND !empty($_POST['question']) AND !empty($_POST['reponse']) AND !empty($_POST['password']))
    {   
        //empêcher le code html
        $username = htmlspecialchars($_POST['username']);
        $question = htmlspecialchars($_POST['question']);
        $reponse = htmlspecialchars($_POST['reponse']);
        $password = password_hash($_POST['password'], PASSWORD_ARGON2I);
        {
            //récupération information du membre
            $reqmembre = $bdd->prepare('SELECT * FROM membres WHERE username = :username AND question = :question AND reponse = :reponse ');
            $reqmembre->execute([':username'=>$username, ':question'=>$question, ':reponse'=>$reponse]);
            $membreexist = $reqmembre->rowCount();
            if ($membreexist == 1) 
            {
                //insertion du nouveau mdp
                $membreinfo = $reqmembre->fetch();
                $_SESSION['id'] = $membreinfo['id'];
                $insererMotDePasse = $bdd->prepare('UPDATE membres SET password = ? WHERE id = ?');
                $insererMotDePasse->execute(array($password, $_SESSION['id']));
                header('location: connexion.php');
            }
            else
            {
            $message = ' Pseudo ou réponse incorrect ';
            }
        }

    }
    else
    {
        $message = ' Tous les champs doivent être remplis';
    }
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title >Mot de passe oublié</title>
        <link rel="stylesheet" href="style_css/mdp.css">
    </head>
    <body>   
        <div>    
            <img class="logo" src="image/logo-gbaf" alt="logo gbaf"> <br/>
            <h1>Mot de passe oublié</h1>
        </div>

        <div class="form clear">
            <form method="POST">   
                <label class="formlabel" for="username">Pseudo</label><br/>
                <input class="forminput" type="text" name="username" placeholder="Entrer votre pseudo"><br/> 

                <label class="formlabel" for="question" > Question secrète : </label> <br/>
                <select class="forminput" name="question" >
                <option value="1"> Quel est le nom de votre mère ? </option>
                <option value="2"> Quel est la destination de vos rêves ? </option>
                <option value="3"> Quel est le métier de votre père ? </option>
                </select> <br/>
                      
                <label class="formlabel" for="reponse"> Réponse à la question secrète</label><br/>
                <input class="forminput" type="text" name="reponse" placeholder="Entrer la réponse à la question secrète"><br/>

                <label class="formlabel" for="password"> Nouveau mot de passe</label><br/>
                <input class="forminput" type="password" name="password" placeholder="Saisissez un nouveau mot de passe"> <br/>

                <input type="submit" name="form_oublie" value="Envoyer"><br/> 

                <p class="lien"> Si vous ne possédez pas de compte, veuillez vous inscrire <a href="inscription.php"> ICI </a> ! <br/> 
                Si vous possédez un compte, veuillez vous connectez <a href="connexion.php"> ICI </a> ! </p> 
            </form>
                <?php
                    if (isset($message)) 
                    {
                    ?>
                        <p class="message"> <?php echo $message ; ?></p>
                    <?php
                    }
                ?>
        </div>
            <?php require_once('inc/footer.php'); ?>
    </body>
</html>

