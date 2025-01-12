<?php
require_once('../templates/admin_header.php');
require_once('../function.php');

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $product_name = $_POST['product_name'] ?? '';
    $description = $_POST['description'] ?? '';
    $quantity = (int)($_POST['quantity'] ?? 0);
    $category = $_POST['category'] ?? '';
    $price = (float)($_POST['price'] ?? 0);

    $image = null;
    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $uploadDir = '../uploads/';
        $image = basename($_FILES['image']['name']);
        $targetFile = $uploadDir . $image;

        if (!move_uploaded_file($_FILES['image']['tmp_name'], $targetFile)) {
            $error_message = "Failed to upload image.";
        }
    }

    if (!empty($product_name) && !empty($description) && $quantity >= 0 && $price >= 0) {
        $product = new Product(); // Instantiate your Product class
        $isSaved = $product->save($product_name, $description, $quantity, $category, $image, $price);

        if ($isSaved) {
            $success_message = "Product added successfully!";
        } else {
            $error_message = "Failed to add product. Please try again.";
        }
    } else {
        $error_message = "Please fill in all required fields.";
    }
}
?>

<div class="container">
    <h2>Add New Product</h2>

    <?php if (!empty($error_message)) : ?>
        <div class="alert alert-danger">
            <?php echo htmlspecialchars($error_message); ?>
        </div>
    <?php endif; ?>

    <?php if (!empty($success_message)) : ?>
        <div class="alert alert-success">
            <?php echo htmlspecialchars($success_message); ?>
        </div>
    <?php endif; ?>

    <form action="" method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label for="product_name">Product Name</label>
            <input type="text" name="product_name" id="product_name" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="description">Description</label>
            <textarea name="description" id="description" class="form-control" rows="5" required></textarea>
        </div>

        <div class="form-group">
            <label for="quantity">Quantity</label>
            <input type="number" name="quantity" id="quantity" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="category">Category</label>
            <input type="text" name="category" id="category" class="form-control">
        </div>

        <div class="form-group">
            <label for="price">Price</label>
            <input type="number" step="0.01" name="price" id="price" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="image">Product Image</label>
            <input type="file" name="image" id="image" class="form-control-file">
        </div>

        <button type="submit" class="btn btn-primary">Add Product</button>
        <a href="product.php" class="btn btn-secondary">Back to Products</a>
    </form>
</div>

<?php require_once('../templates/admin_footer.php'); ?>