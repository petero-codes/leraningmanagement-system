<?php
/**
 * Home/Index Page
 * Redirects to login if not authenticated, otherwise to dashboard
 */

require_once __DIR__ . '/config/config.php';

if (isLoggedIn()) {
    header('Location: ' . BASE_URL . 'dashboard.php');
    exit();
} else {
    header('Location: ' . BASE_URL . 'login.php');
    exit();
}


