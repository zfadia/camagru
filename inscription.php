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
        <h2> inscription</h2>
    </div>

    <nav>
        <ul>
            <li><a href="connexion.php">connexion</a></li>
        </ul>
    </nav>
</header>

<body>
    <div id="bloc_page">
        <form action="" method="POST">
            <p><label>pseudo </label><input type="text" name="pseudo" required /></P>
            <p><label>email </label><input type="email" name="email" required /></p>
            <p><label>password </label><input type="password" name="password" required /></p>
            <input type="submit" value="soumettre">
        </form>
    </div>
    <?php

    try {
        $bdd = new PDO('mysql:host=localhost;dbname=camagru;charset=utf8', 'root', 'rootroot');
    } catch (Exception $e) {
        die('error :' . $e->getMessage());
    }

   include 'fonction.php';
    if (verifinscription($bdd)== 0)
    {
        if (
            isset($_POST['pseudo']) && isset($_POST['password']) && isset($_POST['email']) &&
            !empty($_POST['pseudo']) && !empty($_POST['password']) && !empty($_POST['email'])
        ) {
            echo '<p>felicitation vous etes inscrit</p>';
            $mdp = password_hash($_POST['password'], PASSWORD_DEFAULT);
            $req = $bdd->prepare('INSERT INTO data_user(pseudo, `password`, email, creation_date) VALUES (?,?,?,NOW())');
            $req->execute(array($_POST['pseudo'], $mdp, $_POST['email']));
            $req->closeCursor();
        } 
        else
             echo '<p> verifier vos informations </p>';

    }
    ?>

</body>
<footer>
    <div id="deconnecxon">
    <input type="submit" value="deconnecxion">
    </div>
</footer>

</html>