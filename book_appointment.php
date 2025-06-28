<!-- book-appointment.php - Book Appointment Page -->
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
    <title>Book Appointment - StyleSync</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/booking.css">
</head>
<body>
    <header>
        <nav class="navbar">
            <div class="logo">
                <h1>StyleSync</h1>
            </div>
            <ul class="nav-menu">
                <li><a href="user_dashboard.php">Dashboard</a></li>
                <li><a href="book_appointment.php" class="active">Book Appointment</a></li>
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
        <section class="booking-section">
            <h1>Book an Appointment</h1>
            <div class="booking-container">
                <div class="booking-progress">
                    <div class="progress-step active" data-step="1">
                        <div class="step-number">1</div>
                        <div class="step-label">Select Branch</div>
                    </div>
                    <div class="progress-step" data-step="2">
                        <div class="step-number">2</div>
                        <div class="step-label">Select Service</div>
                    </div>
                    <div class="progress-step" data-step="3">
                        <div class="step-number">3</div>
                        <div class="step-label">Select Staff</div>
                    </div>
                    <div class="progress-step" data-step="4">
                        <div class="step-number">4</div>
                        <div class="step-label">Select Date & Time</div>
                    </div>
                    <div class="progress-step" data-step="5">
                        <div class="step-number">5</div>
                        <div class="step-label">Confirm & Pay</div>
                    </div>
                </div>

                <div class="booking-steps">
                    <!-- Step 1: Select Branch -->
                    <div class="booking-step active" id="step-1">
                        <h2>Select a Branch</h2>
                        <div class="branch-selection" id="branch-container">
                            <!-- Sample Branch Card (Loaded Dynamically) -->
                            <div class="branch-card" data-branch-id="1">
                                <h3>Main Street Branch</h3>
                                <p class="branch-address">123 Main St, Cityville</p>
                                <div class="branch-detail">
                                    <i class="fas fa-phone"></i>
                                    <span class="branch-phone">+92-300-1234567</span>
                                </div>
                                <div class="branch-detail">
                                    <i class="fas fa-star"></i>
                                    <span class="branch-rating">4.8/5 (120 Reviews)</span>
                                </div>
                            </div>
                            <!-- Additional branch cards will be loaded dynamically -->
                        </div>
                        <div class="step-actions">
                            <button class="next-step" data-next="2">Next</button>
                        </div>
                    </div>

                    <!-- Step 2: Select Service -->
                    <div class="booking-step" id="step-2">
                        <h2>Select a Service</h2>
                        <div class="service-selection" id="service-container">
                            <!-- Sample Service Card (Loaded Dynamically) -->
                            <div class="service-card" data-service-id="1">
                                <h3>Haircut & Styling</h3>
                                <p class="service-description">Professional haircut with personalized styling</p>
                                <div class="service-detail">
                                    <i class="fas fa-clock"></i>
                                    <span class="service-duration">45 mins</span>
                                </div>
                                <div class="service-detail">
                                    <i class="fas fa-tag"></i>
                                    <span class="service-price">$25.00</span>
                                </div>
                            </div>
                            <!-- Additional service cards will be loaded dynamically -->
                        </div>
                        <div class="step-actions">
                            <button class="prev-step" data-prev="1">Previous</button>
                            <button class="next-step" data-next="3">Next</button>
                        </div>
                    </div>

                    <!-- Step 3: Select Staff -->
                    <div class="booking-step" id="step-3">
                        <h2>Select a Staff Member</h2>
                        <div class="staff-selection" id="staff-container">
                            <!-- Sample Staff Card (Loaded Dynamically) -->
                            <div class="staff-card" data-staff-id="1">
                                <h3>Jane Doe</h3>
                                <div class="staff-detail">
                                    <i class="fas fa-venus-mars"></i>
                                    <span class="staff-gender">Female</span>
                                </div>
                                <div class="staff-detail">
                                    <i class="fas fa-briefcase"></i>
                                    <span class="staff-experience">5 Years</span>
                                </div>
                                <div class="staff-detail">
                                    <i class="fas fa-calendar-check"></i>
                                    <span class="staff-bookings">150+ Bookings</span>
                                </div>
                            </div>
                            <!-- Additional staff cards will be loaded dynamically -->
                        </div>
                        <div class="step-actions">
                            <button class="prev-step" data-prev="2">Previous</button>
                            <button class="next-step" data-next="4">Next</button>
                        </div>
                    </div>

                    <!-- Step 4: Select Date & Time -->
                    <div class="booking-step" id="step-4">
                        <h2>Select Date & Time</h2>
                        <div class="datetime-selection">
                            <!-- Date Picker Section -->
                            <div class="date-picker">
                                <h3>Select Date</h3>
                                <div id="booking-calendar">
                                    <!-- Calendar will be initialized dynamically -->
                                </div>
                            </div>
                            
                            <!-- Time Picker Section -->
                            <div class="time-picker">
                                <h3>Select Time</h3>
                                <div class="time-slots" id="time-slots">
                                    <!-- Time slots will be loaded dynamically -->
                                </div>
                            </div>
                        </div>
                        <div class="step-actions">
                            <button class="prev-step" data-prev="3">Previous</button>
                            <button class="next-step" data-next="5">Next</button>
                        </div>
                    </div>

                    <!-- Step 5: Confirm & Pay -->
                    <div class="booking-step" id="step-5">
                        <h2>Confirm & Pay</h2>
                        <div class="booking-summary">
                            <h3>Booking Summary</h3>
                            <div class="summary-details">
                                <div class="summary-item">
                                    <span>Branch:</span>
                                    <span id="summary-branch"></span>
                                </div>
                                <div class="summary-item">
                                    <span>Service:</span>
                                    <span id="summary-service"></span>
                                </div>
                                <div class="summary-item">
                                    <span>Staff:</span>
                                    <span id="summary-staff"></span>
                                </div>
                                <div class="summary-item">
                                    <span>Date:</span>
                                    <span id="summary-date"></span>
                                </div>
                                <div class="summary-item">
                                    <span>Time:</span>
                                    <span id="summary-time"></span>
                                </div>
                                <div class="summary-item total">
                                    <span>Total:</span>
                                    <span id="summary-price"></span>
                                </div>
                                <div class="summary-item discount">
                                    <span>Discount:</span>
                                    <span id="summary-discount">0%</span>
                                </div>
                                <div class="summary-item final-price">
                                    <span>Final Price:</span>
                                    <span id="summary-final-price"></span>
                                </div>
                            </div>
                        </div>
                        <div class="payment-options">
                            <h3>Payment Options</h3>
                            <div class="payment-methods">
                                <label class="payment-method">
                                    <input type="radio" name="payment" value="online" checked>
                                    <span>Pay Online</span>
                                </label>
                                <label class="payment-method">
                                    <input type="radio" name="payment" value="at-venue">
                                    <span>Pay at Venue</span>
                                </label>
                            </div>
                        </div>
                        <div class="step-actions">
                            <button class="prev-step" data-prev="4">Previous</button>
                            <button class="confirm-booking" id="confirm-booking">Confirm Booking</button>
                        </div>
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
            <p>© 2025 StyleSync. All Rights Reserved.</p>
        </div>
    </footer>

    <!-- Branch Selection Confirmation Modal -->
    <div id="branch-modal" class="modal">
        <div class="modal-content">
            <h2>Confirm Selection</h2>
            <p></p>
            <div class="form-actions">
                <button class="cancel-btn close-modal">OK</button>
            </div>
        </div>
    </div>

    <!-- Service Selection Confirmation Modal -->
    <div id="service-modal" class="modal">
        <div class="modal-content">
            <h2>Confirm Selection</h2>
            <p></p>
            <div class="form-actions">
                <button class="cancel-btn close-modal">OK</button>
            </div>
        </div>
    </div>

    <!-- Staff Selection Confirmation Modal -->
    <div id="staff-modal" class="modal">
        <div class="modal-content">
            <h2>Confirm Selection</h2>
            <p></p>
            <div class="form-actions">
                <button class="cancel-btn close-modal">OK</button>
            </div>
        </div>
    </div>

    <!-- Date & Time Selection Confirmation Modal -->
    <div id="datetime-modal" class="modal">
        <div class="modal-content">
            <h2>Confirm Selection</h2>
            <p></p>
            <div class="form-actions">
                <button class="cancel-btn close-modal">OK</button>
            </div>
        </div>
    </div>

    <!-- Payment Selection Confirmation Modal -->
    <div id="payment-modal" class="modal">
        <div class="modal-content">
            <h2>Confirm Selection</h2>
            <p></p>
            <div class="form-actions">
                <button class="cancel-btn close-modal">OK</button>
            </div>
        </div>
    </div>

    <!-- Error Modal -->
    <div id="error-modal" class="modal">
        <div class="modal-content">
            <h2>Error</h2>
            <p></p>
            <div class="form-actions">
                <button class="cancel-btn close-modal">OK</button>
            </div>
        </div>
    </div>

    <!-- Success Modal -->
    <div id="success-modal" class="modal">
        <div class="modal-content">
            <h2>Success</h2>
            <p></p>
            <div class="form-actions">
                <button class="cancel-btn close-modal">OK</button>
            </div>
        </div>
    </div>

    <script src="js/script.js"></script>
    <script src="js/booking.js"></script>
</body>
</html>