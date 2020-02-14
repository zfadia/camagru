<?php

 include_once "headerbdd.php";
 include_once "header.php";
                 
    


function getAllPhoto($bdd){
      $name_image = $bdd->prepare('SELECT *  FROM photo ORDER BY `date` ASC');
      $name_image->execute();
      $photo = [];
      while ($res = $name_image->fetch())
      {
        array_push($photo, $res['image_uniqid']);
      }
      return $photo;
  }
  function getAllmessage($bdd){
    $msg = $bdd->prepare('SELECT *  FROM comm ORDER BY date_comm ASC');
    $msg->execute();
    $array = [];
    while($res = $msg->fetch())
    {
      array_push($array, $res['comm']);
      }
      return $array;
    }


function printAllPhoto($bdd){
  $array = getAllPhoto($bdd);
  foreach($array as $pic){
    echo '<a href="vignette.php?img='.$pic.'"><img style="margin:5px" width="250" height="150" src="' .$pic . '" title="Cliquez pour agrandir"></a>';
  }
}
    
  function printAllPhotocomm ($bdd){
    $array = getAllPhoto($bdd);
    foreach($array as $pic){
      echo '<a href="vignette.php?img='.$pic.'"><img style="margin:5px" width="250" height="150" src="' .$pic . '" title="Cliquez pour agrandir"></a>';
    echo '<form action="" method="POST">
    <p><label> commentaire</label><input type="text" name="commentaire" required /></p>
    <input type="text" name="namePhoto" value="'.$pic.'" hidden/>
    <input type="submit" name="submit" value="soumettre">
    </form>'; 
    }
    }

      if (isset($_POST['commentaire'])){
                             

        $reqid = $bdd->prepare('SELECT id FROM photo WHERE image_uniqid=?');
        $reqid->execute(array($_POST["namePhoto"]));
        $reqid = $reqid->fetch();
        $idPhoto = htmlspecialchars($reqid['id']);
        print_r(var_dump($idPhoto));
        if (isset($_SESSION['id']) && !empty($_SESSION['id'])) {
          $req = $bdd->prepare('INSERT INTO comm(id_photo, `user_id`, comm, date_comm ) VALUES (?,?,?,NOW())');
                    $res = $req->execute(array($idPhoto, htmlspecialchars($_SESSION['id']),htmlspecialchars($_POST['commentaire'])));
                    $req->closeCursor(); 
         
          }
        }

     
        if (isset($_SESSION['id']) && !empty($_SESSION['id'])){
          printAllPhotocomm($bdd); 
         
        }
        else 
        {
          printAllPhoto($bdd);
        }
  
