<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f7f9fc;
        }
        .sidebar {
            height: 100vh;
            background-color: #343a40;
            color: #fff;
        }
        .sidebar a {
            color: #ddd;
            text-decoration: none;
            padding: 10px 20px;
            display: block;
        }
        .sidebar a:hover {
            background-color: #495057;
            color: #fff;
        }
        .navbar-custom {
            background-color: #fff;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        .card-custom {
            border: none;
            border-radius: 12px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        .table-custom thead {
            background-color: #e9ecef;
        }
    </style>
</head>
<body>
<div class="d-flex">
    <!-- Sidebar -->
    <nav class="sidebar d-flex flex-column p-3">
        <h4 class="mb-3">Admin Panel</h4>
        <a href="#">Dashboard</a>
        <a href="#">Users</a>
        <a href="#">Reports</a>
        <a href="#">Settings</a>
        <a href="../logout.php">Logout</a>
    </nav>

    <!-- Main Content -->
    <div class="flex-grow-1">
        <!-- Top Navbar -->
        <nav class="navbar navbar-expand-lg navbar-light navbar-custom px-4">
            <a class="navbar-brand" href="#">Admin Dashboard</a>
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link" href="#">Notifications</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Profile</a>
                </li>
            </ul>
        </nav>

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
