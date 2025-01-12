<?php 
require_once('../templates/customer_header.php'); 


// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

// Fetch user details from the database
$user = new User();
$currentUser = $user->getUserById($_SESSION['user_id']);
?>

<div class="container mt-4">
    <!-- User Profile Section -->
    <div class="row mb-4">
        <div class="col-md-12">
            <div class="card card-custom p-4">
                <div class="row">
                    <div class="col-md-9">
                        <h4>Hello, <?php echo htmlspecialchars($currentUser['full_name']); ?>!</h4>
                        <p><strong>Username:</strong> <?php echo htmlspecialchars($currentUser['username']); ?></p>
    
                        <a href="customer_profile.php" class="btn btn-primary mt-3">Edit Profile</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require_once('../templates/customer_footer.php'); ?>
