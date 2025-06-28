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
    <title>Manage Users - StyleSync</title>
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
                <li><a href="admin_dashboard.php">Dashboard</a></li>
                <li><a href="admin_branches.php">Branches</a></li>
                <li><a href="admin_services.php">Services</a></li>
                <li><a href="admin_staff.php">Staff</a></li>
                <li><a href="admin_appointments.php">Appointments</a></li>
                <li><a href="admin_users.php" class="active">Users</a></li>
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
            <h1>Manage Users</h1>
        </section>

        <section class="admin-content">
            <div class="filter-controls">
                <div class="filter-group">
                    <label for="search-bar">Search by Name/Email:</label>
                    <input type="text" id="search-bar" placeholder="Enter name or email">
                </div>
                <div class="filter-group">
                    <label for="role-filter">Filter by Role:</label>
                    <select id="role-filter">
                        <option value="">All Roles</option>
                        <option value="super_admin">Super Admin</option>
                        <option value="branch_admin">Branch Admin</option>
                        <option value="customer">Customer</option>
                    </select>
                </div>
                <div class="filter-group">
                    <label for="status-filter">Filter by Status:</label>
                    <select id="status-filter">
                        <option value="">All Statuses</option>
                        <option value="active">Active</option>
                        <option value="inactive">Inactive</option>
                    </select>
                </div>
                <div class="filter-group">
                    <label for="entries-filter">Show Entries:</label>
                    <select id="entries-filter">
                        <option value="10">10</option>
                        <option value="25">25</option>
                        <option value="50">50</option>
                        <option value="100">100</option>
                    </select>
                </div>
            </div>
            <div class="table-container">
                <table class="data-table" id="users-table">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Role</th>
                            <th>Bookings</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Users will be loaded dynamically -->
                    </tbody>
                </table>
            </div>
        </section>

        <!-- Delete Confirmation Modal -->
        <div id="delete-modal" class="modal">
            <div class="modal-content">
                <h2>Confirm Delete</h2>
                <p>Are you sure you want to delete this user? This action cannot be undone.</p>
                <div class="form-actions">
                    <button class="cancel-btn close-modal">Cancel</button>
                    <button id="confirm-delete" class="delete-btn">Delete</button>
                </div>
            </div>
        </div>
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
            <p>© 2025 StyleSync. All Rights Reserved.</p>
        </div>
    </footer>

    <script src="js/script.js"></script>
    <script src="js/admin_users.js"></script>
</body>
</html>