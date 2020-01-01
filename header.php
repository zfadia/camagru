<header>
    <div id="titre_principal">
        <h1> camagru </h1>

    </div>
    <?php
    include "fonction.php";
    if (isset($_SESSION['pseudo'])) {
        echo "<p> bonjour"."  " .$_SESSION['pseudo'];
        $text = "<nav>
    <ul>
        <li><a href='deconnexion.php'>deconnexion</a></li>
        <li><a href='changemdp.php'>changemdp</a></li>
        <li><a href='changepseudo.php'>changepseudo</a></li>
    </ul>
</nav>";
        echo $text;
    } else {
        $text2 = "<nav>
    <ul>
        <li><a href='parametre.php'>parametre</a></li>
        <li><a href='connexion.php'>connexion</a></li>
        <li><a href='inscription.php'>inscription</a></li>
    </ul>
</nav>";
        echo $text2;
    }
    
    ?>
</header>