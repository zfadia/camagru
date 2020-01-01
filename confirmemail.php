<?php
session_start();    
?>   
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="index.css" />
    <title>confiremail</title>
</head>
<header>
    <div id="titre_principal">
        <h1> camagru </h1>
    </div>

    <nav>
        <ul>
            <li><a href="inscription.php">inscription</a></li>
        </ul>
    </nav>
</header>

<body>
<?php
try {
        $bdd = new PDO('mysql:host=localhost;dbname=camagru;charset=utf8', 'root', 'rootroot');
    } catch (Exception $e) {
        die('error :' . $e->getMessage());
   
    if (isset($_GET['pseudo'], $_GET['kys_email']))
{
    echo("ERREUR");
}
else{

        $pseudoget = urldecode($_GET['pseudo']);
        $keyget = urldecode($_GET['token']);
}
  
    }

    include 'fonction.php';
    if (isset($_GET['pseudo'], $_GET['kys_email'])) {
        $req = $bdd->prepare('SELECT pseudo , kys_email FROM data_user WHERE pseudo=?');
        $req->execute(array($_GET['pseudo']));
        $new = $req->fetch();

        if (kys_email_verify($bdd))
        {
            echo "email confirmer\n";
            header('Location:user_page1.php');
            echo "fadia email confirmer\n";
        }
        
     } else
     echo "le code ou le pseudo ne correspond pas\n";
    ?>

</body>

</html>