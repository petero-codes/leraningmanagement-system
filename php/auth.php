<?php
/**
 * Authentication Functions
 * Handles user registration, login, and session management
 */

require_once __DIR__ . '/../config/config.php';

/**
 * Register a new user
 * @param string $username
 * @param string $email
 * @param string $password
 * @param string $role
 * @return array
 */
function registerUser($username, $email, $password, $role = 'staff') {
    global $conn;
    
    $errors = [];
    
    // Validation
    if (empty($username) || strlen($username) < 3) {
        $errors[] = "Username must be at least 3 characters long.";
    }
    
    if (empty($email) || !validateEmail($email)) {
        $errors[] = "Please provide a valid email address.";
    }
    
    if (empty($password) || strlen($password) < 6) {
        $errors[] = "Password must be at least 6 characters long.";
    }
    
    if (!empty($errors)) {
        return ['success' => false, 'errors' => $errors];
    }
    
    try {
        // Check if username exists
        $stmt = $conn->prepare("SELECT id FROM users WHERE username = ? OR email = ?");
        $stmt->execute([$username, $email]);
        if ($stmt->fetch()) {
            return ['success' => false, 'errors' => ['Username or email already exists.']];
        }
        
        // Hash password
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        
        // Insert user
        $stmt = $conn->prepare("INSERT INTO users (username, email, password, role) VALUES (?, ?, ?, ?)");
        $stmt->execute([$username, $email, $hashedPassword, $role]);
        
        return ['success' => true, 'message' => 'Registration successful. You can now login.'];
        
    } catch (PDOException $e) {
        error_log("Registration Error: " . $e->getMessage());
        return ['success' => false, 'errors' => ['Registration failed. Please try again.']];
    }
}

/**
 * Login user
 * @param string $username
 * @param string $password
 * @return array
 */
function loginUser($username, $password) {
    global $conn;
    
    $errors = [];
    
    if (empty($username)) {
        $errors[] = "Username is required.";
    }
    
    if (empty($password)) {
        $errors[] = "Password is required.";
    }
    
    if (!empty($errors)) {
        return ['success' => false, 'errors' => $errors];
    }
    
    try {
        // Get user from database
        $stmt = $conn->prepare("SELECT id, username, email, password, role FROM users WHERE username = ? OR email = ?");
        $stmt->execute([$username, $username]);
        $user = $stmt->fetch();
        
        if ($user && password_verify($password, $user['password'])) {
            // Set session variables
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['email'] = $user['email'];
            $_SESSION['role'] = $user['role'];
            
            return ['success' => true, 'message' => 'Login successful.'];
        } else {
            return ['success' => false, 'errors' => ['Invalid username or password.']];
        }
        
    } catch (PDOException $e) {
        error_log("Login Error: " . $e->getMessage());
        return ['success' => false, 'errors' => ['Login failed. Please try again.']];
    }
}

/**
 * Logout user
 */
function logoutUser() {
    $_SESSION = array();
    
    if (isset($_COOKIE[session_name()])) {
        setcookie(session_name(), '', time() - 3600, '/');
    }
    
    session_destroy();
}


