<?php

include_once "headerbdd.php";
$photoParPage = 10;
$photoTotalesReq = $bdd->query('SELECT image_uniqid FROM photo');
$photoTotales = $photoTotalesReq->rowCount();
$pagesTotales = ceil($photoTotales/$photoParPage);
if(isset($_GET['page']) AND !empty($_GET['page']) AND $_GET['page'] > 0 AND $_GET['page'] <= $pagesTotales) {
   $_GET['page'] = intval($_GET['page']);
   $pageCourante = $_GET['page'];
} else {
   $pageCourante = 1;
}
$depart = ($pageCourante-1)*$photoParPage;
?>

<html>
   <head>
      <title>TUTO PHP</title>
      <meta charset="utf-8">
   </head>
   <body>
      <?php
      $photo = $bdd->query('SELECT * FROM photo  ORDER BY id DESC LIMIT '.$depart.','.$photoParPage);
      while($img = $photo->fetch()) {
        //echo '<img style="margin:5px" src="' . $img['image_uniqid'] . '" />';
        echo '<a href="vignette.php?img='.$img['image_uniqid'].'"><img style="margin:5px" width="286" height="248" src="' . $img['image_uniqid'] . '" /></a>';

        echo '<div class="card" style="width: 18rem">';
        echo '<div class="card-body">';
      //  echo '<a href="vignette.php?img="' . $img['image_uniqid'] . '"><img style="margin:5px" width="250" height="150" src="' . $img['image_uniqid'] . '"></a>';
        if (isset($_SESSION['id'])) {
          $like = getLike($bdd, $img['image_uniqid']);
          echo '<form action="" method="POST">
                <p><label> commentaire</label><input type="text" name="commentaire" required /></p>
                <input type="text" name="namePhoto" value="' . $img['image_uniqid'] . '" hidden/>
                <input type="submit" name="submitcommentaire" value="soumettre">
                </form>';
          echo '<form action="" method="POST">
                <input type="hidden" name="namePhoto" value="' . $img['image_uniqid'] . '"/>
                <p>' . $like . 'Like</p>
                <input type="submit" name="submitlike" value="like">
                </form>';
          echo '</div>';
          echo '</div>';
        }
      ?>


    
      <b>N°<?php echo $img['id']; ?> - </b><br />
      <i><?php echo $img['date']; ?></i>
      <br /><br />
      <?php
      }
      ?>
      <?php
      for($i=1;$i<=$pagesTotales;$i++) {
         if($i == $pageCourante) {
            echo $i.' ';
         } else {
            echo '<a href="index.php?page='.$i.'">'.$i.'</a> ';
         }}
      ?>
   </body>
</html>
