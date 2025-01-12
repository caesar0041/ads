<?php require_once('../templates/admin_header.php');
$product = new Product();
$products = $product->getAllProducts();
?>
<section class="content">
    <div class="container mt-3">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h2 class="mb-0">Product Management</h2>
            <a href="product_add.php" class="btn btn-success">Add New Product</a>
        </div>
        <div class="album">
            <div class="row justify-content-center">
                <?php if (!empty($products)): ?>
                    <?php foreach ($products as $product): ?>
                        <div class="col-md-4">
                            <div class="card mb-4 shadow-sm">
                                <?php if (!empty($product['image'])): ?>
                                    <img class="card-img-top" 
                                         style="width: 100%; height: 300px; object-fit: cover;" 
                                         src="../uploads/<?php echo htmlspecialchars($product['image']); ?>" 
                                         alt="<?php echo htmlspecialchars($product['product_name']); ?>">
                                <?php endif; ?>
                                <div class="card-body">
                                    <h5 class="card-title"><strong><?php echo htmlspecialchars($product['product_name']); ?></strong></h5>
                                    <p class="card-text"><?php echo htmlspecialchars($product['description']); ?></p>
                                    <p class="card-text"><strong>Category:</strong> <?php echo htmlspecialchars($product['category']); ?></p>
                                    <p class="card-text"><strong>Quantity:</strong> <?php echo htmlspecialchars($product['quantity']); ?></p>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <a href="product_edit.php?product_id=<?php echo htmlspecialchars($product['product_id']); ?>" 
                                           class="btn btn-primary">Edit</a>
                                        <button class="btn btn-danger delete-btn" href="product_delete.php"
                                                data-id="<?php echo htmlspecialchars($product['product_id']); ?>">Delete</button>
                                    </div>
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

    <!-- Delete Confirmation Modal -->
    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel">Confirm Deletion</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Are you sure you want to delete this product?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-danger" id="confirmDeleteBtn">Delete</button>
                </div>
            </div>
        </div>
    </div>
</section>


<?php require_once('../templates/admin_footer.php'); ?>
<script>
document.addEventListener('DOMContentLoaded', function () {
  const deleteButtons = document.querySelectorAll('.delete-btn');
  let productIDtoDelete;

  deleteButtons.forEach(button => {
    button.addEventListener('click', function () {
      productIDtoDelete = this.getAttribute('data-id');
      $('#deleteModal').modal('show');
    });
  });

  document.getElementById('confirmDeleteBtn').addEventListener('click', function () {
    const formData = new FormData();
    formData.append('product_id', productIDtoDelete);

    fetch('product_delete.php', {
      method: 'POST',
      body: formData,
    })
      .then(response => response.text())
      .then(response => {
        if (response.trim() === 'success') {
          window.location.reload();
        } else {
          alert('Error deleting product: ' + response);
        }
      })
      .catch(error => console.error('Error:', error));
  });
});

</script>
