<?php
/**
 * Dashboard Page
 */

require_once __DIR__ . '/config/config.php';
requireLogin();
require_once __DIR__ . '/php/students.php';
require_once __DIR__ . '/php/courses.php';
require_once __DIR__ . '/php/enrollments.php';

// Get statistics
$students = getAllStudents();
$courses = getAllCourses();
$enrollments = getAllEnrollments();

$totalStudents = count($students);
$totalCourses = count($courses);
$totalEnrollments = count($enrollments);
$activeStudents = count(array_filter($students, function($s) { return $s['status'] === 'active'; }));

$pageTitle = 'Dashboard';
include __DIR__ . '/includes/header.php';
?>

<div class="dashboard">
    <h1>Dashboard</h1>
    <p>Welcome, <?php echo htmlspecialchars($_SESSION['username']); ?>!</p>
    
    <div class="stats-grid">
        <div class="stat-card">
            <h3>Total Students</h3>
            <p class="stat-number"><?php echo $totalStudents; ?></p>
            <p class="stat-detail"><?php echo $activeStudents; ?> active</p>
        </div>
        
        <div class="stat-card">
            <h3>Total Courses</h3>
            <p class="stat-number"><?php echo $totalCourses; ?></p>
            <p class="stat-detail">Available courses</p>
        </div>
        
        <div class="stat-card">
            <h3>Total Enrollments</h3>
            <p class="stat-number"><?php echo $totalEnrollments; ?></p>
            <p class="stat-detail">Active enrollments</p>
        </div>
        
        <div class="stat-card">
            <h3>Quick Actions</h3>
            <div class="quick-actions">
                <a href="<?php echo BASE_URL; ?>views/students.php?action=add" class="btn btn-sm btn-primary">Add Student</a>
                <a href="<?php echo BASE_URL; ?>views/courses.php?action=add" class="btn btn-sm btn-primary">Add Course</a>
            </div>
        </div>
    </div>
    
    <div class="dashboard-sections">
        <div class="section">
            <h2>Recent Students</h2>
            <table class="data-table">
                <thead>
                    <tr>
                        <th>Student ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $recentStudents = array_slice($students, 0, 5);
                    foreach ($recentStudents as $student): 
                    ?>
                    <tr>
                        <td><?php echo htmlspecialchars($student['student_id']); ?></td>
                        <td><?php echo htmlspecialchars($student['first_name'] . ' ' . $student['last_name']); ?></td>
                        <td><?php echo htmlspecialchars($student['email']); ?></td>
                        <td><span class="badge badge-<?php echo $student['status'] === 'active' ? 'success' : 'warning'; ?>">
                            <?php echo htmlspecialchars($student['status']); ?>
                        </span></td>
                        <td>
                            <a href="<?php echo BASE_URL; ?>views/students.php?action=edit&id=<?php echo $student['id']; ?>" class="btn btn-sm">Edit</a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <a href="<?php echo BASE_URL; ?>views/students.php" class="btn btn-link">View All Students</a>
        </div>
        
        <div class="section">
            <h2>Available Courses</h2>
            <table class="data-table">
                <thead>
                    <tr>
                        <th>Course Code</th>
                        <th>Course Name</th>
                        <th>Credits</th>
                        <th>Enrollment</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach (array_slice($courses, 0, 5) as $course): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($course['course_code']); ?></td>
                        <td><?php echo htmlspecialchars($course['course_name']); ?></td>
                        <td><?php echo htmlspecialchars($course['credits']); ?></td>
                        <td><?php echo htmlspecialchars($course['enrolled_count'] . '/' . $course['capacity']); ?></td>
                        <td>
                            <a href="<?php echo BASE_URL; ?>views/courses.php?action=edit&id=<?php echo $course['id']; ?>" class="btn btn-sm">Edit</a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <a href="<?php echo BASE_URL; ?>views/courses.php" class="btn btn-link">View All Courses</a>
        </div>
    </div>
</div>

<?php include __DIR__ . '/includes/footer.php'; ?>


