<?php
require_once('config.php');
require_once('function.php');


$db = new Database();
$deletion = new Cart($db->connect());

if (isset($_POST['cart_id'])) {
    $cart_id = $_POST['cart_id'];
    error_log("Attempting to delete product ID: $cart_id"); // Log the cart ID being deleted

    $result = $deletion->removeCartItem($cart_id);

    if ($result) {
        header('Location: cart.php?success=1');
    } else {
        header('Location: cart.php?error=1');
    }
} else {
    error_log("Product ID not provided");
    echo 'No product ID provided.';
}