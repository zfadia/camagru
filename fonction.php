<?php
function verifinscription($bdd)
{
$faux = 0;
if (isset($_POST['pseudo']) && isset($_POST['password']) && isset($_POST['email']) &&
    !empty($_POST['pseudo']) && !empty($_POST['password']) && !empty($_POST['email']))
    {
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

?>
