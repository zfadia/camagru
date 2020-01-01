<?php

function verifinscription($bdd)
{
$faux = 0;
if (isset($_POST['pseudo']) && isset($_POST['password']) && isset($_POST['email']) &&
    !empty($_POST['pseudo']) && !empty($_POST['password']) && !empty($_POST['email']))
    {
    $reqverif = $bdd->prepare('SELECT pseudo, email from data_user WHERE pseudo=? OR email=?');
    $reqverif->execute(array($_POST['pseudo'], $_POST['email']));
    while ($data = $reqverif->fetch()) 
    {
        if ($data['pseudo'] == $_POST['pseudo']) 
        {
            $faux = 1;
            echo "ce pseudo est deja pris \n";
        }
        if ($data['email'] == $_POST['email']) 
        {
            $faux = 1;
            echo "l'email est deja pris ";
        }
    }
    }
else 
{
    echo "remplire les champs";
}
return($faux);
}

function verifpseudo($bdd)
{
    $faux = 0;
    if (isset($_POST['pseudo']) &&
        !empty($_POST['pseudo']))
        {
        $reqverif = $bdd->prepare('SELECT pseudo from data_user WHERE pseudo=?');
        $reqverif->execute(array($_POST['newpseudo']));
        while ($data = $reqverif->fetch()) {
            if ($data['pseudo'] == $_POST['newpseudo'] ) {
                $faux = 1;
                echo "modification accepter\n";
            }
        }
    }
    else 
    {
        echo "remplire les champs avec des info differente";
    }
    return($faux);
    }

    function random_2($universal_key = 5) {

        $string = "";
    
        $user_ramdom_key = 
    "0123456789qwertyuiopasdfghjklzxcvbnmQWERTTYUIOPASDFGHJKLZXCVBNM";
        srand((double)microtime()*time());
        for($i=0; $i<$universal_key; $i++) {
        $string .= $user_ramdom_key[rand()%strlen($user_ramdom_key)];
        }
        return $string;
        }  
    
    function confirmation_kys($bdd)
    {
        if (isset($_GET['pseudo']) && isset($_GET['kys_email']) &&
        !empty($_GET['kys_email']) && !empty($_GET['pseudo']))
        $req = $bdd->prepare('UPDATE data_user SET confirmation = ? WHERE pseudo = ?');
        $req->execute(array(1, $_GET['pseudo']));
        $req->closeCursor();
    }

    function kys_email_verify($bdd)
    {
            $verify = 0;
        if (isset($_GET['pseudo']) && isset($_GET['kys_email']) &&
            !empty($_GET['kys_email']) && !empty($_GET['pseudo']))
        {
        $reqverify = $bdd->prepare('SELECT pseudo, kys_email from data_user WHERE pseudo=? ');
        $reqverify->execute(array($_GET['pseudo']));
        while ($data = $reqverify->fetch()) 
        {
            if (($data['pseudo'] == $_GET['pseudo']) &&  ($data['kys_email'] == $_GET['kys_email']))
            {

                confirmation_kys($bdd);
                return 1;
            }
        }
        }
        return(0);
    }

    function verifemailcodeperdu($bdd)
    {
    $faux = 0;
    if (isset($_GET['email']) &&
        !empty($_GET['email']))
        {
        
        $reqverif = $bdd->prepare('SELECT email from data_user WHERE email=?');
        $reqverif->execute(array($_GET['email']));
        while ($data = $reqverif->fetch()) 
        {
            if ($data['email'] == $_GET['email']) {
                $faux = 1;
                echo "un email vous a été envoyé ";
                
            }
        }
    }
    else 
    {
        echo "remplire le champs";
    }
    return($faux);
    }

    
?>