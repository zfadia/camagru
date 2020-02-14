<?php
function verifinscription($bdd)
{
    $faux = 0;
    if (
        isset($_POST['pseudo']) && isset($_POST['password']) && isset($_POST['email']) &&
        !empty($_POST['pseudo']) && !empty($_POST['password']) && !empty($_POST['email'])
    ) {
        $reqverif = $bdd->prepare('SELECT pseudo, email from data_user WHERE pseudo=? OR email=?');
        $reqverif->execute(array($_POST['pseudo'], $_POST['email']));
        while ($data = $reqverif->fetch()) {

            if ($data['pseudo'] == $_POST['pseudo']) {
                $faux = 1;
                echo "ce pseudo est deja pris \n";
            }
            if ($data['email'] == $_POST['email']) {
                $faux = 1;
                echo "l'email est deja pris ";
            }
        }
        if (!preg_match('/^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*[-+!*$@%_])([-+!*$@%_\w]{8,15})$/', $_POST['password'])) 
        {
            $faux = 1;
            echo 'Mot de passe non conforme';
        }
    }
    return ($faux);
}

function random_2($universal_key = 5)
{
    $string = "";

    $user_ramdom_key =
        "0123456789qwertyuiopasdfghjklzxcvbnmQWERTYUIOPASDFGHJKLZXCVBNM";
    srand((float) microtime() * time());
    for ($i = 0; $i < $universal_key; $i++) {
        $string .= $user_ramdom_key[rand() % strlen($user_ramdom_key)];
    }
    return $string;
}
