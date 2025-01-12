<?php
require_once 'function.php';

$hashed_password = password_hash('admin123', PASSWORD_BCRYPT);
echo $hashed_password;

/*$password_in_db = '$2y$10$qIrMPaeVbuUFVyUMwzlyjeeweSLicfEoIpPMthKNjIg'; // Replace with your retrieved hash.
$password_entered = '5001';
if (password_verify($password_entered, $password_in_db)) {
    echo "Password is correct.";
} else {
    echo "Password is incorrect.";
}*/

?>
