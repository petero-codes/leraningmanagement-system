<?php
/**
 * Reports Index Page
 */

require_once __DIR__ . '/../config/config.php';
requireLogin();

$reportType = $_GET['type'] ?? '';

$pageTitle = 'Reports';
include __DIR__ . '/../includes/header.php';
?>

<div class="page-header">
    <h1>Reports</h1>
</div>

<div class="report-container">
    <h2>Select Report Type</h2>
    
    <div class="report-options">
        <a href="<?php echo BASE_URL; ?>reports/student_summary.php" class="report-option">
            <h3>Student Summary Report</h3>
            <p>Comprehensive overview of all students with their enrollment details</p>
        </a>
        
        <a href="<?php echo BASE_URL; ?>reports/enrollment_stats.php" class="report-option">
            <h3>Course Enrollment Statistics</h3>
            <p>Statistics on course enrollments and capacity utilization</p>
        </a>
        
        <a href="<?php echo BASE_URL; ?>reports/performance.php" class="report-option">
            <h3>Academic Performance Report</h3>
            <p>Student academic performance and grade distribution</p>
        </a>
    </div>
</div>

<?php include __DIR__ . '/../includes/footer.php'; ?>


