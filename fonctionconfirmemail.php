<?php


function confirmation_kys($bdd)
    {
        if (isset($_GET['pseudo']) && isset($_GET['kys_email']) &&
        !empty($_GET['kys_email']) && !empty($_GET['pseudo']))
        $req = $bdd->prepare('UPDATE data_user SET confirmation = ? WHERE pseudo = ?');
        $req->execute(array(1, htmlspecialchars($_GET['pseudo'])));
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

?>