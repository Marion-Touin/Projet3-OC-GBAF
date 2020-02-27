 <?php
// connexion à la base de données
        try
        {
                $bdd = new PDO('mysql:host=localhost;dbname=projet_gbaf;charset=utf8', 'root', '');
        }
        catch(exception $e)
        {
                die('Erreur :'.$e-> getMessage());
        }