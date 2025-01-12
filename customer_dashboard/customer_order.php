<?php
require_once('../templates/customer_header.php');

if (!isset($_SESSION['user_id'])) {
    echo "<p>Session user ID is not set. Please log in.</p>";
    exit;
}

try {
    $user_id = $_SESSION['user_id'];
    $orderObj = new Order();

    // Fetch orders for the user
    $orders = $orderObj->getOrdersByUser($user_id);
} catch (Exception $e) {
    echo "<p>Error: " . htmlspecialchars($e->getMessage(), ENT_QUOTES, 'UTF-8') . "</p>";
    exit;
}
?>

<section class="hero-section set-bg" data-setbg="<?php echo defined('BASE_URL') ? BASE_URL : ''; ?>assets/bootstrap/img/bg.jpg">
    <div class="container mt-5">
        <h1>Your Orders</h1>
    </div>
    <div class="table-container">
        <?php if (!empty($orders)): ?>
            <table>
                <tr>
                    <th>Order ID</th>
                    <th>Total Price</th>
                    <th>Status</th>
                    <th>Date</th>
                    <th>Details</th>
                </tr>
                <?php foreach ($orders as $order): ?>
                    <tr>
                        <?php
                        $order_id = htmlspecialchars($order['order_id'], ENT_QUOTES, 'UTF-8');
                        $total_price = number_format($order['total_price'], 2);
                        $status = htmlspecialchars($order['status'], ENT_QUOTES, 'UTF-8');
                        $ordered_at = htmlspecialchars($order['ordered_at'], ENT_QUOTES, 'UTF-8');
                        ?>
                        <td><?php echo $order_id; ?></td>
                        <td>$<?php echo $total_price; ?></td>
                        <td><?php echo $status; ?></td>
                        <td><?php echo $ordered_at; ?></td>
                        <td>
                            <a href="order_details.php?order_id=<?php echo urlencode($order_id); ?>" class="btn-secondary">View Details</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </table>
            <div class="text-center">
                <a href="index.php" class="btn-primary">Back to Home</a>
            </div>
        <?php else: ?>
            <p class="empty-cart">You have not placed any orders yet.</p>
            <div class="text-center">
                <a href="index.php" class="btn-primary">Back to Home</a>
            </div>
        <?php endif; ?>
    </div>
</section>

<?php require_once('../templates/customer_footer.php'); ?>
