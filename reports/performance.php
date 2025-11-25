<?php
/**
 * Academic Performance Report
 */

require_once __DIR__ . '/../config/config.php';
requireLogin();
require_once __DIR__ . '/../php/students.php';
require_once __DIR__ . '/../php/enrollments.php';

$enrollments = getAllEnrollments();

// Filter enrollments with grades
$gradedEnrollments = array_filter($enrollments, function($e) {
    return !empty($e['grade']);
});

// Calculate grade distribution
$gradeDistribution = [
    'A' => 0,
    'B' => 0,
    'C' => 0,
    'D' => 0,
    'F' => 0
];

foreach ($gradedEnrollments as $e) {
    if (isset($gradeDistribution[$e['grade']])) {
        $gradeDistribution[$e['grade']]++;
    }
}

// Group by student
$studentPerformance = [];
foreach ($enrollments as $e) {
    $studentId = $e['student_id'];
    if (!isset($studentPerformance[$studentId])) {
        $studentPerformance[$studentId] = [
            'student_id' => $e['student_id'],
            'name' => $e['first_name'] . ' ' . $e['last_name'],
            'courses' => [],
            'total_credits' => 0,
            'graded_courses' => 0
        ];
    }
    
    $studentPerformance[$studentId]['courses'][] = [
        'course_code' => $e['course_code'],
        'course_name' => $e['course_name'],
        'credits' => $e['credits'],
        'grade' => $e['grade'],
        'status' => $e['status']
    ];
    
    if (!empty($e['grade'])) {
        $studentPerformance[$studentId]['graded_courses']++;
    }
}

$pageTitle = 'Academic Performance Report';
include __DIR__ . '/../includes/header.php';
?>

<div class="page-header">
    <h1>Academic Performance Report</h1>
    <div>
        <button onclick="window.print()" class="btn btn-primary">Print Report</button>
        <a href="<?php echo BASE_URL; ?>reports/index.php" class="btn btn-secondary">Back to Reports</a>
    </div>
</div>

<div class="report-container">
    <div style="margin-bottom: 20px;">
        <p><strong>Report Generated:</strong> <?php echo date('Y-m-d H:i:s'); ?></p>
        <p><strong>Total Enrollments:</strong> <?php echo count($enrollments); ?></p>
        <p><strong>Graded Enrollments:</strong> <?php echo count($gradedEnrollments); ?></p>
    </div>
    
    <h3>Grade Distribution</h3>
    <table class="data-table" style="margin-bottom: 30px;">
        <thead>
            <tr>
                <th>Grade</th>
                <th>Count</th>
                <th>Percentage</th>
            </tr>
        </thead>
        <tbody>
            <?php 
            $totalGraded = count($gradedEnrollments);
            foreach ($gradeDistribution as $grade => $count): 
                $percentage = $totalGraded > 0 ? ($count / $totalGraded) * 100 : 0;
            ?>
            <tr>
                <td><strong><?php echo $grade; ?></strong></td>
                <td><?php echo $count; ?></td>
                <td><?php echo number_format($percentage, 1); ?>%</td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    
    <h3>Student Performance</h3>
    <table class="data-table">
        <thead>
            <tr>
                <th>Student ID</th>
                <th>Name</th>
                <th>Courses</th>
                <th>Graded Courses</th>
                <th>Details</th>
            </tr>
        </thead>
        <tbody>
            <?php if (empty($studentPerformance)): ?>
                <tr>
                    <td colspan="5" class="text-center">No student performance data available.</td>
                </tr>
            <?php else: ?>
                <?php foreach ($studentPerformance as $perf): ?>
                <tr>
                    <td><?php echo htmlspecialchars($perf['student_id']); ?></td>
                    <td><?php echo htmlspecialchars($perf['name']); ?></td>
                    <td><?php echo count($perf['courses']); ?></td>
                    <td><?php echo $perf['graded_courses']; ?></td>
                    <td>
                        <details>
                            <summary>View Courses</summary>
                            <table style="margin-top: 10px; width: 100%;">
                                <thead>
                                    <tr>
                                        <th>Course</th>
                                        <th>Credits</th>
                                        <th>Grade</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($perf['courses'] as $course): ?>
                                    <tr>
                                        <td><?php echo htmlspecialchars($course['course_code'] . ' - ' . $course['course_name']); ?></td>
                                        <td><?php echo htmlspecialchars($course['credits']); ?></td>
                                        <td><?php echo htmlspecialchars($course['grade'] ?? 'N/A'); ?></td>
                                        <td><?php echo htmlspecialchars($course['status']); ?></td>
                                    </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </details>
                    </td>
                </tr>
                <?php endforeach; ?>
            <?php endif; ?>
        </tbody>
    </table>
    
    <div style="margin-top: 30px; padding: 20px; background-color: #f8f9fa; border-radius: 4px;">
        <h3>Summary Statistics</h3>
        <p><strong>Total Students:</strong> <?php echo count($studentPerformance); ?></p>
        <p><strong>Total Enrollments:</strong> <?php echo count($enrollments); ?></p>
        <p><strong>Graded Enrollments:</strong> <?php echo count($gradedEnrollments); ?></p>
        <p><strong>Average Grade Distribution:</strong></p>
        <ul>
            <?php foreach ($gradeDistribution as $grade => $count): 
                $percentage = $totalGraded > 0 ? ($count / $totalGraded) * 100 : 0;
            ?>
            <li>Grade <?php echo $grade; ?>: <?php echo number_format($percentage, 1); ?>%</li>
            <?php endforeach; ?>
        </ul>
    </div>
</div>

<?php include __DIR__ . '/../includes/footer.php'; ?>


