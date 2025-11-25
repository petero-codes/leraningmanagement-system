<?php
/**
 * Student Summary Report
 */

require_once __DIR__ . '/../config/config.php';
requireLogin();
require_once __DIR__ . '/../php/students.php';
require_once __DIR__ . '/../php/enrollments.php';

$students = getAllStudents();
$summary = [];

// Calculate summary for each student
foreach ($students as $student) {
    $enrollments = getEnrollmentsByStudent($student['id']);
    $summary[] = [
        'student' => $student,
        'total_courses' => count($enrollments),
        'enrollments' => $enrollments
    ];
}

$pageTitle = 'Student Summary Report';
include __DIR__ . '/../includes/header.php';
?>

<div class="page-header">
    <h1>Student Summary Report</h1>
    <div>
        <button onclick="window.print()" class="btn btn-primary">Print Report</button>
        <a href="<?php echo BASE_URL; ?>reports/index.php" class="btn btn-secondary">Back to Reports</a>
    </div>
</div>

<div class="report-container">
    <div style="margin-bottom: 20px;">
        <p><strong>Report Generated:</strong> <?php echo date('Y-m-d H:i:s'); ?></p>
        <p><strong>Total Students:</strong> <?php echo count($students); ?></p>
    </div>
    
    <table class="data-table">
        <thead>
            <tr>
                <th>Student ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Enrollment Date</th>
                <th>Status</th>
                <th>Courses Enrolled</th>
            </tr>
        </thead>
        <tbody>
            <?php if (empty($summary)): ?>
                <tr>
                    <td colspan="7" class="text-center">No students found.</td>
                </tr>
            <?php else: ?>
                <?php foreach ($summary as $item): 
                    $s = $item['student'];
                ?>
                <tr>
                    <td><?php echo htmlspecialchars($s['student_id']); ?></td>
                    <td><?php echo htmlspecialchars($s['first_name'] . ' ' . $s['last_name']); ?></td>
                    <td><?php echo htmlspecialchars($s['email']); ?></td>
                    <td><?php echo htmlspecialchars($s['phone'] ?? 'N/A'); ?></td>
                    <td><?php echo htmlspecialchars($s['enrollment_date']); ?></td>
                    <td><span class="badge badge-<?php echo $s['status'] === 'active' ? 'success' : 'warning'; ?>">
                        <?php echo htmlspecialchars($s['status']); ?>
                    </span></td>
                    <td><?php echo $item['total_courses']; ?></td>
                </tr>
                <?php endforeach; ?>
            <?php endif; ?>
        </tbody>
    </table>
    
    <div style="margin-top: 30px; padding: 20px; background-color: #f8f9fa; border-radius: 4px;">
        <h3>Summary Statistics</h3>
        <p><strong>Total Students:</strong> <?php echo count($students); ?></p>
        <p><strong>Active Students:</strong> <?php echo count(array_filter($students, function($s) { return $s['status'] === 'active'; })); ?></p>
        <p><strong>Total Enrollments:</strong> <?php echo array_sum(array_column($summary, 'total_courses')); ?></p>
        <p><strong>Average Courses per Student:</strong> <?php 
            $total = count($summary);
            echo $total > 0 ? number_format(array_sum(array_column($summary, 'total_courses')) / $total, 2) : 0;
        ?></p>
    </div>
</div>

<?php include __DIR__ . '/../includes/footer.php'; ?>


