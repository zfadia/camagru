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
</head>


<body>
<?php
include 'header.php';

?>
    <div id="bloc_page">
        <form action="" method="POST">
            <p><label>pseudo </label><input type="text" name="pseudo" required /></P>
            <p><label>new password </label><input type="password" name="newpassword" required /></p>
            <p><label>new password verification </label><input type="password" name="newpasswordverif" required /></p>
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
        isset($_POST['password']) && isset($_POST['newpassword']) &&
        !empty($_POST['password']) && !empty($_POST['newpassword'])
    ) {
        $req = $bdd->prepare('UPDATE data_user SET `password`=? WHERE pseudo=?');
        $req->execute(array($_POST['newpassword'], 'pseudo'));
        echo '<p> felicitation vous avez modifier votre password </p>';
    } else
        echo '<p> verifier vos informations </p>';
    ?>
</body>



</html>