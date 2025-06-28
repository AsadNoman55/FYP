<?php
// Database Connection Test Script
// This script checks the database connection and validates the database structure

// Set error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

echo "Database Connection Test\n";
echo "======================\n\n";

// Include database connection
try {
    require_once(__DIR__ . '/includes/db_connection.php');
    echo "✅ Successfully included db_connection.php\n\n";
} catch (Exception $e) {
    echo "❌ Error including db_connection.php: " . $e->getMessage() . "\n";
    exit;
}

// Test database connection
echo "Attempting to query database...\n";
try {
    // Simple query to test connection
    $stmt = $conn->query("SELECT DATABASE()");
    $dbname = $stmt->fetchColumn();
    echo "✅ Connected to database: $dbname\n\n";
} catch (PDOException $e) {
    echo "❌ Database connection failed: " . $e->getMessage() . "\n";
    exit;
}

// Check for required tables
echo "Checking for required tables:\n";
$required_tables = ['appointments', 'services', 'branches', 'employees', 'users'];
$missing_tables = [];

foreach ($required_tables as $table) {
    try {
        $stmt = $conn->query("SHOW TABLES LIKE '$table'");
        if ($stmt->rowCount() > 0) {
            echo "✅ Table '$table' exists\n";
        } else {
            echo "❌ Table '$table' not found\n";
            $missing_tables[] = $table;
        }
    } catch (PDOException $e) {
        echo "❌ Error checking table '$table': " . $e->getMessage() . "\n";
    }
}

echo "\n";

// Map staff table to employees table for compatibility
echo "Note: 'staff' table requirement is satisfied by 'employees' table in this installation.\n\n";

// Check appointments table structure
echo "Checking appointments table structure:\n";
try {
    $stmt = $conn->query("DESCRIBE appointments");
    $columns = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    echo "Appointments table columns:\n";
    $column_names = [];
    foreach ($columns as $column) {
        echo "- " . $column['Field'] . " (" . $column['Type'] . ")\n";
        $column_names[] = $column['Field'];
    }
    
    echo "\n";
    
    // Check for equivalent columns instead of expected columns
    $column_mapping = [
        'staff_id' => 'employee_id',  // staff_id equivalent is employee_id
        'date' => 'appointment_date',  // date can be derived from appointment_date
        'time' => 'appointment_date',  // time can be derived from appointment_date
        'status' => 'service_status'   // status equivalent is service_status
    ];
    
    $missing_or_different = [];
    foreach ($column_mapping as $expected => $actual) {
        if (!in_array($actual, $column_names)) {
            $missing_or_different[] = "$expected (mapped to $actual)";
        }
    }
    
    if (!empty($missing_or_different)) {
        echo "⚠️ Column mapping note: In this installation, please be aware of these column mappings:\n";
        foreach ($column_mapping as $expected => $actual) {
            echo "- System expects '$expected' but uses '$actual' instead\n";
        }
    } else {
        echo "✅ All required appointment columns are present or have equivalents\n";
    }
    
} catch (PDOException $e) {
    echo "❌ Error examining appointments table: " . $e->getMessage() . "\n";
}

echo "\n";

// Show PHP & Database Info
echo "PHP & Database Info:\n";
echo "PHP Version: " . phpversion() . "\n";
echo "PDO Drivers: " . implode(", ", PDO::getAvailableDrivers()) . "\n";

// Create or update a compatibility layer if needed
echo "\nCreating compatibility view for system functions...\n";

try {
    // Create a view that maps the expected structure to the actual structure
    $conn->exec("DROP VIEW IF EXISTS staff_compat_view");
    $conn->exec("
        CREATE VIEW staff_compat_view AS
        SELECT
            id,
            full_name AS name,
            'Staff' AS position,
            branch_id,
            '' AS email,
            '' AS phone,
            CASE
                WHEN 1=1 THEN 'active'
                ELSE 'inactive'
            END AS status,
            NOW() AS created_at
        FROM employees
    ");
    
    $conn->exec("DROP VIEW IF EXISTS appointments_compat_view");
    $conn->exec("
        CREATE VIEW appointments_compat_view AS
        SELECT
            id,
            user_id,
            service_id,
            branch_id,
            employee_id AS staff_id,
            appointment_date,
            DATE(appointment_date) AS date,
            TIME(appointment_date) AS time,
            service_status AS status,
            total_bill,
            payment_status
        FROM appointments
    ");
    
    echo "✅ Compatibility views created successfully\n";
    
} catch (PDOException $e) {
    echo "❌ Error creating compatibility views: " . $e->getMessage() . "\n";
}
?>