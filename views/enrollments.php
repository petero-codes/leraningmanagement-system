<?php
/**
 * Enrollments Management Page
 */

require_once __DIR__ . '/../config/config.php';
requireLogin();
require_once __DIR__ . '/../php/enrollments.php';
require_once __DIR__ . '/../php/students.php';
require_once __DIR__ . '/../php/courses.php';

$action = $_GET['action'] ?? 'list';
$errors = [];

// Handle form submissions
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = [
        'student_id' => intval($_POST['student_id'] ?? 0),
        'course_id' => intval($_POST['course_id'] ?? 0),
        'enrollment_date' => $_POST['enrollment_date'] ?? date('Y-m-d'),
        'status' => sanitizeInput($_POST['status'] ?? 'enrolled'),
        'grade' => sanitizeInput($_POST['grade'] ?? null)
    ];
    
    if ($action === 'add') {
        $result = createEnrollment($data);
        if ($result['success']) {
            setSuccessMessage($result['message']);
            header('Location: ' . BASE_URL . 'views/enrollments.php');
            exit();
        } else {
            $errors = $result['errors'];
        }
    } elseif ($action === 'edit') {
        $id = intval($_POST['id'] ?? 0);
        $result = updateEnrollment($id, $data);
        if ($result['success']) {
            setSuccessMessage($result['message']);
            header('Location: ' . BASE_URL . 'views/enrollments.php');
            exit();
        } else {
            $errors = $result['errors'];
        }
    }
}

// Handle delete
if ($action === 'delete' && isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $result = deleteEnrollment($id);
    if ($result['success']) {
        setSuccessMessage($result['message']);
    } else {
        setErrorMessage(implode(', ', $result['errors']));
    }
    header('Location: ' . BASE_URL . 'views/enrollments.php');
    exit();
}

// Get all data for lists
$enrollments = getAllEnrollments();
$students = getAllStudents();
$courses = getAllCourses();

$pageTitle = 'Enrollments';
include __DIR__ . '/../includes/header.php';
?>

<div class="page-header">
    <h1>Enrollment Management</h1>
    <?php if ($action === 'list'): ?>
        <a href="<?php echo BASE_URL; ?>views/enrollments.php?action=add" class="btn btn-primary">Add New Enrollment</a>
    <?php else: ?>
        <a href="<?php echo BASE_URL; ?>views/enrollments.php" class="btn btn-secondary">Back to List</a>
    <?php endif; ?>
</div>

<?php if ($action === 'list'): ?>
    <table class="data-table">
        <thead>
            <tr>
                <th>Student ID</th>
                <th>Student Name</th>
                <th>Course Code</th>
                <th>Course Name</th>
                <th>Enrollment Date</th>
                <th>Status</th>
                <th>Grade</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php if (empty($enrollments)): ?>
                <tr>
                    <td colspan="8" class="text-center">No enrollments found.</td>
                </tr>
            <?php else: ?>
                <?php foreach ($enrollments as $e): ?>
                <tr>
                    <td data-label="Student ID"><?php echo htmlspecialchars($e['student_id']); ?></td>
                    <td data-label="Student Name"><?php echo htmlspecialchars($e['first_name'] . ' ' . $e['last_name']); ?></td>
                    <td data-label="Course Code"><?php echo htmlspecialchars($e['course_code']); ?></td>
                    <td data-label="Course Name"><?php echo htmlspecialchars($e['course_name']); ?></td>
                    <td data-label="Enrollment Date"><?php echo htmlspecialchars($e['enrollment_date']); ?></td>
                    <td data-label="Status"><span class="badge badge-<?php echo $e['status'] === 'enrolled' ? 'success' : 'warning'; ?>">
                        <?php echo htmlspecialchars($e['status']); ?>
                    </span></td>
                    <td data-label="Grade"><?php echo htmlspecialchars($e['grade'] ?? 'N/A'); ?></td>
                    <td data-label="Actions">
                        <a href="<?php echo BASE_URL; ?>views/enrollments.php?action=edit&id=<?php echo $e['id']; ?>" class="btn btn-sm btn-primary">Edit</a>
                        <a href="<?php echo BASE_URL; ?>views/enrollments.php?action=delete&id=<?php echo $e['id']; ?>" 
                           class="btn btn-sm btn-danger" 
                           onclick="return confirm('Are you sure you want to delete this enrollment?');">Delete</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            <?php endif; ?>
        </tbody>
    </table>

<?php else: ?>
    <div class="form-container">
        <h2><?php echo $action === 'add' ? 'Add New Enrollment' : 'Edit Enrollment'; ?></h2>
        
        <?php if (!empty($errors)): ?>
            <div class="alert alert-error">
                <ul>
                    <?php foreach ($errors as $error): ?>
                        <li><?php echo htmlspecialchars($error); ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>
        
        <form method="POST" action="" id="enrollmentForm">
            <?php if ($action === 'edit'): ?>
                <input type="hidden" name="id" value="<?php echo intval($_GET['id'] ?? 0); ?>">
            <?php endif; ?>
            
            <div class="form-row">
                <div class="form-group">
                    <label for="student_id">Student *</label>
                    <select id="student_id" name="student_id" required>
                        <option value="">Select Student</option>
                        <?php foreach ($students as $s): ?>
                            <option value="<?php echo $s['id']; ?>" 
                                <?php echo (isset($_POST['student_id']) && $_POST['student_id'] == $s['id']) ? 'selected' : ''; ?>>
                                <?php echo htmlspecialchars($s['student_id'] . ' - ' . $s['first_name'] . ' ' . $s['last_name']); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                
                <div class="form-group">
                    <label for="course_id">Course *</label>
                    <select id="course_id" name="course_id" required>
                        <option value="">Select Course</option>
                        <?php foreach ($courses as $c): ?>
                            <option value="<?php echo $c['id']; ?>"
                                <?php echo (isset($_POST['course_id']) && $_POST['course_id'] == $c['id']) ? 'selected' : ''; ?>>
                                <?php echo htmlspecialchars($c['course_code'] . ' - ' . $c['course_name']); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
            
            <div class="form-row">
                <div class="form-group">
                    <label for="enrollment_date">Enrollment Date *</label>
                    <input type="date" id="enrollment_date" name="enrollment_date" required
                           value="<?php echo htmlspecialchars($_POST['enrollment_date'] ?? date('Y-m-d')); ?>">
                </div>
                
                <div class="form-group">
                    <label for="status">Status *</label>
                    <select id="status" name="status" required>
                        <option value="enrolled" <?php echo ($_POST['status'] ?? 'enrolled') === 'enrolled' ? 'selected' : ''; ?>>Enrolled</option>
                        <option value="completed" <?php echo ($_POST['status'] ?? '') === 'completed' ? 'selected' : ''; ?>>Completed</option>
                        <option value="dropped" <?php echo ($_POST['status'] ?? '') === 'dropped' ? 'selected' : ''; ?>>Dropped</option>
                    </select>
                </div>
            </div>
            
            <div class="form-group">
                <label for="grade">Grade</label>
                <select id="grade" name="grade">
                    <option value="">Select Grade</option>
                    <option value="A" <?php echo ($_POST['grade'] ?? '') === 'A' ? 'selected' : ''; ?>>A</option>
                    <option value="B" <?php echo ($_POST['grade'] ?? '') === 'B' ? 'selected' : ''; ?>>B</option>
                    <option value="C" <?php echo ($_POST['grade'] ?? '') === 'C' ? 'selected' : ''; ?>>C</option>
                    <option value="D" <?php echo ($_POST['grade'] ?? '') === 'D' ? 'selected' : ''; ?>>D</option>
                    <option value="F" <?php echo ($_POST['grade'] ?? '') === 'F' ? 'selected' : ''; ?>>F</option>
                </select>
            </div>
            
            <div class="form-actions">
                <button type="submit" class="btn btn-primary"><?php echo $action === 'add' ? 'Create Enrollment' : 'Update Enrollment'; ?></button>
                <a href="<?php echo BASE_URL; ?>views/enrollments.php" class="btn btn-secondary">Cancel</a>
            </div>
        </form>
    </div>
<?php endif; ?>

<?php include __DIR__ . '/../includes/footer.php'; ?>


