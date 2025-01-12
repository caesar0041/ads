<?php
require_once('templates/header1.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['username']) && isset($_POST['password'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];

        $db = new Database();
        $user = new User($db->connect());
        $authenticatedUser = $user->authenticate($username, $password);

        if ($authenticatedUser) {
            $_SESSION['logged_in'] = true;
            $_SESSION['user_role'] = $authenticatedUser['role'];
            $_SESSION['username'] = $username;
            $_SESSION['name'] = $authenticatedUser['full_name'];
            $_SESSION['user_id'] = $authenticatedUser['user_id'];

            $user->trackSession($authenticatedUser['user_id'], 'login');

            if ($_SESSION['user_role'] == 'admin') {
                header("Location: admin_dashboard/index.php");
            } elseif ($_SESSION['user_role'] == 'customer') {
                header("Location: customer_dashboard/index.php");
            } else {
                header("Location: login.php?error=1");
                die("Invalid user role.");
            }
        } else {
            $error_message = "Invalid username or password. Please try again.";
        }
    }
}
?>

<section class="hero-section set-bg" data-setbg="<?php echo BASE_URL; ?>assets/bootstrap/img/bg.jpg">
<div class="page-area login-page">
    <div class="container spad">
        <div class="text-center">
            <h4 class="contact-title">Login to Your Account</h4>
        </div>
        <form class="login-form" method="post" action="">
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <?php if (isset($error_message)) : ?>
                        <div class="alert alert-danger" role="alert"><?php echo $error_message; ?></div>
                    <?php endif; ?>
                    <div class="form-group">
                        <label for="username">Username *</label>
                        <input id="username" name="username" type="text" class="form-control" placeholder="Enter your username" required>
                    </div>
                    <div class="form-group">
                        <label for="password">Password *</label>
                        <input id="password" name="password" type="password" class="form-control" placeholder="Enter your password" required>
                    </div>
                    <div class="text-center">
                        <button class="site-btn btn-primary" type="submit" name="save">Login</button>
                    </div>
                    <div class="text-center mt-3">
                        <a href="forgot_password.php">Forgot your password?</a>
                    </div>
                    <div class="text-center mt-2">
                        <p>Don't have an account? <a href="register.php">Register here</a></p>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
</section>
<?php require_once('templates/footer1.php'); ?>