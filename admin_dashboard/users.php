<?php require_once('../templates/admin_header.php');?>

<section class="content">
        <?php
        if (isset($_GET['success']) && $_GET['success'] == 1) {
            echo '<div class="alert alert-success">The record has been successfully updated.</div>';
        }

        if (isset($_GET['delete_success']) && $_GET['delete_success'] == 1) {
            echo '<div class="alert alert-success">The record has been successfully deleted.</div>';
        }

        if (isset($_GET['error']) && $_GET['error'] == 1) {
            echo '<div class="alert alert-danger">Error: Unable to save.</div>';
        }
        ?>
        <div class="card card-info">
            <div class="card-header">
                <h3 class="card-title">User List</h3>
            </div>
            <div>
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-md-5">
                            <form method="GET" action="users.php" class="form-inline">
                                <div class="input-group w-100">
                                    <input type="text" name="search" class="form-control" placeholder="Search by name or username" value="<?php echo isset($_GET['search']) ? htmlspecialchars($_GET['search']) : ''; ?>">
                                    <div class="input-group-append">
                                        <button type="submit" class="btn btn-outline-secondary">Search</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="col-md-7 text-right">
                            <a href="user_register.php" class="btn btn-success">+ Add New User</a>
                        </div>
                    </div>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>User ID</th>
                                <th>Name</th>
                                <th>Username</th>
                                <th>Role</th>
                                <th>Account Created</th>
                                <th>User Activity</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php

                            foreach ($users as $user) {
                                $created_at = (new DateTime($user['created_at']))->format('M d, Y H:i');
                                echo "<tr>
                                    <td>{$user['user_id']}</td>
                                    <td>{$user['fname']} {$user['lname']}</td>
                                    <td>{$user['username']}</td>
                                    <td>{$user['role']}</td>
                                    <td>{$created_at}</td>
                                    <td><i>placeholder<i></td>
                        
                                </tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
    </section>
</div>

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
                Are you sure you want to delete this user?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-danger" id="confirmDeleteBtn">Delete</button>
            </div>
        </div>
    </div>
</div>

<?php require_once('../templates/admin_footer.php'); ?>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const deleteButtons = document.querySelectorAll('.delete-btn');
        let userIdToDelete;

        deleteButtons.forEach(button => {
            button.addEventListener('click', function() {
                userIdToDelete = this.getAttribute('data-id');
                $('#deleteModal').modal('show');
            });
        });

        document.getElementById('confirmDeleteBtn').addEventListener('click', function() {
            fetch(`user_delete.php?user_id=${userIdToDelete}`)
                .then(response => {
                    if (response.ok) {
                        window.location.href = 'users.php?delete_success=1';
                    } else {
                        console.error('Error deleting user');
                    }
                })
                .catch(error => console.error('Error:', error));
        });
    });
</script>
