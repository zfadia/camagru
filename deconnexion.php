<?php
session_start();
if (isset($_SESSION['id'])) {
    $_SESSION = array();
    session_destroy();
    header('Location: connexion.php');
    exit;
} else {
    header('Location: connexion.php');
    exit;
}
