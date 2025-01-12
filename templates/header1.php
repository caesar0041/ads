<?php require_once('config.php'); 
require_once ('function.php');
session_start();

?>

<!DOCTYPE html>
<html lang="zxx">
<head>
	<title><?php echo SITE_NAME;?></title>
	<meta charset="UTF-8">
<!--	<link href="<?php echo BASE_URL;?>assets/bootstrap/img/favicon.ico" rel="shortcut icon"/> -->

	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

	<link href="https://fonts.googleapis.com/css?family=Raleway:400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

	<link rel="stylesheet" href="<?php echo BASE_URL;?>assets/bootstrap/css/bootstrap.min.css"/>
	<link rel="stylesheet" href="<?php echo BASE_URL;?>assets/bootstrap/css/font-awesome.min.css"/>
	<link rel="stylesheet" href="<?php echo BASE_URL;?>assets/bootstrap/css/owl.carousel.css"/>
	<link rel="stylesheet" href="<?php echo BASE_URL;?>assets/bootstrap/css/style.css"/>
	<link rel="stylesheet" href="<?php echo BASE_URL;?>assets/bootstrap/css/animate.css"/>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

</head>

<body>
	<div id="preloder">
		<div class="loader"></div>
	</div>
	
	<header class="header-section">
		<div class="container-fluid">
			<!-- logo -->
			<div class="site-logo">
				<img src="<?php echo BASE_URL;?>assets/bootstrap/img/logo.png" alt="logo">
			</div>
			<!-- responsive -->
			<div class="nav-switch">
				<i class="fa fa-bars"></i>
			</div>
			<div class="header-right d-flex align-items-center">
				<a href="cart.php" class="bi bi-cart-dash-fill text-decoration-none text-white card-bag mr-2" style="font-size: 1.7rem;"><span>2</span>
				</a>
				<a href="				<?php
            // Check if the user is logged in
            if (isset($_SESSION['user_role'])) {
                if ($_SESSION['user_role'] === 'admin') {
                    echo BASE_URL . 'admin_dashboard/';
                } elseif ($_SESSION['user_role'] === 'customer') {
                    echo BASE_URL . 'customer_dashboard/';
                }
            } else {
                // Redirect to login if no session exists
                echo BASE_URL . 'login.php';
            }
        ?>" class="bi bi-person-circle text-decoration-none text-white" style="font-size: 1.7rem;"></a>
				<p class="d-flex ml-2 my-0 text-white"><?php
					if (isset($_SESSION['user_id'])) {
						echo 'Welcome, ' . $_SESSION['username'];
					} else {
						echo 'Welcome, Guest';
					}
				?></p>
			</div>
			<!-- site menu -->
			<ul class="main-menu">
				<li><a href="<?php echo BASE_URL;?>">Home</a></li>
				<li><a href="<?php echo BASE_URL;?>browse.php">BROWSE</a></li>
				<li><a href="<?php echo BASE_URL;?>login.php">SIGN IN</a></li>
				<li><a href="<?php echo BASE_URL;?>about.php">ABOUT</a></li>
			</ul>
		</div>
	</header>