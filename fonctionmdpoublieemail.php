<?php
function verifemailcodeperdu($bdd)
{
    $faux = 0;
    if (
        isset($_GET['email']) &&
        !empty($_GET['email'])
    ) {

        $reqverif = $bdd->prepare('SELECT email, pseudo from data_user WHERE email=?');
        $reqverif->execute(array($_GET['email']));
        while ($data = $reqverif->fetch()) {
            if ($data['email'] == $_GET['email'] && $data['pseudo'] == $_GET['pseudo']) {
                $faux = 1;
            }
        }
    } else {
        $faux = 0;
    }
    return ($faux);
}

function verifemail($bdd)
{
    $faux = 0;
    if (
        isset($_GET['email']) &&
        !empty($_GET['email'])
    ) {

        $reqverif = $bdd->prepare('SELECT email from data_user WHERE email=?');
        $reqverif->execute(array($_GET['email']));
        while ($data = $reqverif->fetch()) {
            if ($data['email'] == $_GET['email']) {
                $faux = 1;
            }
        }
    }
    return ($faux);
}
