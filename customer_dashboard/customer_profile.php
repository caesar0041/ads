<?php 
require_once('../templates/customer_header.php');
$user_id = $_SESSION['user_id']; // Assume user_id is stored in session
$user = new User();
$currentUser = $user->getUserById($user_id);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $new_password = $_POST['password'];

    // Check if a new password is provided
    if (!empty($new_password)) {
        $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);
    } else {
        $hashed_password = $currentUser['pw']; // Keep the existing password
    }

    // Update user details
    $updateSuccess = $user->update($user_id, $username, $first_name, $last_name, $hashed_password);

    if ($updateSuccess) {
        echo "<div class='alert alert-success'>Profile updated successfully!</div>";
        $currentUser = $user->getUserById($user_id); // Refresh user data
    } else {
        echo "<div class='alert alert-danger'>Failed to update profile. Please try again.</div>";
    }
}
?>

<div class="container mt-4">
    <h3>Edit Profile</h3>
    <form method="POST" enctype="multipart/form-data">
        <div class="form-group">
            <label>Username</label>
            <input type="text" name="username" class="form-control" value="<?php echo htmlspecialchars($currentUser['username']); ?>" required>
        </div>
        <div class="form-group">
            <label>First Name</label>
            <input type="text" name="first_name" class="form-control" value="<?php echo htmlspecialchars($currentUser['fname']); ?>" required>
        </div>
        <div class="form-group">
            <label>Last Name</label>
            <input type="text" name="last_name" class="form-control" value="<?php echo htmlspecialchars($currentUser['lname']); ?>" required>
        </div>
        <div class="form-group">
            <label>New Password</label>
            <input type="password" name="password" class="form-control" placeholder="Enter a new password (leave blank to keep the current password)">
        </div>
        <button type="submit" class="btn btn-primary">Update Profile</button>
    </form>
</div>

<?php require_once('../templates/customer_footer.php'); ?>
