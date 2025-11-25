<?php
/**
 * Student CRUD Operations
 */

require_once __DIR__ . '/../config/config.php';
requireLogin();

/**
 * Get all students
 * @return array
 */
function getAllStudents() {
    global $conn;
    
    try {
        $stmt = $conn->prepare("SELECT * FROM students ORDER BY created_at DESC");
        $stmt->execute();
        return $stmt->fetchAll();
    } catch (PDOException $e) {
        error_log("Error fetching students: " . $e->getMessage());
        return [];
    }
}

/**
 * Get student by ID
 * @param int $id
 * @return array|null
 */
function getStudentById($id) {
    global $conn;
    
    try {
        $stmt = $conn->prepare("SELECT * FROM students WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch();
    } catch (PDOException $e) {
        error_log("Error fetching student: " . $e->getMessage());
        return null;
    }
}

/**
 * Create new student
 * @param array $data
 * @return array
 */
function createStudent($data) {
    global $conn;
    
    $errors = [];
    
    // Validation
    if (empty($data['student_id'])) {
        $errors[] = "Student ID is required.";
    }
    if (empty($data['first_name'])) {
        $errors[] = "First name is required.";
    }
    if (empty($data['last_name'])) {
        $errors[] = "Last name is required.";
    }
    if (empty($data['email']) || !validateEmail($data['email'])) {
        $errors[] = "Valid email is required.";
    }
    if (empty($data['enrollment_date'])) {
        $errors[] = "Enrollment date is required.";
    }
    
    if (!empty($errors)) {
        return ['success' => false, 'errors' => $errors];
    }
    
    try {
        // Check if student_id or email already exists
        $stmt = $conn->prepare("SELECT id FROM students WHERE student_id = ? OR email = ?");
        $stmt->execute([$data['student_id'], $data['email']]);
        if ($stmt->fetch()) {
            return ['success' => false, 'errors' => ['Student ID or email already exists.']];
        }
        
        // Insert student
        $stmt = $conn->prepare("INSERT INTO students (student_id, first_name, last_name, email, phone, address, date_of_birth, enrollment_date, status) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->execute([
            $data['student_id'],
            $data['first_name'],
            $data['last_name'],
            $data['email'],
            $data['phone'] ?? null,
            $data['address'] ?? null,
            $data['date_of_birth'] ?? null,
            $data['enrollment_date'],
            $data['status'] ?? 'active'
        ]);
        
        return ['success' => true, 'message' => 'Student created successfully.'];
        
    } catch (PDOException $e) {
        error_log("Error creating student: " . $e->getMessage());
        return ['success' => false, 'errors' => ['Failed to create student. Please try again.']];
    }
}

/**
 * Update student
 * @param int $id
 * @param array $data
 * @return array
 */
function updateStudent($id, $data) {
    global $conn;
    
    $errors = [];
    
    // Validation (same as create)
    if (empty($data['student_id'])) {
        $errors[] = "Student ID is required.";
    }
    if (empty($data['first_name'])) {
        $errors[] = "First name is required.";
    }
    if (empty($data['last_name'])) {
        $errors[] = "Last name is required.";
    }
    if (empty($data['email']) || !validateEmail($data['email'])) {
        $errors[] = "Valid email is required.";
    }
    if (empty($data['enrollment_date'])) {
        $errors[] = "Enrollment date is required.";
    }
    
    if (!empty($errors)) {
        return ['success' => false, 'errors' => $errors];
    }
    
    try {
        // Check if student_id or email exists for another student
        $stmt = $conn->prepare("SELECT id FROM students WHERE (student_id = ? OR email = ?) AND id != ?");
        $stmt->execute([$data['student_id'], $data['email'], $id]);
        if ($stmt->fetch()) {
            return ['success' => false, 'errors' => ['Student ID or email already exists for another student.']];
        }
        
        // Update student
        $stmt = $conn->prepare("UPDATE students SET student_id = ?, first_name = ?, last_name = ?, email = ?, phone = ?, address = ?, date_of_birth = ?, enrollment_date = ?, status = ? WHERE id = ?");
        $stmt->execute([
            $data['student_id'],
            $data['first_name'],
            $data['last_name'],
            $data['email'],
            $data['phone'] ?? null,
            $data['address'] ?? null,
            $data['date_of_birth'] ?? null,
            $data['enrollment_date'],
            $data['status'] ?? 'active',
            $id
        ]);
        
        return ['success' => true, 'message' => 'Student updated successfully.'];
        
    } catch (PDOException $e) {
        error_log("Error updating student: " . $e->getMessage());
        return ['success' => false, 'errors' => ['Failed to update student. Please try again.']];
    }
}

/**
 * Delete student
 * @param int $id
 * @return array
 */
function deleteStudent($id) {
    global $conn;
    
    try {
        // Check if student has enrollments
        $stmt = $conn->prepare("SELECT COUNT(*) as count FROM enrollments WHERE student_id = ?");
        $stmt->execute([$id]);
        $result = $stmt->fetch();
        
        if ($result['count'] > 0) {
            return ['success' => false, 'errors' => ['Cannot delete student with existing enrollments.']];
        }
        
        $stmt = $conn->prepare("DELETE FROM students WHERE id = ?");
        $stmt->execute([$id]);
        
        return ['success' => true, 'message' => 'Student deleted successfully.'];
        
    } catch (PDOException $e) {
        error_log("Error deleting student: " . $e->getMessage());
        return ['success' => false, 'errors' => ['Failed to delete student. Please try again.']];
    }
}


