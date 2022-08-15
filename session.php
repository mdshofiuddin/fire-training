<?php
ob_start();
session_start();
ob_flush();
if ($_SESSION['fkl'] == null) {
   header('location: index.php');
}
require_once './Auth.php';
require_once './Controller.php';
$userView = new Controller();
$login = new Auth();

if (isset($_GET['logout'])) {
    
    $login->logout();
}
