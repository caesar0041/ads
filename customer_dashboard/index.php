<!-- users profile -->
<?php 
session_start();
require_once('../config.php'); 
require_once '../function.php';

if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true || $_SESSION['user_role'] !== 'customer') {
    header("Location: ../login.php");
    exit;
}

echo 'hello ' . $_SESSION['name'];
?>