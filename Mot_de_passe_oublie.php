<?php

include 'headerbdd.php';
include 'header.php';

?>    
<!DOCTYPE html>

<html>
   
        
<head>
    <meta charset="utf-8" />
    <link rel="stylesheet" href="index.css" />
</head>


<body>

<?php
 if (isset($_GET['tokenmdpoublie']))
 {
     $req = $bdd->prepare('SELECT * FROM data_user WHERE tokenmdpoublie=? ');
     $req->execute(array($_GET['tokenmdpoublie']));
     $new = $req->fetch();

 if (isset($new['tokenmdpoublie']) && $_GET['tokenmdpoublie'] == $new['tokenmdpoublie'])
     {
         echo' <div id="bloc_page">
         <form action="" method="POST">
         <legend>reinitialiser votre mot de passe :</legend>
             <p><label>password : </label><input type="password" name="password" required /></p>
             <p><input type="submit" value="soumettre" name="submitchange"/></p>
             
         </form>
     </div>';
     if (isset($_POST["submitchange"]))
     {
        $req=$bdd->prepare('UPDATE data_user SET `password`=? WHERE tokenmdpoublie=? ');
        $req->execute(array(password_hash(htmlspecialchars($_POST['password']), PASSWORD_DEFAULT), htmlspecialchars($_GET['tokenmdpoublie'])));
        $req= $bdd->prepare('UPDATE data_user SET tokenmdpoublie=? WHERE tokenmdpoublie=?');
        $req->execute(array(NULL, htmlspecialchars($_GET['tokenmdpoublie'])));
        header("Location: connexion.php");
        exit(0);
     }
     }
 else
     echo'<p><a href="Mot_de_passe_oublie_email.php">Mot de passe oublié 2?</a></p>';

 }
 else
     echo'<p><a href="Mot_de_passe_oublie_email.php">Mot de passe oublié ?</a></p>';


    ?>
</body>

</html>

