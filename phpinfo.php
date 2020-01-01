<?php
error_reporting(E_ALL);
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

    </body>

</html>
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
        $mdp = password_hash($_POST['password'], PASSWORD_DEFAULT);
        $req = $bdd->prepare('INSERT INTO data_user(pseudo, `password`, email, creation_date) VALUES (?,?,?,NOW())');
        $req->execute(array($_POST['pseudo'], $mdp, $_POST['email']));
        $req->closeCursor();
        $token = $bdd->prepare(' INSERT INTO data_user(kys_email) VALUES (md5(uniqid(rand(), TRUE))');
        $to = $_POST['email'];
        $header="MIME-Version: 1.0\r\n";
        $header.='From:"Camagru"<zfadia@student.42.fr>'."\n";
        $header.='Content-Type:text/html; charset="utf-8"'."\n";
        $header.='Content-Transfer-Encoding: 8bit';
        $sujet  =  "Récupération de mot de passe " ;
        $pseudo = $_POST['pseudo'];
        $message = '
         <html>
         <head>
           <title>Récupération de mot de passe</title>
           <meta charset="utf-8" />
         </head>
         <body>
           <font color="#303030";>
             <div align="center">
               <table width="600px">
                 <tr>
                   <td>

                     <div align="center">Bonjour <b>$pseudo</b></div>
                     Voici votre code de récupération: <b></b>
                     A bientôt sur <a href="http://localhost:8080/camagru/confirmemail.php/">récupération_de_mot_depasse.com</a> !

                   </td>
                 </tr>
                 <tr>
                   <td align="center">
                     <font size="2">
                       Ceci est un email automatique, merci de ne pas y répondre
                     </font>
                   </td>
                 </tr>
               </table>
             </div>
           </font>
         </body>
         </html>
         ';
         mail($to, $sujet, $message, $header);
            //header("Location:http://127.0.0.1/path///127.0.0.1/path/
        echo '<p>consulte tes e-mail</p>';
    } 
    else
         echo '<p> verifier vos informations </p>';
}
?>