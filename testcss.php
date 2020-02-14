
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="#">Camagru</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="user_page.php">cam <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="index.php">accueil</a>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link " href="changement_de_mdp.php" > changement de mdp
        </a>
        </li>
        <li class="nav-item dropdown">
        <a class="nav-link " href="changement_de_mdp.php" >
        changement de mdp
        </a>
        </li>
        <li class="nav-item dropdown">
        <a class="nav-link" href="deconnexion.php">deconnexion
        </a>
        </li>
        
  </div>
</nav>





function printAllPhoto($bdd)
{
  $array_photos = getAllPhoto($bdd);
  $limit=3;
  $i = 0;
  foreach ( $array_photos as $photo) {
   if ($i<$limit)
   {
    echo '<a href="vignette.php?img=' . $photo . '"><img style="margin:5px" width="250" height="150" src="' . $photo . '"></a>';
      $i++;

    if (isset($_SESSION['id'])) {
      $like = getLike($bdd, $photo);

      echo '<form action="" method="POST">
            <p><label> commentaire</label><input type="text" name="commentaire" required /></p>
            <input type="text" name="namePhoto" value="' . $photo . '" hidden/>
            <input type="submit" name="submitcommentaire" value="soumettre">
            </form>';
      echo '<form action="" method="POST">
            <input type="hidden" name="namePhoto" value="' . $photo . '"/>
            <p>' . $like . 'Like</p>
            <input type="submit" name="submitlike" value="like">
            </form>';
      
     }
    }
  }
echo  '<input type="submit" name="submitnext" value="next">';


}

function nextphoto($bdd, $photo)
{
  $idPhoto = recupidImage($photo, $bdd);
  $array_photos = getAllPhoto($bdd);
  $req = $bdd->prepare('SELECT * FROM photo WHERE image_uniqid=?');
  $req->execute(array())
;
  foreach ( $array_photos as $photo) {
  
  echo '<a href="vignette.php?img=' . $photo . '"><img style="margin:5px" width="250" height="150" src="' . $photo . '"></a>';
      
}
