<?php require_once('templates/header1.php');

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['user_id'])) {
    echo "<p>Please <a href='login.php'>log in</a> to add items to your cart.</p>";
    exit;
}

$product = new Product();
$products = $product->getAllProducts();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add'])) {
    try {
        $cart = new Cart();
        $product_id = $_POST['product_id'];
        $quantity = isset($_POST['quantity']) ? (int)$_POST['quantity'] : 1;
        $cart->addToCart($_SESSION['user_id'], $product_id, $quantity);

        echo "<p class='alert alert-success'>Product added to cart successfully!</p>";
    } catch (Exception $e) {
        echo "<p class='alert alert-danger'>Error adding to cart: " . $e->getMessage() . "</p>";
    }
}
?>
<section class="hero-section set-bg" data-setbg="<?php echo BASE_URL; ?>assets/bootstrap/img/bg.jpg">
    <div class="container mt-5">
        <div class="album">
            <div class="row justify-content-center">
                <?php if (!empty($products)): ?>
                    <?php foreach ($products as $product): ?>
                        <div class="col-lg-4 col-md-6 mb-4">
                            <div class="card h-100 shadow-sm">
                                <?php if (!empty($product['image'])): ?>
                                    <img class="card-img-top" 
                                         src="../uploads/<?php echo htmlspecialchars($product['image']); ?>" 
                                         alt="<?php echo htmlspecialchars($product['product_name']); ?>">
                                <?php else: ?>
                                    <img class="card-img-top" 
                                         src="<?php echo BASE_URL; ?>assets/bootstrap/img/placeholder.png" 
                                         alt="Placeholder">
                                <?php endif; ?>
                                <div class="card-body">
                                    <h5 class="card-title"><?php echo htmlspecialchars($product['product_name']); ?></h5>
                                    <p class="card-text"><strong>Category:</strong> <?php echo htmlspecialchars($product['category']); ?></p>
                                    <p class="card-text"><strong>Quantity:</strong> <?php echo htmlspecialchars($product['quantity']); ?></p>
                                    <p class="card-text"><strong>Price:</strong> $<?php echo number_format($product['price'], 2); ?></p>
                                </div>
                                <div class="card-footer text-center">
                                <form action="" method="POST">
                                    <input type="hidden" name="product_id" value="1">
                                    <input type="hidden" name="quantity" value="1">
                                    <button type="submit" name="add">Add to Cart</button>
                                </form>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <div class="col-md-12">
                        <p class="text-center">No products found. Click "Add New Product" to create one.</p>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>

<?php require_once('templates/footer1.php'); ?>
