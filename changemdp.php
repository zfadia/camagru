<?php
session_start();    
?>    
<!DOCTYPE html>

<html>
    <?php
        try {
            $bdd = new PDO('mysql:host=localhost;dbname=camagru;charset=utf8', 'root', 'rootroot');
        } catch (Exception $e) {
            die('error :' . $e->getMessage());
        }
        
        ?>

<head>
    <meta charset="utf-8" />
    <link rel="stylesheet" href="index.css" />
    <title> camagru </title>
</head>


<body>
<?php
include 'header.php';

?>
    <div id="bloc_page">
        <form action="" method="GET">
            <p><label>password </label><input type="password" name="password" required /></P>
            <p><label>new password </label><input type="password" name="newpassword" required /></p>
            <p><label>new password verification </label><input type="password" name="newpasswordverif" required /></p>
            <p><label>pseudo </label><input type="text" name="pseudo" required /></P>
            <input type="submit" value="soumettre">
            <p><a href="changepseudo.php">changer de pseudo</a></p>
        </form>
    </div>
    <?php
    try {
        $bdd = new PDO('mysql:host=localhost;dbname=camagru;charset=utf8', 'root', 'rootroot');
    } catch (Exception $e) {
        die('error :' . $e->getMessage());
    }
    if (
        isset($_GET['password']) && isset($_GET['newpassword']) &&
        !empty($_GET['password']) && !empty($_GET['newpassword'])
    ) {
        $req = $bdd->prepare('UPDATE data_user SET `password`=? WHERE pseudo=?');
        $req->execute(array($_GET['newpassword'], 'pseudo'));
        echo '<p> felicitation vous avez modifier votre password </p>';
    } else
        echo '<p> verifier vos informations </p>';
    ?>
</body>

<footer>
    <div id="deconnecxon">
    <input type="submit" value="deconnecxion">
    </div>
</footer>

</html>