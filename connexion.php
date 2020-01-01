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
        <form action="" method="POST">
            <p><label>pseudo : </label><input type="text" name="pseudo" required /></p>
            <p><label>password : </label><input type="password" name="password" required /></p>
            <p><input type="submit" value="soumettre" /></p>
            <p><a href="Mot_de_passe_oublie_email.php">Mot de passe oublié ?</a></p>
            <?php
            include_once "fonction.php";
            random_2(50);?>
        </form>
    </div>
    <?php
    try {
        $bdd = new PDO('mysql:host=localhost;dbname=camagru;charset=utf8', 'root', 'rootroot');
    } catch (Exception $e) {
        die('error :' . $e->getMessage());
    }

    if (isset($_POST['pseudo'], $_POST['password'])) {
        $req = $bdd->prepare('SELECT pseudo ,id, `password` FROM data_user WHERE pseudo=? ');
        $req->execute(array($_POST['pseudo']));
        $new = $req->fetch();
        $hash = $new['password'];

        if (password_verify($_POST['password'], $hash)) {
            echo 'password_verify';
            header('Location:user_page.php');
        $_SESSION['id'] = $new ['id'];
        $_SESSION['pseudo'] = $new ['pseudo'];
        } else
            echo 'infornation incorecte';
    } else
        echo '<p>informations incorrect</p>';
        

        
    ?>

</body>


</html>