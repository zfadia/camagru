<?php
error_reporting(E_ALL);
session_start();

    try {
        $bdd = new PDO('mysql:host=localhost;port=8080;dbname=camagru;charset=utf8', 'root', 'rootroot');
    } catch (Exception $e) {
        die('error :' . $e->getMessage());
    }
?>