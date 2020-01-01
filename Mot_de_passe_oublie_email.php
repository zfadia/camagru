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
    </div>

    <nav>
        <ul>
            <li><a href="connexion.php">connexion</a></li>
        </ul>
    </nav>
</header>

<body>
    <div id="bloc_page">
        <form action="" method="GET">
            <p><label>pseudo </label><input type="text" name="pseudo" required /></P>
            <p><label>email </label><input type="email" name="email" required /></p>
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
if (verifemailcodeperdu($bdd) == 1)
{
    if (isset($_GET['email']) && isset($_POST['pseudo']) &&
        !empty($_GET['email'] && !empty($_POST['pseudo']))
    ) {   
        $pseudo = $_GET['pseudo'];                                                        
        $to = $_GET['email'];
        $header="MIME-Version: 1.0\r\n";
        $header.='From:"Camagru"<zfadia@student.42.fr>'."\n";
        $header.='Content-Type:text/html; charset="utf-8"'."\n";
        $header.='Content-Transfer-Encoding: 8bit';
        $sujet  ="Récupération de mot de passe " ;
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
                    clic ici pour réinitialiser ton mot de passe <a href="http://localhost:8080/camagru/Mot_de_passe_oublie.php?pseudo=$pseudo">récupération_de_mot_depasse.com</a> !

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
            header("Location: ");
        echo '<p>consulte tes e-mail</p>';
    } 
    else
         echo '<p> verifier vos informations </p>';
}
?>