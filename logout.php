<?php
session_start();
require_once('config.php');
require_once('function.php');

// Retrieve the user ID before destroying the session
$userId = $_SESSION['user_id'] ?? null;

// Clear the session
$_SESSION = array();
session_destroy();

if ($userId) {
    $db = new Database();
    $user = new User($db->connect());
    $user->trackSession($userId, 'logout'); // Pass the user ID to track the logout event
}

// Redirect to the homepage
header("Location: " . BASE_URL . "index.php");
exit();
?>
