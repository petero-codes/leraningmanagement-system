<?php
/**
 * Enrollment CRUD Operations
 */

require_once __DIR__ . '/../config/config.php';
requireLogin();

/**
 * Get all enrollments with student and course details
 * @return array
 */
function getAllEnrollments() {
    global $conn;
    
    try {
        $stmt = $conn->prepare("
            SELECT e.*, 
                   s.student_id, s.first_name, s.last_name,
                   c.course_code, c.course_name, c.credits
            FROM enrollments e
            INNER JOIN students s ON e.student_id = s.id
            INNER JOIN courses c ON e.course_id = c.id
            ORDER BY e.enrollment_date DESC
        ");
        $stmt->execute();
        return $stmt->fetchAll();
    } catch (PDOException $e) {
        error_log("Error fetching enrollments: " . $e->getMessage());
        return [];
    }
}

/**
 * Get enrollments by student ID
 * @param int $studentId
 * @return array
 */
function getEnrollmentsByStudent($studentId) {
    global $conn;
    
    try {
        $stmt = $conn->prepare("
            SELECT e.*, c.course_code, c.course_name, c.credits
            FROM enrollments e
            INNER JOIN courses c ON e.course_id = c.id
            WHERE e.student_id = ?
            ORDER BY e.enrollment_date DESC
        ");
        $stmt->execute([$studentId]);
        return $stmt->fetchAll();
    } catch (PDOException $e) {
        error_log("Error fetching student enrollments: " . $e->getMessage());
        return [];
    }
}

/**
 * Create new enrollment
 * @param array $data
 * @return array
 */
function createEnrollment($data) {
    global $conn;
    
    $errors = [];
    
    // Validation
    if (empty($data['student_id'])) {
        $errors[] = "Student is required.";
    }
    if (empty($data['course_id'])) {
        $errors[] = "Course is required.";
    }
    if (empty($data['enrollment_date'])) {
        $errors[] = "Enrollment date is required.";
    }
    
    if (!empty($errors)) {
        return ['success' => false, 'errors' => $errors];
    }
    
    try {
        // Check if enrollment already exists
        $stmt = $conn->prepare("SELECT id FROM enrollments WHERE student_id = ? AND course_id = ?");
        $stmt->execute([$data['student_id'], $data['course_id']]);
        if ($stmt->fetch()) {
            return ['success' => false, 'errors' => ['Student is already enrolled in this course.']];
        }
        
        // Check course capacity
        $stmt = $conn->prepare("SELECT capacity, enrolled_count FROM courses WHERE id = ?");
        $stmt->execute([$data['course_id']]);
        $course = $stmt->fetch();
        
        if ($course && $course['enrolled_count'] >= $course['capacity']) {
            return ['success' => false, 'errors' => ['Course is at full capacity.']];
        }
        
        // Insert enrollment
        $stmt = $conn->prepare("INSERT INTO enrollments (student_id, course_id, enrollment_date, status) VALUES (?, ?, ?, ?)");
        $stmt->execute([
            $data['student_id'],
            $data['course_id'],
            $data['enrollment_date'],
            $data['status'] ?? 'enrolled'
        ]);
        
        // Update course enrolled_count
        $stmt = $conn->prepare("UPDATE courses SET enrolled_count = enrolled_count + 1 WHERE id = ?");
        $stmt->execute([$data['course_id']]);
        
        return ['success' => true, 'message' => 'Enrollment created successfully.'];
        
    } catch (PDOException $e) {
        error_log("Error creating enrollment: " . $e->getMessage());
        return ['success' => false, 'errors' => ['Failed to create enrollment. Please try again.']];
    }
}

/**
 * Update enrollment
 * @param int $id
 * @param array $data
 * @return array
 */
function updateEnrollment($id, $data) {
    global $conn;
    
    $errors = [];
    
    // Validation
    if (empty($data['status'])) {
        $errors[] = "Status is required.";
    }
    
    if (!empty($errors)) {
        return ['success' => false, 'errors' => $errors];
    }
    
    try {
        // Get current enrollment to check if status changed from enrolled
        $stmt = $conn->prepare("SELECT course_id, status FROM enrollments WHERE id = ?");
        $stmt->execute([$id]);
        $current = $stmt->fetch();
        
        // Update enrollment
        $stmt = $conn->prepare("UPDATE enrollments SET status = ?, grade = ? WHERE id = ?");
        $stmt->execute([
            $data['status'],
            $data['grade'] ?? null,
            $id
        ]);
        
        // Update course enrolled_count if status changed
        if ($current && $current['status'] === 'enrolled' && $data['status'] !== 'enrolled') {
            $stmt = $conn->prepare("UPDATE courses SET enrolled_count = enrolled_count - 1 WHERE id = ?");
            $stmt->execute([$current['course_id']]);
        } elseif ($current && $current['status'] !== 'enrolled' && $data['status'] === 'enrolled') {
            $stmt = $conn->prepare("UPDATE courses SET enrolled_count = enrolled_count + 1 WHERE id = ?");
            $stmt->execute([$current['course_id']]);
        }
        
        return ['success' => true, 'message' => 'Enrollment updated successfully.'];
        
    } catch (PDOException $e) {
        error_log("Error updating enrollment: " . $e->getMessage());
        return ['success' => false, 'errors' => ['Failed to update enrollment. Please try again.']];
    }
}

/**
 * Delete enrollment
 * @param int $id
 * @return array
 */
function deleteEnrollment($id) {
    global $conn;
    
    try {
        // Get enrollment details before deletion
        $stmt = $conn->prepare("SELECT course_id, status FROM enrollments WHERE id = ?");
        $stmt->execute([$id]);
        $enrollment = $stmt->fetch();
        
        // Delete enrollment
        $stmt = $conn->prepare("DELETE FROM enrollments WHERE id = ?");
        $stmt->execute([$id]);
        
        // Update course enrolled_count if was enrolled
        if ($enrollment && $enrollment['status'] === 'enrolled') {
            $stmt = $conn->prepare("UPDATE courses SET enrolled_count = enrolled_count - 1 WHERE id = ?");
            $stmt->execute([$enrollment['course_id']]);
        }
        
        return ['success' => true, 'message' => 'Enrollment deleted successfully.'];
        
    } catch (PDOException $e) {
        error_log("Error deleting enrollment: " . $e->getMessage());
        return ['success' => false, 'errors' => ['Failed to delete enrollment. Please try again.']];
    }
}


