<?php
session_start();  
try {
    $bdd = new PDO('mysql:host=localhost;dbname=camagru;charset=utf8', 'root', 'rootroot');
    } 
    catch (Exception $e) 
    {
        die('error :' . $e->getMessage());
    }  
?>   
<body>
    <div id="bloc_page">
        <form method="POST" action="" enctype="multipart/form-data">
       <label>picture: </label>
       <input type="file" name ="picture"/>
       <input type="submit" name="btn" value="mettre a jour mon profile">
    </div>
</body>
<?php
if (isset($_POST['btn']))
        {
        $tailleMax = 2097152;
        $extentionValides = array('jpg', 'jpeg', 'gif', 'png');
         if ($_FILES['picture']['size']<= $tailleMax) 
         $extensionupload = strtolower(substr(strrchr($_FILES['picture']['name'], '.'),1));
         if (in_array($extensionupload, $extentionValides)) {

            $chemin = "/Users/zfadia/Desktop/Mamp/apache2/htdocs/Camagru/picture/";
             $uploadfile = $chemin . basename($_FILES['picture']['name']);
             $resultat = move_uploaded_file($_FILES['picture']['tmp_name'], $uploadfile);
            $pseudo =  $_SESSION['pseudo'];
            echo $uploadfile;
             if ($resultat) {
                  $req = $bdd->prepare('UPDATE  data_user SET picture=? WHERE pseudo=?');
                  $req->execute(array($uploadfile, $pseudo));
                  $req->closeCursor();                                                  
                           
             } else {
                 $erreur = "erreur lors de l'importation de votre photo de profil";
             }
 
         } else {
             $erreur = " extension de votre photo de profil invalide";
         }
 
     } else {
         $erreur = " Votre photo de profil ne doit pas dépasser 2 mo ";
     }

                if(!empty($data->picture)){
                    echo "empty";
                    echo "<img class='profile-image img-circle pull-left' src='picture/".$data->picture."' width='150' />";

                } else {

                   echo '<img  class="profile-image  img-circle  pull-left" src="/Users/zfadia/Desktop/Mamp/apache2/htdocs/Camagru/picture/Fadia-4-300x300.jpg" width="150" />';//si pas d'picture, ont en affiche un manuellement.
                }
                ?>