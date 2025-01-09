<?php 
session_start();
require_once('../config.php'); 
require_once '../function.php';

if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true || $_SESSION['user_role'] !== 'admin') {
    header("Location: ../login.php");
    exit;
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>(Admin Dashboard)</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <style>
        body {
            background-color: #f7f9fc;
        }
        .sidebar {
            height: 100vh;
            background-color: #343a40;
            color: #fff;
        }
        .sidebar a {
            color: #ddd;
            text-decoration: none;
            padding: 10px 20px;
            display: block;
        }
        .sidebar a:hover {
            background-color: #495057;
            color: #fff;
        }
        .navbar-custom {
            background-color: #fff;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        .card-custom {
            border: none;
            border-radius: 12px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        .table-custom thead {
            background-color: #e9ecef;
        }
    </style>
</head>
<body>
<div class="d-flex">
    <!-- Sidebar -->
    <nav class="sidebar d-flex flex-column p-3">
        <h4 class="mb-3">(insert logo)</h4>
        <a href="<?php echo BASE_URL;?>admin_dashboard/users.php"><i class="bi bi-people-fill"> </i>Users</a>
        <a href="<?php echo BASE_URL;?>admin_dashboard/product.php"><i class="bi bi-bag-fill"> </i>Products</a>
        <a href="<?php echo BASE_URL;?>admin_dashboard/order.php"><i class="bi bi-wallet-fill"> </i>Orders</a>
        <a href="../logout.php"><i class="bi-box-arrow-left"> </i>Logout</a>
    </nav>
