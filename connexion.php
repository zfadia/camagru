<?php
include_once "headerbdd.php";
include_once "header.php";
if (isset($_SESSION ['id']))
{
    header('Location:user_page.php'); 
}


?>
<!DOCTYPE html>
<html>


<body>
    <div id="bloc_page">
        <form action="" method="POST">
            <p><label>pseudo : </label><input type="text" name="pseudo" required /></p>
            <p><label>password : </label><input type="password" name="password" required /></p>
            <p><input type="submit" value="soumettre" /></p>
            <p><a href="Mot_de_passe_oublie_email.php">Mot de passe oublié ?</a></p>
        </form>
    </div>

    <?php
    if (isset($_POST['pseudo'], $_POST['password'])) {
        $req = $bdd->prepare('SELECT pseudo ,id, `password`,email FROM data_user WHERE pseudo=? ');
        $req->execute(array($_POST['pseudo']));
        $new = $req->fetch();
        $hash = NULL;
        if ($req->rowCount())
            $hash = $new['password'];
        if (password_verify($_POST['password'], $hash))
        {
            echo 'password_verify';
            header('Location:user_page.php');
        $_SESSION['id'] = $new ['id'];
        $_SESSION['pseudo'] = $new ['pseudo'];
        $_SESSION['email'] = $new['email'];
        }   
        else
            echo 'infornation incorecte';
    }

    ?>

</body>
</html>
