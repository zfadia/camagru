<?php 
include 'headerbdd.php';
?>    
<!DOCTYPE html>

<html>


<head>
    <meta charset="utf-8" />
    <link rel="stylesheet" href="index.css" />
</head>

<?php include 'header.php'; ?>

<body>
    <div id="bloc_page">
        <form action="" method="POST">
            <P>mots de passe :</P>
            <P>entre 8 et 16 caracteres</p>
            <P>au moins une majuscule, une minuscule, un nombre,</P> 
            <P>et un caractere spatiale </P>
            <p><label>new password </label><input type="password" name="newpassword" required /></p>
            <p><label>new password verification </label><input type="password" name="newpasswordverif" required /></p>
            <input type="submit" value="soumettre">
            <p><a href="changement_de_pseudo.php">changer de pseudo</a></p>
        </form>
    </div>
    <?php

if (isset ($_SESSION['id']) &&  !empty($_SESSION['id']))
{
    if ( isset($_POST['newpassword']) && !empty($_POST['newpassword']) &&  isset($_POST['newpasswordverif']) && !empty($_POST['newpasswordverif']))
    {
        if  (preg_match('/^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*[-+!*$@%_])([-+!*$@%_\w]{8,15})$/', $_POST['newpassword']))
         {
    if ($_POST['newpassword'] == $_POST ['newpasswordverif'] )
    {
        
        $mdp = password_hash(htmlspecialchars($_POST['newpassword']), PASSWORD_DEFAULT);
        $req = $bdd->prepare('UPDATE data_user SET `password`=? WHERE id=?');
        $req->execute(array($mdp, htmlspecialchars($_SESSION['id'])));
        echo '<p>Félicitations, vous avez modifié votre mot de passe !</p>';
    }
}
    else
    {
        echo '<p>Verifiez vos informations !</p>';
    }
    
}
     else
    {
        echo '<p>Verifiez vos informations !</p>';
    }
}
else
{
    
}
    ?>
</body>
</html>
	
