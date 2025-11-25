<?php
/**
 * Fix Admin Password
 * This script will update the admin password to 'admin123'
 */

require_once __DIR__ . '/config/config.php';

echo "<h2>Fixing Admin Password</h2>";

try {
    // Generate new password hash for 'admin123'
    $newPassword = 'admin123';
    $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);
    
    echo "<p>New password hash generated: " . substr($hashedPassword, 0, 30) . "...</p>";
    
    // Update admin user password
    $stmt = $conn->prepare("UPDATE users SET password = ? WHERE username = 'admin'");
    $stmt->execute([$hashedPassword]);
    
    if ($stmt->rowCount() > 0) {
        echo "<p style='color: green; font-weight: bold; font-size: 18px;'>✅ Password updated successfully!</p>";
        echo "<p>You can now login with:</p>";
        echo "<ul>";
        echo "<li><strong>Username:</strong> admin</li>";
        echo "<li><strong>Password:</strong> admin123</li>";
        echo "</ul>";
        
        // Verify the password works
        $stmt = $conn->prepare("SELECT password FROM users WHERE username = 'admin'");
        $stmt->execute();
        $user = $stmt->fetch();
        
        if (password_verify($newPassword, $user['password'])) {
            echo "<p style='color: green;'>✅ Password verification successful!</p>";
        } else {
            echo "<p style='color: red;'>❌ Password verification failed!</p>";
        }
        
    } else {
        echo "<p style='color: red;'>❌ No user updated. Admin user might not exist.</p>";
    }
    
} catch (PDOException $e) {
    echo "<p style='color: red;'>❌ Error: " . $e->getMessage() . "</p>";
}

echo "<hr>";
echo "<p><a href='login.php'>Go to Login Page</a></p>";

?>

