<?php require_once('config.php'); 
require_once ('function.php');?>

<!DOCTYPE html>
<html lang="zxx">
<head>
	<title><?php echo SITE_NAME;?></title>
	<meta charset="UTF-8">
<!--	<link href="<?php echo BASE_URL;?>assets/bootstrap/img/favicon.ico" rel="shortcut icon"/> -->

	<link href="https://fonts.googleapis.com/css?family=Raleway:400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

	<link rel="stylesheet" href="<?php echo BASE_URL;?>assets/bootstrap/css/bootstrap.min.css"/>
	<link rel="stylesheet" href="<?php echo BASE_URL;?>assets/bootstrap/css/font-awesome.min.css"/>
	<link rel="stylesheet" href="<?php echo BASE_URL;?>assets/bootstrap/css/owl.carousel.css"/>
	<link rel="stylesheet" href="<?php echo BASE_URL;?>assets/bootstrap/css/style.css"/>
	<link rel="stylesheet" href="<?php echo BASE_URL;?>assets/bootstrap/css/animate.css"/>

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
				<a href="cart.php" class="card-bag mr-3"><img src="<?php echo BASE_URL;?>assets/bootstrap/img/icons/bag.png" alt=""><span>2</span></a>
				<form action="search.php" method="get" class="d-flex align-items-center">
                	<input type="text" name="query" class="form-control form-control-sm me-2" placeholder="Search...">
					<a href="#" class="search"><img src="<?php echo BASE_URL;?>assets/bootstrap/img/icons/search.png" alt=""></a>
				</form>
				
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