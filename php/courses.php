<?php
/**
 * Course CRUD Operations
 */

require_once __DIR__ . '/../config/config.php';
requireLogin();

/**
 * Get all courses
 * @return array
 */
function getAllCourses() {
    global $conn;
    
    try {
        $stmt = $conn->prepare("SELECT * FROM courses ORDER BY course_code ASC");
        $stmt->execute();
        return $stmt->fetchAll();
    } catch (PDOException $e) {
        error_log("Error fetching courses: " . $e->getMessage());
        return [];
    }
}

/**
 * Get course by ID
 * @param int $id
 * @return array|null
 */
function getCourseById($id) {
    global $conn;
    
    try {
        $stmt = $conn->prepare("SELECT * FROM courses WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch();
    } catch (PDOException $e) {
        error_log("Error fetching course: " . $e->getMessage());
        return null;
    }
}

/**
 * Create new course
 * @param array $data
 * @return array
 */
function createCourse($data) {
    global $conn;
    
    $errors = [];
    
    // Validation
    if (empty($data['course_code'])) {
        $errors[] = "Course code is required.";
    }
    if (empty($data['course_name'])) {
        $errors[] = "Course name is required.";
    }
    if (empty($data['credits']) || !is_numeric($data['credits'])) {
        $errors[] = "Valid credits value is required.";
    }
    if (empty($data['capacity']) || !is_numeric($data['capacity'])) {
        $errors[] = "Valid capacity value is required.";
    }
    
    if (!empty($errors)) {
        return ['success' => false, 'errors' => $errors];
    }
    
    try {
        // Check if course_code already exists
        $stmt = $conn->prepare("SELECT id FROM courses WHERE course_code = ?");
        $stmt->execute([$data['course_code']]);
        if ($stmt->fetch()) {
            return ['success' => false, 'errors' => ['Course code already exists.']];
        }
        
        // Insert course
        $stmt = $conn->prepare("INSERT INTO courses (course_code, course_name, credits, description, capacity) VALUES (?, ?, ?, ?, ?)");
        $stmt->execute([
            $data['course_code'],
            $data['course_name'],
            $data['credits'],
            $data['description'] ?? null,
            $data['capacity']
        ]);
        
        return ['success' => true, 'message' => 'Course created successfully.'];
        
    } catch (PDOException $e) {
        error_log("Error creating course: " . $e->getMessage());
        return ['success' => false, 'errors' => ['Failed to create course. Please try again.']];
    }
}

/**
 * Update course
 * @param int $id
 * @param array $data
 * @return array
 */
function updateCourse($id, $data) {
    global $conn;
    
    $errors = [];
    
    // Validation (same as create)
    if (empty($data['course_code'])) {
        $errors[] = "Course code is required.";
    }
    if (empty($data['course_name'])) {
        $errors[] = "Course name is required.";
    }
    if (empty($data['credits']) || !is_numeric($data['credits'])) {
        $errors[] = "Valid credits value is required.";
    }
    if (empty($data['capacity']) || !is_numeric($data['capacity'])) {
        $errors[] = "Valid capacity value is required.";
    }
    
    if (!empty($errors)) {
        return ['success' => false, 'errors' => $errors];
    }
    
    try {
        // Check if course_code exists for another course
        $stmt = $conn->prepare("SELECT id FROM courses WHERE course_code = ? AND id != ?");
        $stmt->execute([$data['course_code'], $id]);
        if ($stmt->fetch()) {
            return ['success' => false, 'errors' => ['Course code already exists for another course.']];
        }
        
        // Update course
        $stmt = $conn->prepare("UPDATE courses SET course_code = ?, course_name = ?, credits = ?, description = ?, capacity = ? WHERE id = ?");
        $stmt->execute([
            $data['course_code'],
            $data['course_name'],
            $data['credits'],
            $data['description'] ?? null,
            $data['capacity'],
            $id
        ]);
        
        return ['success' => true, 'message' => 'Course updated successfully.'];
        
    } catch (PDOException $e) {
        error_log("Error updating course: " . $e->getMessage());
        return ['success' => false, 'errors' => ['Failed to update course. Please try again.']];
    }
}

/**
 * Delete course
 * @param int $id
 * @return array
 */
function deleteCourse($id) {
    global $conn;
    
    try {
        // Check if course has enrollments
        $stmt = $conn->prepare("SELECT COUNT(*) as count FROM enrollments WHERE course_id = ?");
        $stmt->execute([$id]);
        $result = $stmt->fetch();
        
        if ($result['count'] > 0) {
            return ['success' => false, 'errors' => ['Cannot delete course with existing enrollments.']];
        }
        
        $stmt = $conn->prepare("DELETE FROM courses WHERE id = ?");
        $stmt->execute([$id]);
        
        return ['success' => true, 'message' => 'Course deleted successfully.'];
        
    } catch (PDOException $e) {
        error_log("Error deleting course: " . $e->getMessage());
        return ['success' => false, 'errors' => ['Failed to delete course. Please try again.']];
    }
}


