<?php
require_once ('..templates/admin_header.php');

$db = new Database();
$user = new User($db->connect());

$user_id = 1; // The ID of the user to update
$username = 'new_username';
$first_name = 'NewFirstName';
$last_name = 'NewLastName';
$password = 'new_password';
$hashed_password = password_hash($password, PASSWORD_BCRYPT);

if ($user->update($user_id, $username, $first_name, $last_name, $hashed_password)) {
    echo "User updated successfully.";
} else {
    echo "Error updating user.";
}
?>