<!-- user-dashboard.php - User Dashboard -->
<?php
session_start();
if (!isset($_SESSION['user_id'])) {
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
    <title>Dashboard - StyleSync</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/dashboard.css">
    <link rel="stylesheet" href="css/user_appointments.css">
    <link rel="stylesheet" href="css/featured_services.css">
</head>
<body>
    <header>
        <nav class="navbar">
            <div class="logo">
                <h1>StyleSync</h1>
            </div>
            <ul class="nav-menu">
                <li><a href="user_dashboard.php" class="active">Dashboard</a></li>
                <li><a href="book_appointment.php">Book Appointment</a></li>
                <li><a href="my_appointments.php">My Appointments</a></li>
                <li><a href="profile.php">Profile</a></li>
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
        <section class="dashboard-header" id="dashboard-headercolor">
            <h1>Welcome, <?php echo $_SESSION['user_name']; ?>!</h1>
        </section>

        <section class="dashboard-content">
            <div class="dashboard-cards">
                <div class="dashboard-card">
                    <h3>Upcoming Appointments</h3>
                    <p class="card-value" id="upcoming-count">0</p>
                    <a href="my_appointments.php" class="card-link">View All</a>
                </div>
                <div class="dashboard-card">
                    <h3>Completed Appointments</h3>
                    <p class="card-value" id="completed-count">0</p>
                    <a href="my_appointments.php" class="card-link">View History</a>
                </div>
                <div class="dashboard-card">
                    <h3>Quick Book</h3>
                    <p>Book your next appointment now</p>
                    <a href="book_appointment.php" class="card-link">Book Now</a>
                </div>
            </div>

            <div class="dashboard-sections">
                <div class="dashboard-section">
                    <h2>Upcoming Appointments</h2>
                    <div class="appointments-container" id="upcoming-appointments">
                        <!-- Appointments will be loaded dynamically -->
                        <p class="no-data-message">No upcoming appointments.</p>
                    </div>
                </div>
                <!--<div class="featured-services-section">
                    <h2>Featured Services</h2>
                    <div class="featured-services-list" id="featured-services-content">-->
                        <!-- Services will be loaded dynamically 
                    </div>
                </div>-->
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
                    <li><a href="user_dashboard.php">Dashboard</a></li>
                    <li><a href="book_appointment.php">Book Appointment</a></li>
                    <li><a href="my_appointments.php">My Appointments</a></li>
                    <li><a href="profile.php">Profile</a></li>
                </ul>
            </div>
            <div class="footer-contact">
                <h3>Contact Us</h3>
                <p>Email: info@stylesync.com</p>
                <p>Phone: +92-300000000</p>
            </div>
        </div>
        <div class="footer-bottom">
            <p>&copy; 2025 StyleSync. All Rights Reserved.</p>
        </div>
    </footer>

    <script src="js/script.js"></script>
    <script src="js/dashboard.js"></script>
</body>
</html>