  <?php
  include_once "headerbdd.php";
  include_once "header.php";
  if (session_status() == PHP_SESSION_NONE) {
    session_start();
  }

  if (!isset($_SESSION['id'])) {
    header("location:index.php");
    exit(0);
  }
  ?>

  <!DOCTYPE html>
  <html>

  <head>
    <meta charset="utf-8" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <title>Camagru : time to shine !!</title>
  </head>

  <body>
<!--     
    ///photo
    ///photo
    ///photo
    -->
    <div class="container">
    <div class="row jsutify-content-between">
      <div class="col-md-6">
    <div class="container">
      <video id="video" playsinline autoplay></video>
  
    <form method="post" action="" onsubmit="prepareImg();" enctype="multipart/form-data">
      <input type="radio" id="cadre1" name="drone" value="cadre1" onclick="enableButton();">
      <label for="cadre1">cadre1</label>
      <input type="radio" id="cadre2" name="drone" value="cadre2" onclick="enableButton();">
      <label for="cadre2">cadre2</label>
      <input id="inp_img" name="img" type="hidden" value="">
      <input id="bt_upload" type="submit" name="submitimg" value="Upload" disabled>
    </form>

    <form method="POST" action="" enctype="multipart/form-data">
      <input type="radio" id="cadre1" name="drone" value="cadre1" onclick="enableButtonn();">
      <label for="cadre1">cadre1</label>
      <input type="radio" id="cadre2" name="drone" value="cadre2" onclick="enableButtonn();">
      <label for="cadre2">cadre2</label>
      <input id="inp_img" name="img" type="hidden" value="">
      <label>picture: </label>
      <input type="file" name="picture" required />
      <input id="bt_upload1" type="submit" name="submitphoto" value="Upload" disabled>
    </form>

    <script>
      function enableButton() {
        var selectelem = document.getElementById('cadre1');
        var btnelem = document.getElementById('bt_upload');
        btnelem.disabled = false;
      }

      function enableButtonn() {
        var btnelemm = document.getElementById('bt_upload1');
        btnelemm.disabled = false;
      }
 
    </script>
    
    <canvas id="canvas" width="600" height="400"></canvas>
    <script>
      'use strict';
      const video = document.getElementById('video');
      const canvas = document.getElementById('canvas');
      const snap = document.getElementById('snap');
      const errorMsgElement = document.getElementById('span#ErrorMsg');
      const constraints = {
        audio: false,
        video: {
          width: 600,
          height: 400
        }
      };
      async function init() {
        try {
          const stream = await navigator.mediaDevices.getUserMedia(constraints);
          handleSuccess(stream);
        } catch (e) {
          errorMsgElement.innerHTML = `navigator.getUserMedia.error:${e.toString()}`;
        }
      }

      function handleSuccess(stream) {
        window.stream = stream;
        video.srcObject = stream;
      }
      init();
      var context = canvas.getContext('2d');
      canvas.style.display = "none";

      function prepareImg() {
        context.drawImage(video, 0, 0, 640, 480);
        //video.style = "display:none";
        document.getElementById('inp_img').value = canvas.toDataURL();
      }
   
    </script>


    <?php
  
    if (isset($_POST['submitphoto']) && count($_POST) && isset($_FILES['picture']) && !empty($_FILES['picture']['name'])) {

      $tailleMax = 2097152;
      $extentionValides = array('png');
      if ($_FILES['picture']['size'] <= $tailleMax)
        $extensionupload = strtolower(substr(strrchr($_FILES['picture']['name'], '.'), 1));
      if (in_array($extensionupload, $extentionValides)) {
        $file = "uploads/camagru/";
        if (!file_exists($file)) {
          mkdir($file, 0777, true);
        }
        $file = $file . uniqid() . '.png';
  
        $resultat = move_uploaded_file($_FILES['picture']['tmp_name'], $file);
        $id =  $_SESSION['id'];
        echo $file . " enregistre fichier !";
      } else {
        $file = "";
      }
    } else if (isset($_POST['submitimg']) && count($_POST) && (strpos($_POST['img'], 'data:image/png;base64') === 0)) {
      $img = $_POST['img'];
      $img = str_replace('data:image/png;base64,', '', $img);
      $img = str_replace(' ', '+', $img);
      $data = base64_decode($img);
      $file_path = 'uploads/camagru/';
      if (!file_exists($file_path)) {
        mkdir($file_path, 0777, true);
      }
      $file = $file_path . uniqid() . '.png';
      if (file_put_contents($file, $data)) {
       
      } else {
        echo "<p>The canvas could not be saved.</p>";
      }
    }



    ///cadre
    ///cadre
    ///  cadre                 



    if ((isset($_POST['submitimg']) && (strpos($_POST['img'], 'data:image/png;base64') === 0)) || (isset($_POST['submitphoto']) && count($_POST) && isset($_FILES['picture']) && !empty($_FILES['picture']['name']))) {
      if (isset($_POST['drone']) && $_POST['drone'] == "cadre1")
        $source = imagecreatefrompng("uploads/cadre/cadre2.png");
      else if (isset($_POST['drone']) && $_POST['drone'] == "cadre2")
        $source = imagecreatefrompng("uploads/cadre/cadre3.png");
      $largeur_source = imagesx($source);
      $hauteur_source = imagesy($source);
      imagealphablending($source, true);
      imagesavealpha($source, true);
      if ($file != ""){
      $destination = imagecreatefrompng($file);
      $largeur_destination = imagesx($destination);
      $hauteur_destination = imagesy($destination);
      $destination_x = 0;
      $destination_y =  0;
      imagecopy($destination, $source, $destination_x, $destination_y, 0, 0, $largeur_source, $hauteur_source);
      $tmp = $file;
      $file = str_replace('/camagru/', '/modified/', $file);
      $file_path = 'uploads/modified/';
      if (!file_exists($file_path)) {
        mkdir($file_path, 0777, true);
      }
      imagepng($destination, $file);
      unlink($tmp);
      $req = $bdd->prepare('INSERT INTO photo(image_uniqid, id_user, `date`) VALUES(?, ?, NOW())');
      $req->execute(array($file, htmlspecialchars($_SESSION['id'])));
      $req->closeCursor();
    }else{
      echo "C'est une photo ca!? faut que du PNG";
    }
    }


    if (isset($_POST['deleteimg']) && isset($_POST['imgdel'])) {

      $req = $bdd->prepare('SELECT * FROM photo WHERE id = ?');
      $req->execute(array($_POST['imgdel']));
      $data = $req->fetch();
      if ($data != false){
      $req->closeCursor();
      if ($data['id_user'] == $_SESSION['id']) {
        unlink($data['image_uniqid']);
        $req = $bdd->prepare('DELETE FROM photo WHERE id = ?');
        $req->execute(array($_POST['imgdel']));
        $req->closeCursor();
      }
    }
    }

    ?>

</div>
</div>
<div class="col-xl-6 col-md-12">
    <?php
    ///vignette
    ///vignette
    ///vignette

    function printUserPhoto($idUser, $bdd)
    {
      getUserPhoto($idUser, $bdd);
    }
    function getUserPhoto($idUser, $bdd)
    {
      $name_image = $bdd->prepare('SELECT * FROM photo WHERE id_user=? ORDER BY `date` ASC');
      $name_image->execute(array($idUser));

      while (($data = $name_image->fetch()) && $name_image->rowcount()) {
        
        echo '<div class="row justify-content-xl-end justify-content-md-center">';
        echo '<p><img style="margin:5px" width="250" height="150" src="' . $data['image_uniqid'] . '"</p>';
        echo '<form action="" method="post"><input type="hidden" name="imgdel" value="' . $data['id'] .  '"/><input type="submit" name="deleteimg" value="Supprimer !" /></form>';
        echo '</div>';
      }
    }

    if (isset($_SESSION['id']) && !empty($_SESSION['id'])) {
      $name_image = $bdd->prepare('SELECT image_uniqid, id, nom_image_user  FROM photo WHERE id_user=?');
      $name_image->execute(array($_SESSION['id']));
      $_SESSION['img'] = [];
      while ($res = $name_image->fetch()) {
        array_push($_SESSION['img'], $res['image_uniqid']);
      }
    }
    if (
      isset($_SESSION['id']) && !empty($_SESSION['id']) && isset($_SESSION['image_uniqid'])
      && !empty($_SESSION['image_uniqid']) && isset($_SESSION['nom_image_user']) && !empty($_SESSION['nom_image_user'])
    ) {
      $req = $bdd->prepare('INSERT INTO image_uniqid, id, nom_image_user  FROM photo WHERE id_user=?');
      $req->execute(array(htmlspecialchars($_SESSION['id'])));
      $new = $name_image->fetch();
    }

    if (isset($_SESSION['id']) &&  (!empty($_SESSION['id']))) {
        printUserPhoto($_SESSION['id'], $bdd);
    }
    ?>
</div>
</div>
  </div>
  </body>

  </html>