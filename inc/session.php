<?php
 session_start();
 error_reporting(E_ALL);
require_once './Controller.php';
require_once './Auth.php';
$userView = new Controller();
$login = new Auth();

if(isset($_GET['logout'])){
    $login->logout();
}
?>


