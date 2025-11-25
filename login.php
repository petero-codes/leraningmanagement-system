<?php
/**
 * Login Page
 */

require_once __DIR__ . '/config/config.php';
require_once __DIR__ . '/php/auth.php';

// Redirect if already logged in
if (isLoggedIn()) {
    header('Location: ' . BASE_URL . 'dashboard.php');
    exit();
}

$errors = [];

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = sanitizeInput($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';
    
    $result = loginUser($username, $password);
    
    if ($result['success']) {
        setSuccessMessage($result['message']);
        header('Location: ' . BASE_URL . 'dashboard.php');
        exit();
    } else {
        $errors = $result['errors'];
    }
}

$pageTitle = 'Login';
include __DIR__ . '/includes/header.php';
?>

<div class="login-container">
    <div class="login-box">
        <h1>Student Academic Management System</h1>
        <h2>Login</h2>
        
        <?php if (!empty($errors)): ?>
            <div class="alert alert-error">
                <ul>
                    <?php foreach ($errors as $error): ?>
                        <li><?php echo htmlspecialchars($error); ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>
        
        <form method="POST" action="" id="loginForm">
            <div class="form-group">
                <label for="username">Username or Email:</label>
                <input type="text" id="username" name="username" required 
                       value="<?php echo isset($_POST['username']) ? htmlspecialchars($_POST['username']) : ''; ?>">
            </div>
            
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>
            </div>
            
            <div class="form-group">
                <button type="submit" class="btn btn-primary">Login</button>
            </div>
        </form>
        
        <p class="register-link">
            Don't have an account? <a href="<?php echo BASE_URL; ?>register.php">Register Here</a>
        </p>
    </div>
</div>

<?php include __DIR__ . '/includes/footer.php'; ?>


