<?php
include_once "headerbdd.php";
if (isset($_SESSION['id'])) {
    header('Location:user_page.php');
}
?>

<!DOCTYPE html>
<html>

<head>
    <?php include_once "header.php"; ?>
</head>

<body>
    <div id="bloc_page">
        <form action="" method="POST">
            <p><label>pseudo </label><input type="text" name="pseudo" required /></P>
            <p><label>email </label><input type="email" name="email" required /></p>
            <p><label>password </label><input type="password" name="password" required /></p>
            <P>mots de passe :</P>
            <P>entre 8 et 16 caracteres</p>
            <P>au moins une majuscule, une minuscule, un nombre,</P> 
            <P>et un caractere spatiale </P>
            <input type="submit" value="soumettre" name="submitinscription">
        </form>
    </div>

</body>

</html>

<?php
include_once "fonctioninscription.php";

if (verifinscription($bdd) == 0) {
    if (
        isset($_POST['pseudo']) && isset($_POST['password']) && isset($_POST['email']) &&
        !empty($_POST['pseudo']) && !empty($_POST['password']) && !empty($_POST['email'])
    ) {
        $token = random_2();
        $mdp = password_hash(htmlspecialchars($_POST['password']), PASSWORD_DEFAULT);
        $req = $bdd->prepare('INSERT INTO data_user(pseudo, `password`, email, creation_date, kys_email) VALUES (?,?,?,NOW(),?)');
        $res = $req->execute(array(htmlspecialchars($_POST['pseudo']), $mdp, htmlspecialchars($_POST['email']), $token));
        base64_encode($token);
        $req->closeCursor();
        $pseudo = $_POST['pseudo'];
        $to = $_POST['email'];
        $sujet = "Activez votre compte";
        $header = "MIME-Version: 1.0\r\n";
        $header .= "Content-Type: text/html; charset='utf-8'\r\n";
        $header .= "From: camagru@42.fr\r\n";
        $message = '<html>
                     <head>
                     <title>Bienvenue sur camagru,</title>
                     <meta charset="utf-8" />
                     </head>
                     <body>
                     <font color="#303030";>
                         <div align="center">
                         <table width="600px">
                             <tr>
                             <td>
                             <div align="center"><p> Bonjour <b>' . $pseudo . '</p></b></div>
                            <div align="center"> <p> Voici votre code de récupération:' . $token . ' <p></b></div>
                             A bientôt sur <a href="http://localhost:8080/camagru/confirmemail.php?pseudo=' . urlencode($pseudo) . '&kys_email=' . urlencode($token) . '">camagru </a> !
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
                     </html>';
        mail($to, $sujet, $message, $header);
        //header("Location:http://127.0.0.1/path///127.0.0.1/path/ 
        echo '<p>consulte tes e-mails</p>';
    } else if (isset($_POST['submitinscription']))
        echo '<p> remplir les champs ou verifiez vos informations </p>';
}
?>