-- Student Academic Management System Database Schema
-- Created: 2024
-- Database: sams_db

CREATE DATABASE IF NOT EXISTS sams_db CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE sams_db;

-- Table: users
CREATE TABLE IF NOT EXISTS users (
    id INT(11) NOT NULL AUTO_INCREMENT,
    username VARCHAR(50) NOT NULL UNIQUE,
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    role VARCHAR(20) DEFAULT 'staff',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (id),
    INDEX idx_username (username),
    INDEX idx_email (email)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Table: students
CREATE TABLE IF NOT EXISTS students (
    id INT(11) NOT NULL AUTO_INCREMENT,
    student_id VARCHAR(20) NOT NULL UNIQUE,
    first_name VARCHAR(50) NOT NULL,
    last_name VARCHAR(50) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    phone VARCHAR(20),
    address TEXT,
    date_of_birth DATE,
    enrollment_date DATE NOT NULL,
    status VARCHAR(20) DEFAULT 'active',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (id),
    INDEX idx_student_id (student_id),
    INDEX idx_email (email),
    INDEX idx_status (status)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Table: courses
CREATE TABLE IF NOT EXISTS courses (
    id INT(11) NOT NULL AUTO_INCREMENT,
    course_code VARCHAR(20) NOT NULL UNIQUE,
    course_name VARCHAR(100) NOT NULL,
    credits INT(3) DEFAULT 3,
    description TEXT,
    capacity INT(5) DEFAULT 30,
    enrolled_count INT(5) DEFAULT 0,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (id),
    INDEX idx_course_code (course_code)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Table: enrollments
CREATE TABLE IF NOT EXISTS enrollments (
    id INT(11) NOT NULL AUTO_INCREMENT,
    student_id INT(11) NOT NULL,
    course_id INT(11) NOT NULL,
    enrollment_date DATE NOT NULL,
    status VARCHAR(20) DEFAULT 'enrolled',
    grade VARCHAR(5),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (id),
    FOREIGN KEY (student_id) REFERENCES students(id) ON DELETE CASCADE,
    FOREIGN KEY (course_id) REFERENCES courses(id) ON DELETE CASCADE,
    UNIQUE KEY unique_enrollment (student_id, course_id),
    INDEX idx_student_id (student_id),
    INDEX idx_course_id (course_id),
    INDEX idx_status (status)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Insert default admin user (password: admin123)
INSERT INTO users (username, email, password, role) VALUES
('admin', 'admin@sams.edu', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'admin');

-- Insert sample students
INSERT INTO students (student_id, first_name, last_name, email, phone, address, date_of_birth, enrollment_date, status) VALUES
('STU-2024-001', 'John', 'Doe', 'john.doe@student.edu', '555-0101', '123 Main Street, City, State 12345', '2000-05-15', '2024-01-10', 'active'),
('STU-2024-002', 'Jane', 'Smith', 'jane.smith@student.edu', '555-0102', '456 Oak Avenue, City, State 12345', '2001-03-22', '2024-01-10', 'active'),
('STU-2024-003', 'Robert', 'Johnson', 'robert.johnson@student.edu', '555-0103', '789 Pine Road, City, State 12345', '1999-11-08', '2024-01-12', 'active'),
('STU-2024-004', 'Emily', 'Williams', 'emily.williams@student.edu', '555-0104', '321 Elm Street, City, State 12345', '2000-07-30', '2024-01-12', 'active'),
('STU-2024-005', 'Michael', 'Brown', 'michael.brown@student.edu', '555-0105', '654 Maple Drive, City, State 12345', '2001-01-18', '2024-01-15', 'active');

-- Insert sample courses
INSERT INTO courses (course_code, course_name, credits, description, capacity) VALUES
('CS101', 'Introduction to Computer Science', 3, 'Fundamental concepts of programming and computer science', 30),
('CS201', 'Data Structures and Algorithms', 4, 'Advanced data structures and algorithm design', 25),
('MATH101', 'Calculus I', 4, 'Differential and integral calculus', 35),
('ENG101', 'English Composition', 3, 'Writing and communication skills', 40),
('PHYS101', 'Physics I', 4, 'Mechanics and thermodynamics', 30),
('HIST101', 'World History', 3, 'Survey of world history from ancient to modern times', 50);

-- Insert sample enrollments
INSERT INTO enrollments (student_id, course_id, enrollment_date, status, grade) VALUES
(1, 1, '2024-01-10', 'enrolled', NULL),
(1, 3, '2024-01-10', 'enrolled', NULL),
(1, 4, '2024-01-10', 'enrolled', NULL),
(2, 1, '2024-01-10', 'enrolled', NULL),
(2, 2, '2024-01-10', 'enrolled', NULL),
(2, 5, '2024-01-10', 'enrolled', NULL),
(3, 2, '2024-01-12', 'enrolled', NULL),
(3, 3, '2024-01-12', 'enrolled', NULL),
(4, 1, '2024-01-12', 'enrolled', NULL),
(4, 4, '2024-01-12', 'enrolled', NULL),
(4, 6, '2024-01-12', 'enrolled', NULL),
(5, 1, '2024-01-15', 'enrolled', NULL),
(5, 3, '2024-01-15', 'enrolled', NULL),
(5, 5, '2024-01-15', 'enrolled', NULL);

-- Update enrolled_count in courses table
UPDATE courses c
SET c.enrolled_count = (
    SELECT COUNT(*) 
    FROM enrollments e 
    WHERE e.course_id = c.id AND e.status = 'enrolled'
);


