<?php
session_start();  
try {
    $bdd = new PDO('mysql:host=localhost;dbname=camagru;charset=utf8', 'root', 'rootroot');
    } 
    catch (Exception $e) 
    {
        die('error :' . $e->getMessage());
    }  
?>   
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <link rel="stylesheet" href="index.css" />
    <title> camagru </title>
</head>

<body>
    <?php
include 'header.php';
?>


</body>
    
</html>