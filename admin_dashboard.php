<!-- admin-dashboard.php - Admin Dashboard -->
<?php
session_start();
if (!isset($_SESSION['admin_id'])) {
    header("Location: login.php");
    exit();
}
include('process/logout_handler.php');
require_once 'includes/db_connection.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - StyleSync</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/admin.css">
</head>
<body>
    <header>
        <nav class="navbar">
            <div class="logo">
                <h1>StyleSync</h1>
            </div>
            <ul class="nav-menu">
                <li><a href="admin_dashboard.php" class="active">Dashboard</a></li>
                <li><a href="admin_branches.php">Branches</a></li>
                <li><a href="admin_services.php">Services</a></li>
                <li><a href="admin_staff.php">Staff</a></li>
                <li><a href="admin_appointments.php">Appointments</a></li>
                <li><a href="admin_users.php">Users</a></li>
                <li><a href="process/logout.php" class="logout-btn">Logout</a></li>
            </ul>
            <div class="hamburger">
                <span class="bar"></span>
                <span class="bar"></span>
                <span class="bar"></span>
            </div>
        </nav>
    </header>

    <main>
        <section class="admin-header">
            <h1>Admin Dashboard</h1>
            <p class="admin-header-text">Welcome, <?php echo $_SESSION['admin_name']; ?>!</p>
        </section>

        <section class="dashboard-content">
            <div class="dashboard-cards">
                <div class="dashboard-card">
                    <h3>Total Branches</h3>
                    <p class="card-value" id="branch-count">0</p>
                    <a href="admin_branches.php" class="card-link">Manage Branches</a>
                </div>
                <div class="dashboard-card">
                    <h3>Total Services</h3>
                    <p class="card-value" id="service-count">0</p>
                    <a href="admin_services.php" class="card-link">Manage Services</a>
                </div>
                <div class="dashboard-card">
                    <h3>Total Staff</h3>
                    <p class="card-value" id="staff-count">0</p>
                    <a href="admin_staff.php" class="card-link">Manage Staff</a>
                </div>
                <div class="dashboard-card">
                    <h3>Total Appointments</h3>
                    <p class="card-value" id="appointment-count">0</p>
                    <a href="admin_appointments.php" class="card-link">Manage Appointments</a>
                </div>
            </div>

            <div class="dashboard-sections">
                <div class="dashboard-section">
                    <h2>Recent Appointments</h2>
                    <div class="table-container">
                        <table class="data-table" id="recent-appointments">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>User</th>
                                    <th>Branch</th>
                                    <th>Service</th>
                                    <th>Staff</th>
                                    <th>Date</th>
                                    <th>Time</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- Appointments will be loaded dynamically -->
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <footer>
        <div class="footer-content">
            <div class="footer-logo">
                <h2>StyleSync</h2>
                <p>Your beauty, our priority</p>
            </div>
            <div class="footer-links">
                <h3>Quick Links</h3>
                <ul>
                    <li><a href="admin_dashboard.php">Dashboard</a></li>
                    <li><a href="admin_branches.php">Branches</a></li>
                    <li><a href="admin_services.php">Services</a></li>
                    <li><a href="admin_staff.php">Staff</a></li>
                    <li><a href="admin_appointments.php">Appointments</a></li>
                </ul>
            </div>
            <div class="footer-contact">
                <h3>Contact Us</h3>
                <p>Email: admin@stylesync.com</p>
                <p>Phone: +92-300000000</p>
            </div>
        </div>
        <div class="footer-bottom">
            <p>&copy; 2025 StyleSync. All Rights Reserved.</p>
        </div>
    </footer>

    <script src="js/script.js"></script>
    <script src="js/admin_dashboard.js"></script>
</body>
</html>