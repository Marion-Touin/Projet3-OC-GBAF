 <?php
session_start();

// connexion à la base de données
require_once('inc/connec.php');

if (isset($_POST['form_oublie']))
{
    if (!empty($_POST['username']) AND !empty($_POST['question']) AND !empty($_POST['reponse']) AND !empty($_POST['password']))
    {   
        $username = htmlspecialchars($_POST['username']);
        $question = htmlspecialchars($_POST['question']);
        $reponse = htmlspecialchars($_POST['reponse']);
        $password = sha1($_POST['password']);
        {
            $reqmembre = $bdd->prepare('SELECT * FROM membres WHERE username = :username AND question = :question AND reponse = :reponse ');
            $reqmembre->execute([':username'=>$username, ':question'=>$question, ':reponse'=>$reponse]);
            $membreexist = $reqmembre->rowCount();
            if ($membreexist == 1) 
            {
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
    <title> mot de passe oublié</title>
</head>
    <body>
            <div>
    
                <form method="POST">
                    <h3> Mot de passe oublié</h3>
                    <label for="username">Pseudo</label><br/>
                    <input type="text" name="username" placeholder="Entrer votre pseudo"><br/> <br/>

                    <label for="question" > Question secrète : </label> <br/>
                    <select name="question" >
                    <option value="1"> Quel est le nom de votre mère ? </option>
                    <option value="2"> Quel est la destination de vos rêves ? </option>
                    <option value="3"> Quel est le métier de votre père ? </option>
                    </select>
                     <br/> <br/>

                    <label for="reponse"> Réponse à la question secrète</label><br/>
                    <input type="text" name="reponse" placeholder="Entrer la réponse à la question secrète"><br/><br/>

                    <label for="password"> Nouveau mot de passe</label><br/>
                    <input type="password" name="password" placeholder="Saisissez un nouveau mot de passe"> <br/><br/>

                    <input type="submit" name="form_oublie" value="Envoyer"><br/>   
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
    </body>
</html>
