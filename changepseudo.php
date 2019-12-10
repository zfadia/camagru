<?php
session_start();    
?>   
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <link rel="stylesheet" href="index.css" />
    <title> camagru </title>
</head>
<header>
    <div id="titre_principal">
        <h1> camagru </h1>
        <h2> modifier le pseudo </h2>
    </div>

    <nav>
        <ul>
            <li><a href="inscription.php">inscription</a></li>
            <li><a href="deconnexion.php">deconnexion</a></li>
        </ul>
    </nav>
</header>

<body>
    <div id="bloc_page">
        <form action="" method="GET">
            <p><label>pseudo </label><input type="text" name="pseudo" required /></P>
            <p><label>newpseudo </label><input type="text" name="newpseudo" required /></p>
            <input type="submit" value="soumettre">
            <p><a href="changemdp.php">changer de mot de passe</a></p>
        </form>
    </div>

    <?php
    try {
        $bdd = new PDO('mysql:host=localhost;dbname=camagru;charset=utf8', 'root', 'rootroot');
    } catch (Exception $e) {
        die('error :' . $e->getMessage());
    }
    include 'fonction.php';
    if (verifpseudo($bdd) == 0) {
        if (
            isset($_GET['pseudo']) && isset($_GET['newpseudo']) &&
            !empty($_GET['pseudo']) && !empty($_GET['newpseudo'])
        ) {
            $req = $bdd->prepare('UPDATE data_user set pseudo=?  WHERE pseudo=?');
            $req->execute(array($_GET['newpseudo'], $_GET['pseudo']));
            echo '<p> felicitation vous avez modifier votre pseudo </p>';
        }
    } else {
        echo "remplire les champs avec des info differente";
    }
    ?>
</body>
<footer>
    <div id="deconnecxon">
        <input type="submit" value="deconnecxion">
    </div>
</footer>

</html>