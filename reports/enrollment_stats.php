<?php
/**
 * Course Enrollment Statistics Report
 */

require_once __DIR__ . '/../config/config.php';
requireLogin();
require_once __DIR__ . '/../php/courses.php';
require_once __DIR__ . '/../php/enrollments.php';

$courses = getAllCourses();
$enrollments = getAllEnrollments();

// Calculate statistics for each course
$stats = [];
foreach ($courses as $course) {
    $courseEnrollments = array_filter($enrollments, function($e) use ($course) {
        return $e['course_id'] == $course['id'] && $e['status'] === 'enrolled';
    });
    
    $utilization = $course['capacity'] > 0 ? ($course['enrolled_count'] / $course['capacity']) * 100 : 0;
    
    $stats[] = [
        'course' => $course,
        'enrolled_count' => count($courseEnrollments),
        'utilization' => $utilization
    ];
}

// Sort by utilization (descending)
usort($stats, function($a, $b) {
    return $b['utilization'] <=> $a['utilization'];
});

$pageTitle = 'Enrollment Statistics Report';
include __DIR__ . '/../includes/header.php';
?>

<div class="page-header">
    <h1>Course Enrollment Statistics</h1>
    <div>
        <button onclick="window.print()" class="btn btn-primary">Print Report</button>
        <a href="<?php echo BASE_URL; ?>reports/index.php" class="btn btn-secondary">Back to Reports</a>
    </div>
</div>

<div class="report-container">
    <div style="margin-bottom: 20px;">
        <p><strong>Report Generated:</strong> <?php echo date('Y-m-d H:i:s'); ?></p>
        <p><strong>Total Courses:</strong> <?php echo count($courses); ?></p>
    </div>
    
    <table class="data-table">
        <thead>
            <tr>
                <th>Course Code</th>
                <th>Course Name</th>
                <th>Credits</th>
                <th>Enrolled</th>
                <th>Capacity</th>
                <th>Available</th>
                <th>Utilization %</th>
            </tr>
        </thead>
        <tbody>
            <?php if (empty($stats)): ?>
                <tr>
                    <td colspan="7" class="text-center">No courses found.</td>
                </tr>
            <?php else: ?>
                <?php foreach ($stats as $item): 
                    $c = $item['course'];
                    $available = $c['capacity'] - $c['enrolled_count'];
                ?>
                <tr>
                    <td><?php echo htmlspecialchars($c['course_code']); ?></td>
                    <td><?php echo htmlspecialchars($c['course_name']); ?></td>
                    <td><?php echo htmlspecialchars($c['credits']); ?></td>
                    <td><?php echo htmlspecialchars($c['enrolled_count']); ?></td>
                    <td><?php echo htmlspecialchars($c['capacity']); ?></td>
                    <td><?php echo $available; ?></td>
                    <td>
                        <span style="color: <?php echo $item['utilization'] >= 90 ? '#e74c3c' : ($item['utilization'] >= 70 ? '#f39c12' : '#27ae60'); ?>;">
                            <?php echo number_format($item['utilization'], 1); ?>%
                        </span>
                    </td>
                </tr>
                <?php endforeach; ?>
            <?php endif; ?>
        </tbody>
    </table>
    
    <div style="margin-top: 30px; padding: 20px; background-color: #f8f9fa; border-radius: 4px;">
        <h3>Summary Statistics</h3>
        <p><strong>Total Courses:</strong> <?php echo count($courses); ?></p>
        <p><strong>Total Capacity:</strong> <?php echo array_sum(array_column($courses, 'capacity')); ?></p>
        <p><strong>Total Enrolled:</strong> <?php echo array_sum(array_column($courses, 'enrolled_count')); ?></p>
        <p><strong>Overall Utilization:</strong> <?php 
            $totalCapacity = array_sum(array_column($courses, 'capacity'));
            $totalEnrolled = array_sum(array_column($courses, 'enrolled_count'));
            echo $totalCapacity > 0 ? number_format(($totalEnrolled / $totalCapacity) * 100, 1) : 0;
        ?>%</p>
        <p><strong>Courses at Full Capacity:</strong> <?php 
            echo count(array_filter($stats, function($s) { 
                return $s['utilization'] >= 100; 
            }));
        ?></p>
        <p><strong>Courses with Available Spots:</strong> <?php 
            echo count(array_filter($stats, function($s) { 
                return $s['utilization'] < 100; 
            }));
        ?></p>
    </div>
</div>

<?php include __DIR__ . '/../includes/footer.php'; ?>


