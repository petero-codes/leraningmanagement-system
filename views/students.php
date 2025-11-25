<?php
/**
 * Students Management Page
 */

require_once __DIR__ . '/../config/config.php';
requireLogin();
require_once __DIR__ . '/../php/students.php';

$action = $_GET['action'] ?? 'list';
$errors = [];
$student = null;

// Handle form submissions
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = [
        'student_id' => sanitizeInput($_POST['student_id'] ?? ''),
        'first_name' => sanitizeInput($_POST['first_name'] ?? ''),
        'last_name' => sanitizeInput($_POST['last_name'] ?? ''),
        'email' => sanitizeInput($_POST['email'] ?? ''),
        'phone' => sanitizeInput($_POST['phone'] ?? ''),
        'address' => sanitizeInput($_POST['address'] ?? ''),
        'date_of_birth' => $_POST['date_of_birth'] ?? null,
        'enrollment_date' => $_POST['enrollment_date'] ?? '',
        'status' => sanitizeInput($_POST['status'] ?? 'active')
    ];
    
    if ($action === 'add') {
        $result = createStudent($data);
        if ($result['success']) {
            setSuccessMessage($result['message']);
            header('Location: ' . BASE_URL . 'views/students.php');
            exit();
        } else {
            $errors = $result['errors'];
        }
    } elseif ($action === 'edit') {
        $id = intval($_POST['id'] ?? 0);
        $result = updateStudent($id, $data);
        if ($result['success']) {
            setSuccessMessage($result['message']);
            header('Location: ' . BASE_URL . 'views/students.php');
            exit();
        } else {
            $errors = $result['errors'];
            $student = getStudentById($id);
        }
    }
}

// Handle delete
if ($action === 'delete' && isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $result = deleteStudent($id);
    if ($result['success']) {
        setSuccessMessage($result['message']);
    } else {
        setErrorMessage(implode(', ', $result['errors']));
    }
    header('Location: ' . BASE_URL . 'views/students.php');
    exit();
}

// Get student for edit
if ($action === 'edit' && isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $student = getStudentById($id);
    if (!$student) {
        setErrorMessage('Student not found.');
        header('Location: ' . BASE_URL . 'views/students.php');
        exit();
    }
}

// Get all students for list
$students = getAllStudents();

$pageTitle = 'Students';
include __DIR__ . '/../includes/header.php';
?>

<div class="page-header">
    <h1>Student Management</h1>
    <?php if ($action === 'list'): ?>
        <a href="<?php echo BASE_URL; ?>views/students.php?action=add" class="btn btn-primary">Add New Student</a>
    <?php else: ?>
        <a href="<?php echo BASE_URL; ?>views/students.php" class="btn btn-secondary">Back to List</a>
    <?php endif; ?>
</div>

<?php if ($action === 'list'): ?>
    <div class="search-bar">
        <input type="text" id="searchInput" placeholder="Search students..." onkeyup="filterTable()">
    </div>
    
    <table class="data-table" id="studentsTable">
        <thead>
            <tr>
                <th>Student ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Enrollment Date</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php if (empty($students)): ?>
                <tr>
                    <td colspan="7" class="text-center">No students found.</td>
                </tr>
            <?php else: ?>
                <?php foreach ($students as $s): ?>
                <tr>
                    <td><?php echo htmlspecialchars($s['student_id']); ?></td>
                    <td><?php echo htmlspecialchars($s['first_name'] . ' ' . $s['last_name']); ?></td>
                    <td><?php echo htmlspecialchars($s['email']); ?></td>
                    <td><?php echo htmlspecialchars($s['phone'] ?? 'N/A'); ?></td>
                    <td><?php echo htmlspecialchars($s['enrollment_date']); ?></td>
                    <td><span class="badge badge-<?php echo $s['status'] === 'active' ? 'success' : 'warning'; ?>">
                        <?php echo htmlspecialchars($s['status']); ?>
                    </span></td>
                    <td>
                        <a href="<?php echo BASE_URL; ?>views/students.php?action=edit&id=<?php echo $s['id']; ?>" class="btn btn-sm btn-primary">Edit</a>
                        <a href="<?php echo BASE_URL; ?>views/students.php?action=delete&id=<?php echo $s['id']; ?>" 
                           class="btn btn-sm btn-danger" 
                           onclick="return confirm('Are you sure you want to delete this student?');">Delete</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            <?php endif; ?>
        </tbody>
    </table>

<?php else: ?>
    <div class="form-container">
        <h2><?php echo $action === 'add' ? 'Add New Student' : 'Edit Student'; ?></h2>
        
        <?php if (!empty($errors)): ?>
            <div class="alert alert-error">
                <ul>
                    <?php foreach ($errors as $error): ?>
                        <li><?php echo htmlspecialchars($error); ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>
        
        <form method="POST" action="" id="studentForm">
            <?php if ($action === 'edit'): ?>
                <input type="hidden" name="id" value="<?php echo $student['id']; ?>">
            <?php endif; ?>
            
            <div class="form-row">
                <div class="form-group">
                    <label for="student_id">Student ID *</label>
                    <input type="text" id="student_id" name="student_id" required
                           value="<?php echo htmlspecialchars($student['student_id'] ?? ''); ?>">
                </div>
                
                <div class="form-group">
                    <label for="status">Status *</label>
                    <select id="status" name="status" required>
                        <option value="active" <?php echo ($student['status'] ?? 'active') === 'active' ? 'selected' : ''; ?>>Active</option>
                        <option value="inactive" <?php echo ($student['status'] ?? '') === 'inactive' ? 'selected' : ''; ?>>Inactive</option>
                    </select>
                </div>
            </div>
            
            <div class="form-row">
                <div class="form-group">
                    <label for="first_name">First Name *</label>
                    <input type="text" id="first_name" name="first_name" required
                           value="<?php echo htmlspecialchars($student['first_name'] ?? ''); ?>">
                </div>
                
                <div class="form-group">
                    <label for="last_name">Last Name *</label>
                    <input type="text" id="last_name" name="last_name" required
                           value="<?php echo htmlspecialchars($student['last_name'] ?? ''); ?>">
                </div>
            </div>
            
            <div class="form-row">
                <div class="form-group">
                    <label for="email">Email *</label>
                    <input type="email" id="email" name="email" required
                           value="<?php echo htmlspecialchars($student['email'] ?? ''); ?>">
                </div>
                
                <div class="form-group">
                    <label for="phone">Phone</label>
                    <input type="tel" id="phone" name="phone"
                           value="<?php echo htmlspecialchars($student['phone'] ?? ''); ?>">
                </div>
            </div>
            
            <div class="form-group">
                <label for="address">Address</label>
                <textarea id="address" name="address" rows="3"><?php echo htmlspecialchars($student['address'] ?? ''); ?></textarea>
            </div>
            
            <div class="form-row">
                <div class="form-group">
                    <label for="date_of_birth">Date of Birth</label>
                    <input type="date" id="date_of_birth" name="date_of_birth"
                           value="<?php echo htmlspecialchars($student['date_of_birth'] ?? ''); ?>">
                </div>
                
                <div class="form-group">
                    <label for="enrollment_date">Enrollment Date *</label>
                    <input type="date" id="enrollment_date" name="enrollment_date" required
                           value="<?php echo htmlspecialchars($student['enrollment_date'] ?? date('Y-m-d')); ?>">
                </div>
            </div>
            
            <div class="form-actions">
                <button type="submit" class="btn btn-primary"><?php echo $action === 'add' ? 'Create Student' : 'Update Student'; ?></button>
                <a href="<?php echo BASE_URL; ?>views/students.php" class="btn btn-secondary">Cancel</a>
            </div>
        </form>
    </div>
<?php endif; ?>

<?php include __DIR__ . '/../includes/footer.php'; ?>


