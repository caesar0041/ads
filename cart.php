<?php 
require_once('templates/header1.php');

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

try {
    $cart = new Cart();

    if (!isset($_SESSION['user_id'])) {
        throw new Exception("Please log in to view your cart.");
    }

    $cart_items = $cart->getCartItems($_SESSION['user_id']);
    $total_price = 0; // Initialize total price
} catch (Exception $e) {
    echo "<p>Error: " . htmlspecialchars($e->getMessage(), ENT_QUOTES, 'UTF-8') . "</p>";
    exit;
}
?>

<section class="hero-section set-bg" data-setbg="<?php echo defined('BASE_URL') ? BASE_URL : ''; ?>assets/bootstrap/img/bg.jpg">
    <div class="container mt-5">
        <h1>Your Cart</h1>
    </div>
</section>

<div class="table-container">
    <?php if (!empty($cart_items)): ?>
        <table>
            <tr>
                <th>Product</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Total</th>
                <th>Action</th>
            </tr>
            <?php foreach ($cart_items as $item): ?>
                <?php
                $cart_id = htmlspecialchars($item['cart_id'], ENT_QUOTES, 'UTF-8');
                $product_name = htmlspecialchars($item['name'], ENT_QUOTES, 'UTF-8');
                $product_price = number_format($item['price'], 2);
                $quantity = htmlspecialchars($item['quantity'], ENT_QUOTES, 'UTF-8');
                $total = $item['price'] * $quantity;
                $total_price += $total;
                ?>
                <tr>
                    <td><?php echo $product_name; ?></td>
                    <td>$<?php echo $product_price; ?></td>
                    <td><?php echo $quantity; ?></td>
                    <td>$<?php echo number_format($total, 2); ?></td>
                    <td>
                        <form action="remove_from_cart.php" method="POST" style="display:inline;">
                            <input type="hidden" name="cart_id" value="<?php echo $cart_id; ?>">
                            <button class="btn-secondary" type="submit">Remove</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>
        <p class="total-price">Total Price: $<?php echo number_format($total_price, 2); ?></p>
        <div class="text-center">
            <a href="index.php" class="btn-primary">Back to Home</a>
            <form action="checkout.php" method="POST" style="display:inline;">
                <button class="btn-primary" type="submit">Proceed to Checkout</button>
            </form>
        </div>
    <?php else: ?>
        <p class="empty-cart">Your cart is empty.</p>
        <div class="text-center">
            <a href="index.php" class="btn-primary">Back to Home</a>
        </div>
    <?php endif; ?>
</div>

<?php
require_once('templates/footer1.php');
?>
