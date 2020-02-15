<?php
include_once "headerbdd.php";
include_once "header.php";
if (!isset($_SESSION['id']))
    header('Location: index.php');

    $req = $bdd->prepare('SELECT *  FROM photo  WHERE image_uniqid=?');
$req->execute(array($_GET['img']));
$img = $req->fetch();

if ($img != false){

$req->closeCursor();

$req = $bdd->prepare('SELECT *  FROM comm WHERE id_photo=?');
$req->execute(array($img['id']));

echo '<img style="margin:5px" src="' . $img['image_uniqid'] . '" />';

while ($comm = $req->fetch()) {
    $requete = $bdd->prepare('SELECT *  FROM data_user WHERE id=?');
    $requete->execute(array($comm['user_id']));
    $pseudo = $requete->fetch();
    $requete->closeCursor();
    if ($pseudo != false)
    echo '<p>' . $comm['comm'] . ' de ' . $pseudo['pseudo'];
}
}else{
    header('Location: index.php');

}