<?php
/**
 * Test Database Connection and Admin User
 * Run this file to check if database and admin user exist
 */

error_reporting(E_ALL);
ini_set('display_errors', 1);

echo "<h2>Database Connection Test</h2>";

// Test database connection
require_once __DIR__ . '/config/db.php';

try {
    echo "<p style='color: green;'>✅ Database connection successful!</p>";
    
    // Check if database exists
    $stmt = $conn->query("SELECT DATABASE()");
    $dbName = $stmt->fetchColumn();
    echo "<p>Connected to database: <strong>$dbName</strong></p>";
    
    // Check if users table exists
    $stmt = $conn->query("SHOW TABLES LIKE 'users'");
    if ($stmt->rowCount() > 0) {
        echo "<p style='color: green;'>✅ Users table exists</p>";
        
        // Check if admin user exists
        $stmt = $conn->prepare("SELECT id, username, email, password, role FROM users WHERE username = ? OR email = ?");
        $stmt->execute(['admin', 'admin']);
        $user = $stmt->fetch();
        
        if ($user) {
            echo "<p style='color: green;'>✅ Admin user found!</p>";
            echo "<pre>";
            echo "ID: " . $user['id'] . "\n";
            echo "Username: " . $user['username'] . "\n";
            echo "Email: " . $user['email'] . "\n";
            echo "Role: " . $user['role'] . "\n";
            echo "Password Hash: " . substr($user['password'], 0, 20) . "...\n";
            echo "</pre>";
            
            // Test password verification
            $testPassword = 'admin123';
            if (password_verify($testPassword, $user['password'])) {
                echo "<p style='color: green; font-weight: bold;'>✅ Password 'admin123' is CORRECT!</p>";
            } else {
                echo "<p style='color: red; font-weight: bold;'>❌ Password 'admin123' does NOT match!</p>";
                echo "<p>This means the password hash in database doesn't match 'admin123'</p>";
            }
        } else {
            echo "<p style='color: red;'>❌ Admin user NOT found in database!</p>";
            echo "<p>You need to import the database.sql file</p>";
        }
        
        // Show all users
        $stmt = $conn->query("SELECT id, username, email, role FROM users");
        $allUsers = $stmt->fetchAll();
        echo "<h3>All Users in Database:</h3>";
        echo "<table border='1' cellpadding='5'>";
        echo "<tr><th>ID</th><th>Username</th><th>Email</th><th>Role</th></tr>";
        foreach ($allUsers as $u) {
            echo "<tr>";
            echo "<td>" . $u['id'] . "</td>";
            echo "<td>" . $u['username'] . "</td>";
            echo "<td>" . $u['email'] . "</td>";
            echo "<td>" . $u['role'] . "</td>";
            echo "</tr>";
        }
        echo "</table>";
        
    } else {
        echo "<p style='color: red;'>❌ Users table does NOT exist!</p>";
        echo "<p>You need to import the database.sql file</p>";
    }
    
} catch (PDOException $e) {
    echo "<p style='color: red;'>❌ Database Error: " . $e->getMessage() . "</p>";
    echo "<p>Check your database configuration in config/db.php</p>";
}

echo "<hr>";
echo "<h3>Configuration Check:</h3>";
echo "<pre>";
echo "DB_HOST: " . DB_HOST . "\n";
echo "DB_USER: " . DB_USER . "\n";
echo "DB_PASS: " . (empty(DB_PASS) ? '(empty)' : '***') . "\n";
echo "DB_NAME: " . DB_NAME . "\n";
echo "</pre>";

?>

