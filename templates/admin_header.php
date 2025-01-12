<?php 
session_start();
require_once('../config.php'); 
require_once '../function.php';

if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true || $_SESSION['user_role'] !== 'admin') {
    header("Location: ../login.php");
    exit;
}

$db = new Database();
$user = new User($db->connect());
$users = $user->getAllRecords();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>(Admin Dashboard)</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>
<body>
<div class="d-flex">
    <!-- Sidebar -->
    <nav class="sidebar d-flex flex-column p-3">
        <h4 class="mb-3">(insert logo)</h4>
        <a href="<?php echo BASE_URL;?>admin_dashboard/index.php"><i class="bi bi-house-fill"> </i>Dashboard</a>
        <a href="<?php echo BASE_URL;?>admin_dashboard/users.php"><i class="bi bi-people-fill"> </i>Users</a>
        <a href="<?php echo BASE_URL;?>admin_dashboard/product.php"><i class="bi bi-bag-fill"> </i>Products</a>
        <a href="<?php echo BASE_URL;?>admin_dashboard/order.php"><i class="bi bi-wallet-fill"> </i>Orders</a>
        <a href="../logout.php"><i class="bi-box-arrow-left"> </i>Logout</a>
    </nav>
    <!-- Main Content -->
    <div class="flex-grow-1">
        <!-- Top Navbar -->
        <nav class="navbar navbar-expand-lg navbar-light navbar-custom px-4">
            <a class="navbar-brand" href="#">Admin Dashboard</a>
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo BASE_URL;?>">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo BASE_URL;?>/logout.php">Logout(??)</a>
                </li>
            </ul>
        </nav>