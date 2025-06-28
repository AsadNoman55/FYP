<script type="text/javascript">
        var gk_isXlsx = false;
        var gk_xlsxFileLookup = {};
        var gk_fileData = {};
        function filledCell(cell) {
          return cell !== '' && cell != null;
        }
        function loadFileData(filename) {
        if (gk_isXlsx && gk_xlsxFileLookup[filename]) {
            try {
                var workbook = XLSX.read(gk_fileData[filename], { type: 'base64' });
                var firstSheetName = workbook.SheetNames[0];
                var worksheet = workbook.Sheets[firstSheetName];

                // Convert sheet to JSON to filter blank rows
                var jsonData = XLSX.utils.sheet_to_json(worksheet, { header: 1, blankrows: false, defval: '' });
                // Filter out blank rows (rows where all cells are empty, null, or undefined)
                var filteredData = jsonData.filter(row => row.some(filledCell));

                // Heuristic to find the header row by ignoring rows with fewer filled cells than the next row
                var headerRowIndex = filteredData.findIndex((row, index) =>
                  row.filter(filledCell).length >= filteredData[index + 1]?.filter(filledCell).length
                );
                // Fallback
                if (headerRowIndex === -1 || headerRowIndex > 25) {
                  headerRowIndex = 0;
                }

                // Convert filtered JSON back to CSV
                var csv = XLSX.utils.aoa_to_sheet(filteredData.slice(headerRowIndex)); // Create a new sheet from filtered array of arrays
                csv = XLSX.utils.sheet_to_csv(csv, { header: 1 });
                return csv;
            } catch (e) {
                console.error(e);
                return "";
            }
        }
        return gk_fileData[filename] || "";
        }
        </script><?php
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
    <title>Manage Appointments - StyleSync</title>
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
                <li><a href="admin_appointments.php" class="active">Appointments</a></li>
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
            <h1>Manage Appointments</h1>
        </section>

        <section class="admin-content">
            <div class="filter-controls">
                <div class="filter-group">
                    <label for="branch-filter">Filter by Branch:</label>
                    <select id="branch-filter">
                        <option value="">All Branches</option>
                    </select>
                </div>
                <div class="filter-group">
                    <label for="service-filter">Filter by Service:</label>
                    <select id="service-filter" disabled>
                        <option value="">All Services</option>
                    </select>
                </div>
                <div class="filter-group">
                    <label for="employee-filter">Filter by Employee:</label>
                    <select id="employee-filter" disabled>
                        <option value="">All Employees</option>
                    </select>
                </div>
                <div class="filter-group">
                    <label for="status-filter">Filter by Status:</label>
                    <select id="status-filter">
                        <option value="">All Statuses</option>
                        <option value="pending">Pending</option>
                        <option value="confirmed">Confirmed</option>
                        <option value="completed">Completed</option>
                        <option value="cancelled">Cancelled</option>
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
                <table class="data-table" id="appointments-table">
                    <thead>
                        <tr>
                            <th>Username</th>
                            <th>Service</th>
                            <th>Employee</th>
                            <th>Date</th>
                            <th>Time</th>
                            <th>Total Bill (Rs)</th>
                            <th>Service Status</th>
                            <th>Payment Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Appointments will be loaded dynamically -->
                    </tbody>
                </table>
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
            <p>© 2025 StyleSync. All Rights Reserved.</p>
        </div>
    </footer>

    <script src="js/script.js"></script>
    <script src="js/admin_appointments.js"></script>
</body>
</html>