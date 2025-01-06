<?php require_once('templates/header1.php'); ?>
<div class="d-flex flex-column min-vh-100">
    <!-- Main Content -->
    <section class="hero-section set-bg flex-grow-1" data-setbg="<?php echo BASE_URL;?>assets/bootstrap/img/bg.jpg">
        <div class="page-area register-page">
            <div class="container spad">
                <div class="text-center">
                    <h4 class="contact-title">Create Your Account</h4>
                </div>
                <form class="register-form" method="post" action="register_handler.php">
                    <div class="row justify-content-center">
                        <div class="col-md-6">
                            <!-- Form Fields -->
                            <div class="form-group">
                                <label for="username">Username *</label>
                                <input id="username" name="username" type="text" class="form-control" placeholder="Choose a username" required>
                            </div>
                            <div class="form-group">
                                <label for="first_name">First Name *</label>
                                <input id="first_name" name="first_name" type="text" class="form-control" placeholder="Enter your first name" required>
                            </div>
                            <div class="form-group">
                                <label for="last_name">Last Name *</label>
                                <input id="last_name" name="last_name" type="text" class="form-control" placeholder="Enter your last name" required>
                            </div>
                            <div class="form-group">
                                <label for="email">Email Address *</label>
                                <input id="email" name="email" type="email" class="form-control" placeholder="Enter your email" required>
                            </div>
                            <div class="form-group">
                                <label for="password">Password *</label>
                                <input id="password" name="password" type="password" class="form-control" placeholder="Create a password" required>
                            </div>
                            <div class="form-group">
                                <label for="confirm_password">Confirm Password *</label>
                                <input id="confirm_password" name="confirm_password" type="password" class="form-control" placeholder="Confirm your password" required>
                            </div>
                            <div class="text-center">
                                <button class="site-btn btn-primary" type="submit">Register</button>
                            </div>
                            <div class="text-center mt-3">
                                <p>Already have an account? <a href="login.php">Login here</a></p>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <?php require_once('templates/footer1.php'); ?>
</div>

<?php require_once('templates/footer1.php'); ?>
