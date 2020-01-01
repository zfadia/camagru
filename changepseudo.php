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
   
</header>

<body>
<?php
include 'header.php';
?>    
    <div id="bloc_page">
        <form action="" method="POST">
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
        if (isset($_POST['pseudo']) && isset($_POST['newpseudo']) &&
            !empty($_POST['pseudo']) && !empty($_POST['newpseudo'])
        ) {
            $req = $bdd->prepare('UPDATE data_user set pseudo=?  WHERE pseudo=?');
            $req->execute(array($_POST['newpseudo'], $_POST['pseudo']));
            echo '<p> felicitation vous avez modifier votre pseudo </p>';
        }
    } 
    else
    {
        echo "remplire les champs avec des info differente";
    }

    ?>
</body>

</html>