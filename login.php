<?php
// Add this at the very top of your file
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Initialize session

// login.php - User/Admin Login Page 
// Initialize session
session_start();

// Database connection
$db_host = "localhost";
$db_user = "root";
$db_pass = "";
$db_name = "stylesync_db";

$conn = new mysqli($db_host, $db_user, $db_pass, $db_name);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Initialize error message variable
$error_message = "";

// Process User Login
if (isset($_POST['user_login'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];
    
    // Validate input
    if (empty($email) || empty($password)) {
        $error_message = "Please fill in all fields";
    } else {
        // Retrieve user from database
        $sql = "SELECT id, full_name, email, password FROM users WHERE email = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if ($result->num_rows == 1) {
            $user = $result->fetch_assoc();
            // Verify password
            if (password_verify($password, $user['password'])) {
                // Password is correct, create session
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['user_name'] = $user['full_name'];
                $_SESSION['user_email'] = $user['email'];
                $_SESSION['user_type'] = 'user';
                
                // Redirect to user dashboard
                header("Location: user_dashboard.php");
                exit();
            } else {
                $error_message = "Invalid email or password";
            }
        } else {
            $error_message = "Invalid email or password";
        }
        $stmt->close();
    }
}

// Process Admin Login
if (isset($_POST['admin_login'])) {
    // Temporary diagnostics at the top of your admin login section
    echo "<pre>";
    echo "Attempting login with username: " . $_POST['username'] . "\n";
    
    // Check if any admin with this username exists (regardless of role)
    $check_sql = "SELECT full_name, role FROM users WHERE full_name = ?";
    $check_stmt = $conn->prepare($check_sql);
    $check_stmt->bind_param("s", $_POST['username']);
    $check_stmt->execute();
    $check_result = $check_stmt->get_result();
    
    if ($check_result->num_rows > 0) {
        echo "User found in database. Roles: \n";
        while ($row = $check_result->fetch_assoc()) {
            echo "- " . $row['role'] . "\n";
        }
    } else {
        echo "No user found with this username.\n";
    }
    $check_stmt->close();
    echo "</pre>";
    
    // Continue with your normal login logic...
    $username = $_POST['username'];
    $password = $_POST['password'];
    
    // Validate input
    if (empty($username) || empty($password)) {
        $error_message = "Please fill in all fields";
    } else {
        // Retrieve admin from users table where role is 'admin'
        $sql = "SELECT id, full_name, email, password FROM users WHERE full_name = ? AND role = 'super_admin' OR role = 'branch_admin'";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $username); // Using full_name as username for admins
        $stmt->execute();
        $result = $stmt->get_result();
        
        if ($result->num_rows == 1) {
            $admin = $result->fetch_assoc();
            // Verify password
            if (password_verify($password, $admin['password'])) {
                // Password is correct, create session
                $_SESSION['admin_id'] = $admin['id'];
                $_SESSION['admin_name'] = $admin['full_name'];
                $_SESSION['admin_email'] = $admin['email'];
                $_SESSION['user_type'] = 'admin';
                $_SESSION['admin_role'] = $admin['role'];
                
                // Redirect to admin dashboard
                header("Location: admin_dashboard.php");
                exit();
            } else {
                $error_message = "Invalid username or password";
            }
        } else {
            $error_message = "Invalid username or password";
        }
        $stmt->close();
    }
}

$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - StyleSync</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <header>
        <nav class="navbar">
            <div class="logo">
                <h1>StyleSync</h1>
            </div>
            <ul class="nav-menu">
                <li><a href="index.html">Home</a></li>
                <li><a href="services.html">Services</a></li>
                <li><a href="branches.html">Our Branches</a></li>
                <li><a href="about.html">About Us</a></li>
                <li><a href="contact.html">Contact</a></li>
                <li><a href="login.php" class="active login-btn">Login</a></li>
                <li><a href="register.php" class="register-btn">Register</a></li>
            </ul>
            <div class="hamburger">
                <span class="bar"></span>
                <span class="bar"></span>
                <span class="bar"></span>
            </div>
        </nav>
    </header>

    <main>
        <section class="auth-section">
            <div class="auth-container">
                <h2>Login to Your Account</h2>
                
                <?php if (!empty($error_message)): ?>
                <div class="error-message">
                    <?php echo $error_message; ?>
                </div>
                <?php endif; ?>
                
                <div class="tab-container">
                    <div class="tabs">
                        <button class="tab-btn active" data-target="user-login">User</button>
                        <button class="tab-btn" data-target="admin-login">Admin</button>
                    </div>
                    
                    <div id="user-login" class="tab-content active">
                        <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" class="auth-form">
                            <div class="form-group">
                                <label for="user-email">Email</label>
                                <input type="email" id="user-email" name="email" required>
                            </div>
                            <div class="form-group">
                                <label for="user-password">Password</label>
                                <input type="password" id="user-password" name="password" required>
                            </div>
                            <button type="submit" name="user_login" class="submit-btn">Login</button>
                        </form>
                        <p class="auth-redirect">Don't have an account? <a href="register.php">Register</a></p>
                    </div>
                    
                    <div id="admin-login" class="tab-content">
                        <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" class="auth-form">
                            <div class="form-group">
                                <label for="admin-username">Username</label>
                                <input type="text" id="admin-username" name="username" required>
                            </div>
                            <div class="form-group">
                                <label for="admin-password">Password</label>
                                <input type="password" id="admin-password" name="password" required>
                            </div>
                            <button type="submit" name="admin_login" class="submit-btn">Login</button>
                        </form>
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
                    <li><a href="index.html">Home</a></li>
                    <li><a href="services.html">Services</a></li>
                    <li><a href="branches.html">Branches</a></li>
                    <li><a href="about.html">About Us</a></li>
                    <li><a href="contact.html">Contact</a></li>
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
    <script src="js/auth.js"></script>
    <script>
        // Override the event listeners in auth.js
        document.addEventListener('DOMContentLoaded', function() {
        const userLoginForm = document.querySelector('#user-login form');
        if (userLoginForm) {
            userLoginForm.removeEventListener('submit', function(){});
        }
    
        const adminLoginForm = document.querySelector('#admin-login form');
        if (adminLoginForm) {
            adminLoginForm.removeEventListener('submit', function(){});
        }
    });
    </script>
    <!-- Add this right before the closing </body> tag in login.php -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Get the forms
    const userLoginForm = document.querySelector('#user-login form');
    const adminLoginForm = document.querySelector('#admin-login form');
    
    // Remove any existing event listeners and add new ones
    if (userLoginForm) {
        const clonedForm = userLoginForm.cloneNode(true);
        userLoginForm.parentNode.replaceChild(clonedForm, userLoginForm);
    }
    
    if (adminLoginForm) {
        const clonedForm = adminLoginForm.cloneNode(true);
        adminLoginForm.parentNode.replaceChild(clonedForm, adminLoginForm);
    }
});
</script>
</body>
</html>