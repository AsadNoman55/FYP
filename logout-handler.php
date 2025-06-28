<?php
/**
 * Saloon Appointment System - Logout Handler
 * This file processes logout requests and provides the logout modal HTML
 */

// Process logout if confirmed
if (isset($_POST['confirm_logout'])) {
    // Destroy the session
    session_start();
    session_unset();
    session_destroy();
    
    // Clear any cookies
    if (isset($_COOKIE[session_name()])) {
        setcookie(session_name(), '', time() - 3600, '/');
    }
    
    // Redirect to login page
    header("Location: login.php");
    exit();
}
?>

<!-- Logout Modal Dialog -->
<div id="logoutModal" class="logout-modal">
    <div class="logout-modal-content">
        <h3 class="logout-modal-title">Confirm Logout</h3>
        <div class="logout-modal-body">
            <p>Are you sure you want to logout from the Saloon Appointment System?</p>
        </div>
        <div class="logout-modal-footer">
            <button id="cancelLogout" class="logout-cancel-btn">Cancel</button>
            <form method="POST" style="display: inline;">
                <input type="hidden" name="confirm_logout" value="1">
                <button type="submit" class="logout-confirm-btn">Logout</button>
            </form>
        </div>
    </div>
</div>
<!-- JavaScript for logout functionality is in logout.js -->