<?php require_once('templates/header1.php'); ?>
<section class="hero-section set-bg" data-setbg="<?php echo BASE_URL;?>assets/bootstrap/img/bg.jpg">
<div class="page-area login-page">
    <div class="container spad">
        <div class="text-center">
            <h4 class="contact-title">Login to Your Account</h4>
        </div>
        <form class="login-form" method="post" action="login_handler.php">
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="username">Username *</label>
                        <input id="username" name="username" type="text" class="form-control" placeholder="Enter your username" required>
                    </div>
                    <div class="form-group">
                        <label for="password">Password *</label>
                        <input id="password" name="password" type="password" class="form-control" placeholder="Enter your password" required>
                    </div>
                    <div class="text-center">
                        <button class="site-btn btn-primary" type="submit">Login</button>
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
