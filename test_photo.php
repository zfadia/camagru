<html>
    <head>
        <meta charset="utf-8">
    </head>
    <body>
    <h1>New York</h1>
    <?php
    if (!is_dir('vignettes'))
        mkdir('vignettes', 0777);
      
    $fichier = opendir('./image');
      
    while ($fichier_courant = readdir($fichier)) {
       
        $extension = strtolower(strrchr($fichier_courant, './image'));
        if ($extension == '.jpg' || $extension == '.jpeg') {
            $nom_vignette = 'image/' . $fichier_courant;
           
            $taille = getimagesize($nom_vignette);
            $largeur = $taille[0];
            $hauteur = $taille[1];
            
            if (!file_exists($nom_vignette)) {
                $im = imagecreatefromjpeg($fichier_courant);
                $largeur_vignette = 150;
                $hauteur_vignette = $hauteur / $largeur * 150;
                $im_vignette = imagecreatetruecolor($largeur_vignette, $hauteur_vignette);
                imagecopyresampled($im_vignette, $im, 0, 0, 0, 0, $largeur_vignette, $hauteur_vignette, $largeur, $hauteur);
                imagejpeg($im_vignette, $nom_vignette, 60);
            }    
            else {
                echo 'Nom de l\'image : '.$fichier_courant.'<br>
                Largeur : ' . $largeur.'<br>
                Hauteur : ' . $hauteur.'<br>
                <a href="' . $fichier_courant .''.$_SESSION['id_']. '"><img src="' . $nom_vignette . '" title="Cliquez pour agrandir"></a>
                <hr>';
            }
        }
    }
    ?>
    </body>
</html>