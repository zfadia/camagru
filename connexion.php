<?php
session_start();    
?>   
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="index.css" />
    <title>connexion</title>
</head>
<header>
    <div id="titre_principal">
        <h1> camagru </h1>
        <h2> connexion </h2>
    </div>

    <nav>
        <ul>
            <li><a href="inscription.php">inscription</a></li>
        </ul>
    </nav>
</header>

<body>
    <div id="bloc_page">
        <form action="" method="GET">
            <p><label>pseudo : </label><input type="text" name="pseudo" required /></p>
            <p><label>password : </label><input type="password" name="password" required /></p>
            <p><input type="submit" value="soumettre" /></p>
        </form>
    </div>
    <?php
    try {
        $bdd = new PDO('mysql:host=localhost;dbname=camagru;charset=utf8', 'root', 'rootroot');
    } catch (Exception $e) {
        die('error :' . $e->getMessage());
    }

    if (isset($_GET['pseudo'], $_GET['password'])) {
        $req = $bdd->prepare('SELECT pseudo ,id, `password` FROM data_user WHERE pseudo=? ');
        $req->execute(array($_GET['pseudo']));
        $new = $req->fetch();
        $hash = $new['password'];

        if (password_verify($_GET['password'], $hash)) {
            echo 'password_verify';
        $_SESSION['id'] = $new ['id'];
        $_SESSION['pseudo'] = $new ['pseudo'];
        } else
            echo 'infornation incorecte';
    } else
        echo '<p>informations incorrect</p>';

    ?>

</body>


</html>