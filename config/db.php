<?php
/**
 * Database Configuration and Connection
 * Student Academic Management System
 * Supports both MySQL (localhost) and PostgreSQL (Render)
 */

// Check if we're on Render (has DATABASE_URL) or localhost
$dbUrl = getenv('DATABASE_URL');

if ($dbUrl) {
    // Render.com PostgreSQL Configuration
    $dbParts = parse_url($dbUrl);
    
    define('DB_HOST', $dbParts['host']);
    define('DB_USER', $dbParts['user']);
    define('DB_PASS', $dbParts['pass']);
    define('DB_NAME', ltrim($dbParts['path'], '/'));
    define('DB_PORT', $dbParts['port'] ?? 5432);
    define('DB_TYPE', 'postgresql');
} else {
    // Localhost MySQL Configuration
    define('DB_HOST', 'localhost');
    define('DB_USER', 'root');
    define('DB_PASS', '');
    define('DB_NAME', 'sams_db');
    define('DB_PORT', 3306);
    define('DB_TYPE', 'mysql');
}

/**
 * Database connection class using PDO
 * Supports both MySQL and PostgreSQL
 */
class Database {
    private $host = DB_HOST;
    private $user = DB_USER;
    private $pass = DB_PASS;
    private $name = DB_NAME;
    private $port = DB_PORT;
    private $type = DB_TYPE;
    private $conn = null;
    
    /**
     * Get database connection
     * @return PDO|null
     */
    public function getConnection() {
        try {
            if ($this->conn === null) {
                if ($this->type === 'postgresql') {
                    // PostgreSQL connection for Render
                    $dsn = "pgsql:host={$this->host};port={$this->port};dbname={$this->name};options='--client_encoding=UTF8'";
                } else {
                    // MySQL connection for localhost
                    $dsn = "mysql:host={$this->host};dbname={$this->name};charset=utf8mb4";
                }
                
                $options = [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                    PDO::ATTR_EMULATE_PREPARES => false,
                    PDO::ATTR_PERSISTENT => false,
                    PDO::ATTR_TIMEOUT => 5,
                ];
                
                $this->conn = new PDO($dsn, $this->user, $this->pass, $options);
                
                // Set MySQL-specific character set (not needed for PostgreSQL)
                if ($this->type === 'mysql') {
                    $this->conn->exec("SET NAMES utf8mb4 COLLATE utf8mb4_unicode_ci");
                }
            }
            
            // Test connection is still alive
            $this->conn->query("SELECT 1");
            
            return $this->conn;
        } catch (PDOException $e) {
            error_log("Database Connection Error: " . $e->getMessage());
            
            // Retry once on connection failure
            if ($this->conn === null) {
                try {
                    sleep(1);
                    $this->conn = new PDO($dsn, $this->user, $this->pass, $options);
                    
                    if ($this->type === 'mysql') {
                        $this->conn->exec("SET NAMES utf8mb4 COLLATE utf8mb4_unicode_ci");
                    }
                    
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
