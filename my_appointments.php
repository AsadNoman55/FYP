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
    <title>My Appointments - StyleSync</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/user_appointments.css">
    <link rel="stylesheet" href="css/admin.css">
</head>
<body>
    <header>
        <nav class="navbar">
            <div class="logo">
                <h1>StyleSync</h1>
            </div>
            <ul class="nav-menu">
                <li><a href="user_dashboard.php">Dashboard</a></li>
                <li><a href="book_appointment.php">Book Appointment</a></li>
                <li><a href="user_appointments.php" class="active">My Appointments</a></li>
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
        <section class="user-header">
            <h1>My Appointments</h1>
            <div class="appointment-stats">
                <div class="stat-card upcoming">
                    <i class="fas fa-calendar-alt"></i>
                    <div class="stat-content">
                        <h3>Upcoming</h3>
                        <p id="upcoming-count">0</p>
                    </div>
                </div>
                <div class="stat-card completed">
                    <i class="fas fa-check-circle"></i>
                    <div class="stat-content">
                        <h3>Completed</h3>
                        <p id="completed-count">0</p>
                    </div>
                </div>
                <div class="stat-card cancelled">
                    <i class="fas fa-times-circle"></i>
                    <div class="stat-content">
                        <h3>Cancelled</h3>
                        <p id="cancelled-count">0</p>
                    </div>
                </div>
            </div>
        </section>

        <section class="next-appointment-section">
            <h2>Your Next Appointment</h2>
            <div id="next-appointment-container">
                <!-- Next appointment will be loaded dynamically -->
                <div class="placeholder-message">
                    <p>No upcoming appointments</p>
                    <a href="book_appointment.php" class="book-now-btn">Book Now</a>
                </div>
            </div>
        </section>

        <section class="appointments-content">
            <div class="filter-controls">
                <div class="filter-group">
                    <label for="date-range">Date Range:</label>
                    <select id="date-range">
                        <option value="all">All Time</option>
                        <option value="next7" selected>Next 7 Days</option>
                        <option value="next30">Next 30 Days</option>
                        <option value="past30">Past 30 Days</option>
                        <option value="past90">Past 90 Days</option>
                        <option value="custom">Custom Range</option>
                    </select>
                </div>
                <div class="filter-group date-inputs" style="display: none;">
                    <label for="date-from">From:</label>
                    <input type="date" id="date-from">
                    <label for="date-to">To:</label>
                    <input type="date" id="date-to">
                    <button id="apply-date-filter" class="btn">Apply</button>
                </div>
                <div class="filter-group">
                    <label for="status-filter">Status:</label>
                    <select id="status-filter">
                        <option value="">All Status</option>
                        <option value="pending">Pending</option>
                        <option value="confirmed">Confirmed</option>
                        <option value="completed">Completed</option>
                        <option value="cancelled">Cancelled</option>
                    </select>
                </div>
                <div class="filter-group">
                    <label for="service-filter">Service:</label>
                    <select id="service-filter">
                        <option value="">All Services</option>
                        <!-- Services will be loaded dynamically -->
                    </select>
                </div>
                <div class="search-box">
                    <input type="text" id="search-input" placeholder="Search appointments...">
                    <button id="search-btn"><i class="fas fa-search"></i></button>
                </div>
            </div>

            <div class="appointments-container">
                <div class="appointments-list" id="appointments-list">
                    <!-- Appointments will be loaded dynamically -->
                </div>
                <div class="pagination">
                    <button id="prev-page" disabled><i class="fas fa-chevron-left"></i></button>
                    <span id="page-info">Page 1 of 1</span>
                    <button id="next-page" disabled><i class="fas fa-chevron-right"></i></button>
                </div>
            </div>
        </section>
    </main>

    <!-- Reschedule Modal -->
    <div id="reschedule-modal" class="modal">
        <div class="modal-content">
            <span class="close-modal">&times;</span>
            <h2>Reschedule Appointment</h2>
            <form id="reschedule-form">
                <input type="hidden" id="appointment-id">
                <div class="form-group">
                    <label for="reschedule-date">Select Date:</label>
                    <input type="date" id="reschedule-date" required>
                </div>
                <div class="form-group">
                    <label for="reschedule-time">Select Time:</label>
                    <select id="reschedule-time" required>
                        <!-- Time slots will be populated dynamically -->
                    </select>
                </div>
                <div class="form-actions">
                    <button type="button" class="btn cancel-btn" id="cancel-reschedule">Cancel</button>
                    <button type="submit" class="btn confirm-btn">Confirm Reschedule</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Cancel Modal -->
    <div id="cancel-modal" class="modal">
        <div class="modal-content">
            <span class="close-modal">&times;</span>
            <h2>Cancel Appointment</h2>
            <p>Are you sure you want to cancel this appointment?</p>
            <div class="cancellation-policy">
                <h3>Cancellation Policy</h3>
                <ul>
                    <li>Cancellations made more than 24 hours in advance receive a full refund</li>
                    <li>Cancellations made less than 24 hours may incur a 50% charge</li>
                    <li>No-shows will be charged the full amount</li>
                </ul>
            </div>
            <div class="form-actions">
                <button class="btn cancel-btn" id="close-cancel-modal">No, Keep It</button>
                <button class="btn confirm-btn" id="confirm-cancel">Yes, Cancel Appointment</button>
            </div>
        </div>
    </div>

    <!-- Review Modal -->
    <div id="review-modal" class="modal">
        <div class="modal-content">
            <span class="close-modal">&times;</span>
            <h2>Rate Your Experience</h2>
            <form id="review-form">
                <input type="hidden" id="review-appointment-id">
                <div class="rating-container">
                    <div class="rating">
                        <input type="radio" name="rating" id="rating-5" value="5">
                        <label for="rating-5"></label>
                        <input type="radio" name="rating" id="rating-4" value="4">
                        <label for="rating-4"></label>
                        <input type="radio" name="rating" id="rating-3" value="3">
                        <label for="rating-3"></label>
                        <input type="radio" name="rating" id="rating-2" value="2">
                        <label for="rating-2"></label>
                        <input type="radio" name="rating" id="rating-1" value="1">
                        <label for="rating-1"></label>
                    </div>
                </div>
                <div class="form-group">
                    <label for="review-text">Your Feedback:</label>
                    <textarea id="review-text" rows="4" placeholder="Tell us about your experience..."></textarea>
                </div>
                <div class="form-actions">
                    <button type="button" class="btn cancel-btn" id="cancel-review">Cancel</button>
                    <button type="submit" class="btn confirm-btn">Submit Review</button>
                </div>
            </form>
        </div>
    </div>

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
                    <li><a href="user_appointments.php">My Appointments</a></li>
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
            <p>© 2025 StyleSync. All Rights Reserved.</p>
        </div>
    </footer>

    <script src="js/script.js"></script>
    <script src="js/user_appointments.js"></script>
</body>
</html>