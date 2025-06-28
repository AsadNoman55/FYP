<!-- admin-branches.php - Branches Management -->
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
    <title>Manage Branches - StyleSync</title>
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
                <li><a href="admin_branches.php" class="active">Branches</a></li>
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
            <h1>Manage Branches</h1>
            <button id="add-branch-btn" class="add-btn">Add New Branch</button>
        </section>

        <section class="admin-content">
            <div class="table-container">
                <table class="data-table" id="branches-table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Branch Name</th>
                            <th>Address</th>
                            <th>City</th>
                            <th>Phone</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Branches will be loaded dynamically -->
                    </tbody>
                </table>
            </div>
        </section>

        <!-- Add/Edit Branch Modal -->
        <div id="branch-modal" class="modal">
            <div class="modal-content">
                <h2 id="modal-title">Add New Branch</h2>
                <form id="branch-form">
                    <input type="hidden" id="branch-id" name="branch_id">
                    <div class="form-group">
                        <label for="branch-name">Branch Name</label>
                        <input type="text" id="branch-name" name="branch_name" required>
                    </div>
                    <div class="form-group">
                        <label for="branch-address">Address</label>
                        <input type="text" id="branch-address" name="address" required>
                    </div>
                    <div class="form-group">
                        <label for="branch-city">City</label>
                        <input type="text" id="branch-city" name="city" required>
                    </div>
                    <div class="form-group">
                        <label for="branch-phone">Phone</label>
                        <input type="tel" id="branch-phone" name="phone" required>
                    </div>
                    <div class="form-group">
                        <label for="branch-status">Status</label>
                        <select id="branch-status" name="status">
                            <option value="active">Active</option>
                            <option value="inactive">Inactive</option>
                        </select>
                    </div>
                    <div class="form-actions">
                        <button class="cancel-btn close-modal">Cancel</button>
                        <button type="submit" class="submit-btn">Save</button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Delete Confirmation Modal -->
        <div id="delete-modal" class="modal">
            <div class="modal-content">
                <h2>Confirm Delete</h2>
                <p>Are you sure you want to delete this branch? This action cannot be undone.</p>
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
            <p>&copy; 2025 StyleSync. All Rights Reserved.</p>
        </div>
    </footer>

    <script src="js/script.js"></script>
    <script src="js/admin_branches.js"></script>
</body>
</html>