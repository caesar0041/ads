<?php
require_once('templates/header1.php');

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_GET['product_id'])) {
    echo "<p>Product ID is not specified. Please go back and select a product.</p>";
    exit;
}

$product_id = intval($_GET['product_id']);
$product = new Product();
$product_details = $product->getProductById($product_id);

if (!$product_details) {
    echo "<p>Product not found. Please go back and try again.</p>";
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add'])) {
    try {
        $cart = new Cart();
        $quantity = isset($_POST['quantity']) ? (int)$_POST['quantity'] : 1;
        $cart->addToCart($_SESSION['user_id'], $product_id, $quantity);

        echo "<p class='alert alert-success'>Product added to cart successfully!</p>";
    } catch (Exception $e) {
        echo "<p class='alert alert-danger'>Error adding to cart: " . $e->getMessage() . "</p>";
    }
}
?>

<section class="product-details">
    <div class="container">
        <div class="row mt-5">
            <div class="col-lg-6">
                <?php if (!empty($product_details['image'])): ?>
                    <img src="../uploads/<?php echo htmlspecialchars($product_details['image']); ?>" 
                         alt="<?php echo htmlspecialchars($product_details['product_name']); ?>" 
                         class="img-fluid">
                <?php else: ?>
                    <img src="<?php echo BASE_URL; ?>assets/bootstrap/img/placeholder.png" 
                         alt="Placeholder" class="img-fluid">
                <?php endif; ?>
            </div>
            <div class="col-lg-6">
                <h1><?php echo htmlspecialchars($product_details['product_name']); ?></h1>
                <p><strong>Category:</strong> <?php echo htmlspecialchars($product_details['category']); ?></p>
                <p><strong>Quantity Available:</strong> <?php echo htmlspecialchars($product_details['quantity']); ?></p>
                <p><strong>Price:</strong> $<?php echo number_format($product_details['price'], 2); ?></p>
                <p><strong>Description:</strong></p>
                <p><?php echo nl2br(htmlspecialchars($product_details['description'])); ?></p>
                <form action="" method="POST" class="mt-3">
                    <div class="form-group">
                        <label for="quantity">Quantity:</label>
                        <input type="number" id="quantity" name="quantity" class="form-control" value="1" min="1" max="<?php echo htmlspecialchars($product_details['quantity']); ?>">
                    </div>
                    <input type="hidden" name="product_id" value="<?php echo htmlspecialchars($product_id); ?>">
                    <button type="submit" name="add" class="btn btn-primary">Add to Cart</button>
                </form>
            </div>
        </div>
    </div>
</section>

<?php require_once('templates/footer1.php'); ?>
