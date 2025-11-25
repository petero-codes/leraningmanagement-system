<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo isset($pageTitle) ? $pageTitle . ' - ' : ''; ?>Student Academic Management System</title>
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>assets/css/style.css">
</head>
<body>
    <?php if (isLoggedIn()): ?>
    <nav class="navbar">
        <div class="nav-container">
            <div class="nav-brand">
                <h2>Student Management System</h2>
            </div>
            <div class="nav-menu">
                <a href="<?php echo BASE_URL; ?>dashboard.php" class="nav-link">Dashboard</a>
                <a href="<?php echo BASE_URL; ?>views/students.php" class="nav-link">Students</a>
                <a href="<?php echo BASE_URL; ?>views/courses.php" class="nav-link">Courses</a>
                <a href="<?php echo BASE_URL; ?>views/enrollments.php" class="nav-link">Enrollments</a>
                <a href="<?php echo BASE_URL; ?>reports/index.php" class="nav-link">Reports</a>
                <span class="nav-user"><?php echo htmlspecialchars($_SESSION['username']); ?></span>
                <a href="<?php echo BASE_URL; ?>php/logout.php" class="nav-link btn-logout">Logout</a>
            </div>
        </div>
    </nav>
    <?php endif; ?>
    
    <div class="container">
        <?php
        $successMsg = getSuccessMessage();
        $errorMsg = getErrorMessage();
        if ($successMsg): ?>
            <div class="alert alert-success">
                <?php echo htmlspecialchars($successMsg); ?>
            </div>
        <?php endif; ?>
        <?php if ($errorMsg): ?>
            <div class="alert alert-error">
                <?php echo htmlspecialchars($errorMsg); ?>
            </div>
        <?php endif; ?>


