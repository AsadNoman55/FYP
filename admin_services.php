<!-- admin-services.php - Services Management -->
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
    <title>Manage Services - StyleSync</title>
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
                <li><a href="admin_services.php" class="active">Services</a></li>
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
            <h1>Manage Services</h1>
            <button id="add-service-btn" class="add-btn">Add New Service</button>
        </section>

        <section class="admin-content">
            <div class="filter-controls">
                <div class="filter-group">
                    <label for="branch-filter">Filter by Branch:</label>
                    <select id="branch-filter">
                        <option value="">All Branches</option>
                        <!-- Branches will be loaded dynamically -->
                    </select>
                </div>
            </div>
            <div class="table-container">
                <table class="data-table" id="services-table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Service Name</th>
                            <th>Branch</th>
                            <th>Duration (min)</th>
                            <th>Price (Rs)</th>
                            <th>Peak Price (Rs)</th>
                            <th>Off-Peak Price (Rs)</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Services will be loaded dynamically -->
                    </tbody>
                </table>
            </div>
        </section>

        <!-- Add/Edit Service Modal -->
        <div id="service-modal" class="modal">
            <div class="modal-content">
                <h2 id="modal-title">Add New Service</h2>
                <form id="service-form">
                    <input type="hidden" id="service-id" name="service_id">
                    <div class="form-group">
                        <label for="service-name">Service Name</label>
                        <input type="text" id="service-name" name="service_name" required>
                    </div>
                    <div class="form-group">
                        <label for="service-branch">Branch</label>
                        <select id="service-branch" name="branch_id" required>
                            <!-- Branches will be loaded dynamically -->
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="service-description">Description</label>
                        <textarea id="service-description" name="description" rows="3"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="service-duration">Duration (minutes)</label>
                        <input type="number" id="service-duration" name="duration" min="5" step="5" required>
                    </div>
                    <div class="form-group">
                        <label for="service-price">Regular Price (Rs)</label>
                        <input type="number" id="service-price" name="price" min="0" step="0.01" required>
                    </div>
                    <div class="form-group">
                        <label for="service-peak-price">Peak Hour Price (Rs)</label>
                        <input type="number" id="service-peak-price" name="peak_price" min="0" step="0.01">
                    </div>
                    <div class="form-group">
                        <label for="service-offpeak-price">Off-Peak Hour Price (Rs)</label>
                        <input type="number" id="service-offpeak-price" name="offpeak_price" min="0" step="0.01">
                    </div>
                    <div class="form-group">
                        <label for="service-status">Status</label>
                        <select id="service-status" name="status">
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
                <p>Are you sure you want to delete this service? This action cannot be undone.</p>
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
    <script src="js/admin_services.js"></script>
</body>
</html>