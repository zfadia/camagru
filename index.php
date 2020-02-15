<?php
include_once "headerbdd.php";
include_once "header.php";
function getemail($idphoto, $bdd)
{
  $reqemail = $bdd->prepare('SELECT id_user FROM photo WHERE id = ?');
  $reqemail->execute(array($idphoto));
  $data = $reqemail->fetch();
  $idd = $data['id_user'];
  $reqemail->closeCursor();

  $reqemail = $bdd->prepare('SELECT email FROM data_user  WHERE id = ?');
  $reqemail->execute(array($idd));
  $data = $reqemail->fetch();
  $reqemail->closeCursor();

  $reqsendemail = $bdd->prepare('SELECT sendemail from data_user WHERE id=?');
  $reqsendemail->execute(array($idd));
  $ouinon = $reqsendemail->fetch();
  $data['sendemail'] = $ouinon['sendemail'];
  $reqsendemail->closeCursor();
  return ($data);
}

function sendMail($email, $bdd)
{
  if (isset($_SESSION['id'])) {
    $to = $email;
    $sujet = " Reception d'un commentaire ! ";
    $header = "MIME-Version: 1.0\r\n";
    $header .= "Content-Type: text/html; charset='utf-8'\r\n";
    $header .= "From: camagru@42.fr\r\n";
    $message = '<html>
           <head>
           <title> commentaire camagru,</title>
           <meta charset="utf-8" />
           </head>
           <body>
           <font color="#303030";>
               <div align="center">
               <table width="600px">
                   <tr>
                   <td>
                   <div align="center"><p> Bonjour <b></p></b></div>
                  <div align="center"> <p> vous avez reçu yn commentaire <p></b></div>
                   </tr>
                   <tr>
                   <td align="center">
                       <font size="2">
                       Ceci est un email automatique, merci de ne pas y répondre
                       </font>
                   </td>
                   </tr>
               </table>
               </div>
           </font>
           </body>
           </html>';
    mail($to, $sujet, $message, $header);
  }
}
function getAllPhoto($bdd)
{
  $name_image = $bdd->query('SELECT *  FROM photo ORDER BY `date` ASC');
  $photo = [];
  while ($res = $name_image->fetch()) {
    array_push($photo, $res['image_uniqid']);
  }
  return $photo;
}

function recupidImage($image_uniqid, $bdd)
{
  if (!file_exists($image_uniqid)){
    return false;
  }

  $reqid = $bdd->prepare('SELECT id FROM photo WHERE image_uniqid=?');
  $reqid->execute(array($image_uniqid));
  $data = $reqid->fetch();
  $reqid->closeCursor();
  return ($data['id']);
}


function printAllPhotoOnly($bdd)
{
  $array_photos = getAllPhoto($bdd);
  foreach ($array_photos as $photo) {
    echo '<img style="margin:5px" width="250" height="150" src="' . $photo . '">';
  }
}

function canLike($idPhoto, $bdd)
{
  $req = $bdd->prepare('SELECT * FROM `like` WHERE id_user=? AND id_photo=?');
  $req->execute(array($_SESSION['id'], $idPhoto));
  $req->closeCursor();
  if ($req->rowCount())
    return (0);
  return (1);
}


function likePhoto($bdd){
  if (($idPhoto = recupidImage($_POST["namePhoto"], $bdd)) == false){
    return;
  }

  $canlike = canLike($idPhoto, $bdd);
  if ($canlike) {
    $req = $bdd->prepare('INSERT INTO `like`(id_user, id_photo) VALUES (?,?)');
    $req->execute(array(htmlspecialchars($_SESSION['id']), $idPhoto));
    $req->closeCursor();

    $req = $bdd->prepare('SELECT * FROM photo WHERE id=?');
    $req->execute(array($idPhoto));
    $data = $req->fetch();

    $like = htmlspecialchars($data['like']);
    $req->closeCursor();

    $req = $bdd->prepare('UPDATE photo SET `like`=? WHERE id=?');
    $req->execute(array($like + 1, $idPhoto));
    $req->closeCursor();
  }
}

if (isset($_SESSION['id']) && !empty($_SESSION['id']) && isset($_POST['submitlike']) && isset($_POST['namePhoto'])) {
  likePhoto($bdd);
}


function addComm($bdd){
  if (($idPhoto = recupidImage($_POST["namePhoto"], $bdd)) == false){
    return;
  }
  $req = $bdd->prepare('INSERT INTO comm(id_photo, `user_id`, comm, date_comm ) VALUES (?,?,?,NOW())');
  $req->execute(array($idPhoto, htmlspecialchars($_SESSION['id']), htmlspecialchars($_POST['commentaire'])));
  $req->closeCursor();
  //$email = [];
  $email = getemail($idPhoto, $bdd);
  if ($email['sendemail'] == 1)
    sendMail($email['email'], $bdd);
}

if (isset($_SESSION['id']) && !empty($_SESSION['id']) && isset($_POST['submitcommentaire']) && isset($_POST['commentaire'])) {
  addComm($bdd);
}


function getLike($bdd, $photo)
{
  $idPhoto = recupidImage($photo, $bdd);
  $req = $bdd->prepare('SELECT * FROM photo WHERE id=?');
  $req->execute(array($idPhoto));
  $data = $req->fetch();

  $like = $data['like'];
  $req->closeCursor();
  return ($like);
}
include("testepagination.php");


