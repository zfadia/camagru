<?php
function verifpseudo($bdd)
{
    $faux = 0;
    if (
        isset($_POST['newpseudo']) && !empty($_POST['newpseudo'] && $_SESSION['pseudo'] == $_POST['newpseudo'])
    )
        $faux = 1;
    if (
        isset($_POST['submitpseudo']) && isset($_POST['newpseudo']) &&
        !empty($_POST['newpseudo'])
    ) {
        $reqverif = $bdd->prepare('SELECT pseudo from data_user WHERE pseudo=?');
        $reqverif->execute(array($_POST['newpseudo']));
        if ($reqverif->rowCount() > 0)
            $faux = 1;
        $reqverif->closeCursor();
    }
    return ($faux);
}
