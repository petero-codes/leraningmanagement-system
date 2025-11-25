<?php
/**
 * Database Configuration for Render.com
 * PostgreSQL Connection
 */

// Get database URL from environment variable (Render provides this)
$dbUrl = getenv('DATABASE_URL');

if ($dbUrl) {
    // Parse PostgreSQL connection string
    $dbParts = parse_url($dbUrl);
    
    define('DB_HOST', $dbParts['host']);
    define('DB_USER', $dbParts['user']);
    define('DB_PASS', $dbParts['pass']);
    define('DB_NAME', ltrim($dbParts['path'], '/'));
    define('DB_PORT', $dbParts['port'] ?? 5432);
} else {
    // Fallback for local development
    define('DB_HOST', 'localhost');
    define('DB_USER', 'postgres');
    define('DB_PASS', '');
    define('DB_NAME', 'sams_db');
    define('DB_PORT', 5432);
}

/**
 * Database connection class using PDO for PostgreSQL
 */
class Database {
    private $host = DB_HOST;
    private $user = DB_USER;
    private $pass = DB_PASS;
    private $name = DB_NAME;
    private $port = DB_PORT;
    private $conn = null;
    
    /**
     * Get database connection
     * @return PDO|null
     */
    public function getConnection() {
        try {
            if ($this->conn === null) {
                $dsn = "pgsql:host={$this->host};port={$this->port};dbname={$this->name};options='--client_encoding=UTF8'";
                $options = [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                    PDO::ATTR_EMULATE_PREPARES => false,
                    PDO::ATTR_PERSISTENT => false,
                    PDO::ATTR_TIMEOUT => 5,
                ];
                
                $this->conn = new PDO($dsn, $this->user, $this->pass, $options);
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
                    return $this->conn;
                } catch (PDOException $e2) {
                    error_log("Database Retry Failed: " . $e2->getMessage());
                }
            }
            
            if (defined('DEBUG_MODE') && DEBUG_MODE) {
                die("Database connection failed: " . $e->getMessage());
            } else {
                die("Database connection failed. Please contact administrator.");
            }
        }
    }
    
    public function closeConnection() {
        $this->conn = null;
    }
}

// Global database instance
$db = new Database();
$conn = $db->getConnection();

