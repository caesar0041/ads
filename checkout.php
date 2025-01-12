<?php  
require_once('templates/header1.php');

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['user_id'])) {
    echo "<p>Please log in to proceed to checkout.</p>";
    exit;
}

$user_id = $_SESSION['user_id'];
$cart = new Cart();
$order = new Order();

try {
    $cart_items = $cart->getCartItems($user_id);

    if (empty($cart_items)) {
        echo "<p>Your cart is empty. Nothing to checkout.</p>";
        exit;
    }

    $order_total_price = 0;

    foreach ($cart_items as $item) {
        $price = $item['price'];
        $quantity = $item['quantity'];
        $order_total_price += $price * $quantity;
    }

    // Place the order and get the new order ID
    $order_id = $order->placeOrder($user_id, $order_total_price);

    if (!$order_id) {
        throw new Exception("Failed to create order.");
    }

    // Manually insert items into order_items
    foreach ($cart_items as $item) {
        $item_id = $item['order_item_id']; // Assuming item_id is a field in cart_items
        $quantity = $item['quantity'];
        $price = $item['price'];

        if (!$order->addOrderItem($order_id, $item_id, $quantity, $price)) {
            throw new Exception("Failed to add items to the order.");
        }
    }

    // Clear the user's cart after manually populating order_items
    if ($cart->clearCart($user_id)) {
        echo "<p>Your cart has been cleared after checkout.</p>";
    } else {
        echo "<p>Failed to clear the cart. Please contact support.</p>";
    }

    echo "<p>Your order has been placed successfully. Order ID: {$order_id}</p>";

} catch (Exception $e) {
    echo "<p>Error: " . htmlspecialchars($e->getMessage(), ENT_QUOTES, 'UTF-8') . "</p>";
}

echo '<div class="text-center">';
echo '<a href="index.php" class="btn-primary">Back to Home</a>';
echo '<a href="orders.php" class="btn-primary">View Your Orders</a>';
echo '</div>';

require_once('templates/footer1.php');
?>
