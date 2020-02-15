<?php
include_once "fonctionconfirmemail.php";
include_once "headerbdd.php";
if (!isset($_SESSION['id'])) {
    header("location:index.php");
    exit(0);
  }
?>


<!DOCTYPE html>
<html>
<head>
<?php include_once "header.php";?>
</head>

<body>
<?php
   
if (isset($_GET['pseudo'], $_GET['kys_email']))
{
    echo("ERREUR");
}
else{
        $pseudoget = urldecode($_GET['pseudo']);
        $keyget = urldecode($_GET['token']);
        print_r($pseudoget, $keyget);
}

    if (isset($_GET['pseudo'], $_GET['kys_email'])) 
    {
        $req = $bdd->prepare('SELECT pseudo , kys_email FROM data_user WHERE pseudo=?');
        $req->execute(array($_GET['pseudo']));
        $new = $req->fetch();
        if (kys_email_verify($bdd))
        {
            echo "email confirmer\n";
            header('Location:user_page.php');
        }
        
     } else
     echo "le code ou le pseudo ne correspond pas\n";
    ?>

</body>

</html>
