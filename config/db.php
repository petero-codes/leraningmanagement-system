<?php
/**
 * Database Configuration and Connection
 * Student Academic Management System
 */

// Database configuration constants
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'sams_db');

/**
 * Database connection class using PDO
 * Implements prepared statements for security
 */
class Database {
    private $host = DB_HOST;
    private $user = DB_USER;
    private $pass = DB_PASS;
    private $name = DB_NAME;
    private $conn = null;
    
    /**
     * Get database connection
     * @return PDO|null
     */
    public function getConnection() {
        try {
            if ($this->conn === null) {
                $dsn = "mysql:host={$this->host};dbname={$this->name};charset=utf8mb4";
                $options = [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                    PDO::ATTR_EMULATE_PREPARES => false,
                    PDO::ATTR_PERSISTENT => false, // Connection pooling
                    PDO::ATTR_TIMEOUT => 5, // 5 second timeout
                ];
                
                $this->conn = new PDO($dsn, $this->user, $this->pass, $options);
                
                // Set connection character set
                $this->conn->exec("SET NAMES utf8mb4 COLLATE utf8mb4_unicode_ci");
            }
            
            // Test connection is still alive
            $this->conn->query("SELECT 1");
            
            return $this->conn;
        } catch (PDOException $e) {
            error_log("Database Connection Error: " . $e->getMessage());
            
            // Retry once on connection failure
            if ($this->conn === null) {
                try {
                    sleep(1); // Wait 1 second before retry
                    $this->conn = new PDO($dsn, $this->user, $this->pass, $options);
                    $this->conn->exec("SET NAMES utf8mb4 COLLATE utf8mb4_unicode_ci");
                    return $this->conn;
                } catch (PDOException $e2) {
                    error_log("Database Retry Failed: " . $e2->getMessage());
                }
            }
            
            // User-friendly error message
            if (defined('DEBUG_MODE') && DEBUG_MODE) {
                die("Database connection failed: " . $e->getMessage());
            } else {
                die("Database connection failed. Please contact administrator.");
            }
        }
    }
    
    /**
     * Close database connection
     */
    public function closeConnection() {
        $this->conn = null;
    }
}

// Global database instance
$db = new Database();
$conn = $db->getConnection();


