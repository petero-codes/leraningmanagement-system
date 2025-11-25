<?php
/**
 * Courses Management Page
 */

require_once __DIR__ . '/../config/config.php';
requireLogin();
require_once __DIR__ . '/../php/courses.php';

$action = $_GET['action'] ?? 'list';
$errors = [];
$course = null;

// Handle form submissions
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = [
        'course_code' => sanitizeInput($_POST['course_code'] ?? ''),
        'course_name' => sanitizeInput($_POST['course_name'] ?? ''),
        'credits' => intval($_POST['credits'] ?? 3),
        'description' => sanitizeInput($_POST['description'] ?? ''),
        'capacity' => intval($_POST['capacity'] ?? 30)
    ];
    
    if ($action === 'add') {
        $result = createCourse($data);
        if ($result['success']) {
            setSuccessMessage($result['message']);
            header('Location: ' . BASE_URL . 'views/courses.php');
            exit();
        } else {
            $errors = $result['errors'];
        }
    } elseif ($action === 'edit') {
        $id = intval($_POST['id'] ?? 0);
        $result = updateCourse($id, $data);
        if ($result['success']) {
            setSuccessMessage($result['message']);
            header('Location: ' . BASE_URL . 'views/courses.php');
            exit();
        } else {
            $errors = $result['errors'];
            $course = getCourseById($id);
        }
    }
}

// Handle delete
if ($action === 'delete' && isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $result = deleteCourse($id);
    if ($result['success']) {
        setSuccessMessage($result['message']);
    } else {
        setErrorMessage(implode(', ', $result['errors']));
    }
    header('Location: ' . BASE_URL . 'views/courses.php');
    exit();
}

// Get course for edit
if ($action === 'edit' && isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $course = getCourseById($id);
    if (!$course) {
        setErrorMessage('Course not found.');
        header('Location: ' . BASE_URL . 'views/courses.php');
        exit();
    }
}

// Get all courses for list
$courses = getAllCourses();

$pageTitle = 'Courses';
include __DIR__ . '/../includes/header.php';
?>

<div class="page-header">
    <h1>Course Management</h1>
    <?php if ($action === 'list'): ?>
        <a href="<?php echo BASE_URL; ?>views/courses.php?action=add" class="btn btn-primary">Add New Course</a>
    <?php else: ?>
        <a href="<?php echo BASE_URL; ?>views/courses.php" class="btn btn-secondary">Back to List</a>
    <?php endif; ?>
</div>

<?php if ($action === 'list'): ?>
    <table class="data-table">
        <thead>
            <tr>
                <th>Course Code</th>
                <th>Course Name</th>
                <th>Credits</th>
                <th>Enrollment</th>
                <th>Capacity</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php if (empty($courses)): ?>
                <tr>
                    <td colspan="6" class="text-center">No courses found.</td>
                </tr>
            <?php else: ?>
                <?php foreach ($courses as $c): ?>
                <tr>
                    <td data-label="Course Code"><?php echo htmlspecialchars($c['course_code']); ?></td>
                    <td data-label="Course Name"><?php echo htmlspecialchars($c['course_name']); ?></td>
                    <td data-label="Credits"><?php echo htmlspecialchars($c['credits']); ?></td>
                    <td data-label="Enrolled"><?php echo htmlspecialchars($c['enrolled_count']); ?></td>
                    <td data-label="Capacity"><?php echo htmlspecialchars($c['capacity']); ?></td>
                    <td data-label="Actions">
                        <a href="<?php echo BASE_URL; ?>views/courses.php?action=edit&id=<?php echo $c['id']; ?>" class="btn btn-sm btn-primary">Edit</a>
                        <a href="<?php echo BASE_URL; ?>views/courses.php?action=delete&id=<?php echo $c['id']; ?>" 
                           class="btn btn-sm btn-danger" 
                           onclick="return confirm('Are you sure you want to delete this course?');">Delete</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            <?php endif; ?>
        </tbody>
    </table>

<?php else: ?>
    <div class="form-container">
        <h2><?php echo $action === 'add' ? 'Add New Course' : 'Edit Course'; ?></h2>
        
        <?php if (!empty($errors)): ?>
            <div class="alert alert-error">
                <ul>
                    <?php foreach ($errors as $error): ?>
                        <li><?php echo htmlspecialchars($error); ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>
        
        <form method="POST" action="" id="courseForm">
            <?php if ($action === 'edit'): ?>
                <input type="hidden" name="id" value="<?php echo $course['id']; ?>">
            <?php endif; ?>
            
            <div class="form-row">
                <div class="form-group">
                    <label for="course_code">Course Code *</label>
                    <input type="text" id="course_code" name="course_code" required
                           value="<?php echo htmlspecialchars($course['course_code'] ?? ''); ?>">
                </div>
                
                <div class="form-group">
                    <label for="credits">Credits *</label>
                    <input type="number" id="credits" name="credits" required min="1" max="6"
                           value="<?php echo htmlspecialchars($course['credits'] ?? 3); ?>">
                </div>
            </div>
            
            <div class="form-group">
                <label for="course_name">Course Name *</label>
                <input type="text" id="course_name" name="course_name" required
                       value="<?php echo htmlspecialchars($course['course_name'] ?? ''); ?>">
            </div>
            
            <div class="form-group">
                <label for="description">Description</label>
                <textarea id="description" name="description" rows="4"><?php echo htmlspecialchars($course['description'] ?? ''); ?></textarea>
            </div>
            
            <div class="form-group">
                <label for="capacity">Capacity *</label>
                <input type="number" id="capacity" name="capacity" required min="1"
                       value="<?php echo htmlspecialchars($course['capacity'] ?? 30); ?>">
            </div>
            
            <div class="form-actions">
                <button type="submit" class="btn btn-primary"><?php echo $action === 'add' ? 'Create Course' : 'Update Course'; ?></button>
                <a href="<?php echo BASE_URL; ?>views/courses.php" class="btn btn-secondary">Cancel</a>
            </div>
        </form>
    </div>
<?php endif; ?>

<?php include __DIR__ . '/../includes/footer.php'; ?>


