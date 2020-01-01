<?php
session_start();    
?>    
<!DOCTYPE html>

<html>
    <?php
        try {
            $bdd = new PDO('mysql:host=localhost;dbname=camagru;charset=utf8', 'root', 'rootroot');
        } catch (Exception $e) {
            die('error :' . $e->getMessage());
        }
        
        ?>
        

<head>
    <meta charset="utf-8" />
    <link rel="stylesheet" href="index.css" />
</head>


<body>
<?php
include 'header.php';

?>
    <div id="bloc_page">
        <form action="" method="GET">
            <p><label>pseudo</label><input type="text" name="pseudo" required /></P>
            <p><label>new password </label><input type="password" name="newpassword" required /></p>
            <p><label>new password verification </label><input type="password" name="newpasswordverif" required /></p>
            <input type="submit" value="soumettre">
        </form>
    </div>
    <?php
    try {
        $bdd = new PDO('mysql:host=localhost;dbname=camagru;charset=utf8', 'root', 'rootroot');
    } catch (Exception $e) {
        die('error :' . $e->getMessage());
    }
    if (isset($_GET['pseudo']) && 
        isset($_GET['newpasswordverif']) && isset($_GET['newpassword']) &&
        !empty($_GET['pseudo'])&&!empty($_GET['newpasswordverif']) && !empty($_GET['newpassword'])
    ) {
       
    if ($_GET['newpassword'] == $_GET['newpasswordverif'])
    $mdp = password_hash($_GET['newpassword'], PASSWORD_DEFAULT);
        $req = $bdd->prepare('UPDATE data_user SET `password`=? WHERE pseudo=?');
        $req->execute(array($mdp, $_GET['pseudo']));
        echo '<p> felicitation vous avez modifier votre password </p>';
    } else
        echo '<p> verifier vos informations </p>';
    ?>
</body>



</html>