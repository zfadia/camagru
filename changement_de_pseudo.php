 <!DOCTYPE html>
 <?php include 'headerbdd.php'; ?>
 <html>

 <head>
 </head>
 <header>

 </header>

 <body>
     <?php
        include 'header.php';
        ?>
     <div id="bloc_page">
         <form action="" method="POST">
             <p><label>newpseudo </label><input type="text" name="newpseudo" required /></p>
             <input type="submit" name="submitpseudo" value="soumettre">
             <p><a href="changement_de_mdp.php">changer de mot de passe</a></p>
         </form>
         <form action="" method="POST">
             <P>Voulez-vous recevoir les emails ?</P>
             <input type="submit" name="submitmailoui" value="oui">
             <input type="submit" name="submitmailnon" value="non">
         </form>
     </div>

     <?php
        include 'fonction_changement_de_pseudo.php';
        if (verifpseudo($bdd) == 0) {
            if (
                isset($_POST['newpseudo']) &&
                !empty($_POST['newpseudo'])
            ) {
                $pseudo = htmlspecialchars($_POST['newpseudo']);
                $req = $bdd->prepare('UPDATE data_user SET pseudo=?  WHERE pseudo=?');
                $req->execute(array($pseudo, htmlspecialchars($_SESSION['pseudo'])));
                $_SESSION['pseudo'] = $pseudo;
                echo '<p> felicitations vous avez modifie votre pseudo</p>';
            } else {
                echo "remplire les champs avec des info differente";
            }
        }


        if (isset($_POST['submitmailoui']))
        {
            $req = $bdd->prepare('UPDATE  data_user SET sendemail=? WHERE id = ?');
            $req->execute(array(1, htmlspecialchars($_SESSION['id'])));
            $req->closeCursor();
        }

        if (isset($_POST['submitmailnon'])) 
        {
            $req = $bdd->prepare('UPDATE  data_user SET sendemail=? WHERE id = ?');
            $req->execute(array(0, htmlspecialchars($_SESSION['id'])));
            $req->closeCursor();
        }
        ?>
 </body>

 </html>