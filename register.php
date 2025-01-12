<?php require_once('templates/header1.php');

if (isset($_POST['save'])) {
    $username = $_POST['username'];
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $password = $_POST['password'];

    $hashed_password = password_hash($password, PASSWORD_BCRYPT);

        $db = new Database();
        $user = new User($db->connect());
        if ($user->save($username, $first_name, $last_name, $hashed_password)) {
            header('Location:' . BASE_URL . 'index.php?success=1');
            exit;
        } else {
            echo "Error registering user.";
            echo "Username: $username";
            echo "First Name: $first_name";
            echo "Last Name: $last_name";
            echo "Password (Hashed): $hashed_password";

        }
    }
?>
<div class="d-flex flex-column min-vh-100">
    <!-- Main Content -->
    <section class="hero-section set-bg flex-grow-1" data-setbg="<?php echo BASE_URL;?>assets/bootstrap/img/bg.jpg">
        <div class="page-area register-page">
            <div class="container spad">
                <div class="text-center">
                    <h4 class="contact-title">Create Your Account</h4>
                </div>
                <form class="register-form" method="post" action="">
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
                                <label for="password">Password *</label>
                                <input id="password" name="password" type="password" class="form-control" placeholder="Create a password" required>
                            </div>
                        <!--    <div class="form-group">
                                <label for="confirm_password">Confirm Password *</label>
                                <input id="confirm_password" name="confirm_password" type="password" class="form-control" placeholder="Confirm your password" required>
                            </div> -->
                            <div class="text-center">
                                <button class="site-btn btn-primary" type="submit" name="save" value="Register">Register</button>
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
</div>

<?php require_once('templates/footer1.php'); ?>