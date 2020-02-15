<header>
<link href="https://fonts.googleapis.com/css?family=Molle:400i&display=swap" rel="stylesheet">
    <div id="titre_principal">
        <meta charset="utf-8">
        <link rel="stylesheet" href="index.css" />
        <title> camagru </title>
    </div>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
<nav class="navbar navbar-expand-lg navbar-light bg-primary mb-3">
  <a class="navbar-brand text-light" style="font-family: 'Molle', cursive;" href="#">Camagru</a>
 
   
  </button>
    <?php
    if (isset($_SESSION['id'])) {
        $text = '
        <ul class="navbar-nav mr-auto">
        <li class="nav-item "><a class="nav-link text-light" href="user_page.php">cam <span class="sr-only">(current)</span></a></li>
        <li class="nav-item" ><a class="nav-link text-light" href="index.php">accueil</a></li>
        <li class="nav-item "><a class="nav-link text-light " href="changement_de_mdp.php" > changement de mdp</a></li>
        <li class="nav-item "> <a class="nav-link  text-light" href="changement_de_pseudo.php" >changement de pseudo</a></li>
        <li class="nav-item"><a class="nav-link text-light" href="deconnexion.php">deconnexion</a></li>
       </ul>';
        echo $text;
        echo "<p> bonjour"."  " .$_SESSION['pseudo'];
    } 
    else 
    {
        $text2 = '
        <ul class="navbar-nav mr-auto">
    <li class="nav-item"><a class="nav-link" href="index.php">accueil</a></li>
    <li class="nav-item"><a class="nav-link" href="connexion.php">connexion</a></li>
    <li class="nav-item "><a class="nav-link" href="inscription.php">inscription</a></li>
    </ul>';
        echo $text2;
    } 
    ?>
</header>