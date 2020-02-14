<?php
include 'headerbdd.php';
include 'header.php';
?>

<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8" />

</head>
<header>

</header>

<body>
  <div id="bloc_page">
    <form action="" method="GET">
      <p><label>email :</label><input type="email" name="email" required /></p>
      <input type="submit" value="soumettre">
    </form>
  </div>

</body>

</html>
<?php
include_once "fonctioninscription.php";
include 'fonctionmdpoublieemail.php';
if (verifemail($bdd))
{
if (
  isset($_GET['email']) &&
  !empty($_GET['email'])
) {
  $tokenmdpoublie = random_2();
  $req = $bdd->prepare(' UPDATE data_user SET tokenmdpoublie=? WHERE email=?');
  $res = $req->execute(array($tokenmdpoublie, htmlspecialchars($_GET['email'])));
  $to = $_GET['email'];
  $header = "MIME-Version: 1.0\r\n";
  $header .= 'From:"Camagru"<zfadia@student.42.fr>' . "\n";
  $header .= 'Content-Type:text/html; charset="utf-8"' . "\n";
  $header .= 'Content-Transfer-Encoding: 8bit';
  $sujet  = "Récupération de mot de passe ";
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
                    clic ici pour réinitialiser ton mot de passe <a href="http://localhost:8080/camagru/Mot_de_passe_oublie.php?tokenmdpoublie=' . $tokenmdpoublie . '"> récupération_de_mot_depasse.com</a> !
                                                                                            
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
  // header("Location: ");
  echo '<p>consulte tes e-mail</p>';
} else
  echo '<p> verifier vos informations </p>';
}
?>