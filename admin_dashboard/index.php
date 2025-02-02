<?php require_once('../templates/admin_header.php');

?>


        <!-- Content -->
        <div class="container mt-4">
            <!-- Metrics Section -->
            <div class="row mb-4">
                <div class="col-md-3">
                    <div class="card card-custom p-3">
                        <h6>Total Users</h6>
                        <h4>1,230</h4>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card card-custom p-3">
                        <h6>Active Sessions</h6>
                        <h4>850</h4>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card card-custom p-3">
                        <h6>New Signups</h6>
                        <h4>123</h4>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card card-custom p-3">
                        <h6>Revenue</h6>
                        <h4>$8,530</h4>
                    </div>
                </div>
            </div>

            <!-- Table Section -->
            <div class="card card-custom p-3 mb-4">
                <h5 class="mb-3">Recent Users</h5>
                <table class="table table-custom">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>John Doe</td>
                            <td>john.doe@example.com</td>
                            <td>Admin</td>
                            <td>Active</td>
                        </tr>
                        <tr>
                            <td>Jane Smith</td>
                            <td>jane.smith@example.com</td>
                            <td>Moderator</td>
                            <td>Inactive</td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <!-- Chart Section -->
            <div class="card card-custom p-3">
                <h5>Monthly Performance</h5>
                <canvas id="performanceChart" style="max-height: 400px;"></canvas>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Example Chart.js Integration
    const ctx = document.getElementById('performanceChart').getContext('2d');
    const performanceChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: ['January', 'February', 'March', 'April'],
            datasets: [{
                label: 'Revenue',
                data: [1200, 1900, 3000, 5000],
                borderColor: '#007bff',
                backgroundColor: 'rgba(0, 123, 255, 0.1)',
                fill: true,
                tension: 0.4
            }]
        },
        options: {
            responsive: true
        }
    });
</script>
</body>
</html>