<?php
require_once('../function.php');

$db = new Database();
$deletion = new Product($db->connect());

if (isset($_POST['product_id'])) {
    $product_id = $_POST['product_id'];
    error_log("Attempting to delete product ID: $product_id"); // Log the product ID being deleted

    $result = $deletion->delete($product_id);

    if ($result) {
        echo 'success';
    } else {
        error_log("Deletion failed for product ID: $product_id");
        echo 'Failed to delete the product. Please check logs for details.';
    }
} else {
    error_log("Product ID not provided");
    echo 'No product ID provided.';
}
?>
