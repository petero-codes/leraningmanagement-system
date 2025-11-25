/**
 * Student Academic Management System
 * Main JavaScript File
 */

// Form validation
document.addEventListener('DOMContentLoaded', function() {
    // Login form validation
    const loginForm = document.getElementById('loginForm');
    if (loginForm) {
        loginForm.addEventListener('submit', function(e) {
            const username = document.getElementById('username').value.trim();
            const password = document.getElementById('password').value;
            
            if (!username) {
                e.preventDefault();
                alert('Please enter your username or email.');
                return false;
            }
            
            if (!password) {
                e.preventDefault();
                alert('Please enter your password.');
                return false;
            }
        });
    }
    
    // Registration form validation
    const registerForm = document.getElementById('registerForm');
    if (registerForm) {
        registerForm.addEventListener('submit', function(e) {
            const username = document.getElementById('username').value.trim();
            const email = document.getElementById('email').value.trim();
            const password = document.getElementById('password').value;
            const confirmPassword = document.getElementById('confirm_password').value;
            
            if (username.length < 3) {
                e.preventDefault();
                alert('Username must be at least 3 characters long.');
                return false;
            }
            
            if (!validateEmail(email)) {
                e.preventDefault();
                alert('Please enter a valid email address.');
                return false;
            }
            
            if (password.length < 6) {
                e.preventDefault();
                alert('Password must be at least 6 characters long.');
                return false;
            }
            
            if (password !== confirmPassword) {
                e.preventDefault();
                alert('Passwords do not match.');
                return false;
            }
        });
    }
    
    // Student form validation
    const studentForm = document.getElementById('studentForm');
    if (studentForm) {
        studentForm.addEventListener('submit', function(e) {
            const studentId = document.getElementById('student_id').value.trim();
            const firstName = document.getElementById('first_name').value.trim();
            const lastName = document.getElementById('last_name').value.trim();
            const email = document.getElementById('email').value.trim();
            const enrollmentDate = document.getElementById('enrollment_date').value;
            
            if (!studentId) {
                e.preventDefault();
                alert('Student ID is required.');
                return false;
            }
            
            if (!firstName) {
                e.preventDefault();
                alert('First name is required.');
                return false;
            }
            
            if (!lastName) {
                e.preventDefault();
                alert('Last name is required.');
                return false;
            }
            
            if (!validateEmail(email)) {
                e.preventDefault();
                alert('Please enter a valid email address.');
                return false;
            }
            
            if (!enrollmentDate) {
                e.preventDefault();
                alert('Enrollment date is required.');
                return false;
            }
        });
    }
    
    // Course form validation
    const courseForm = document.getElementById('courseForm');
    if (courseForm) {
        courseForm.addEventListener('submit', function(e) {
            const courseCode = document.getElementById('course_code').value.trim();
            const courseName = document.getElementById('course_name').value.trim();
            const credits = parseInt(document.getElementById('credits').value);
            const capacity = parseInt(document.getElementById('capacity').value);
            
            if (!courseCode) {
                e.preventDefault();
                alert('Course code is required.');
                return false;
            }
            
            if (!courseName) {
                e.preventDefault();
                alert('Course name is required.');
                return false;
            }
            
            if (!credits || credits < 1 || credits > 6) {
                e.preventDefault();
                alert('Credits must be between 1 and 6.');
                return false;
            }
            
            if (!capacity || capacity < 1) {
                e.preventDefault();
                alert('Capacity must be at least 1.');
                return false;
            }
        });
    }
    
    // Enrollment form validation
    const enrollmentForm = document.getElementById('enrollmentForm');
    if (enrollmentForm) {
        enrollmentForm.addEventListener('submit', function(e) {
            const studentId = document.getElementById('student_id').value;
            const courseId = document.getElementById('course_id').value;
            const enrollmentDate = document.getElementById('enrollment_date').value;
            
            if (!studentId) {
                e.preventDefault();
                alert('Please select a student.');
                return false;
            }
            
            if (!courseId) {
                e.preventDefault();
                alert('Please select a course.');
                return false;
            }
            
            if (!enrollmentDate) {
                e.preventDefault();
                alert('Enrollment date is required.');
                return false;
            }
        });
    }
    
    // Auto-hide alerts after 5 seconds
    const alerts = document.querySelectorAll('.alert');
    alerts.forEach(function(alert) {
        setTimeout(function() {
            alert.style.transition = 'opacity 0.5s';
            alert.style.opacity = '0';
            setTimeout(function() {
                alert.remove();
            }, 500);
        }, 5000);
    });
});

/**
 * Validate email format
 */
function validateEmail(email) {
    const re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return re.test(email);
}

/**
 * Filter table rows based on search input
 */
function filterTable() {
    const input = document.getElementById('searchInput');
    const filter = input.value.toLowerCase();
    const table = document.getElementById('studentsTable');
    const rows = table.getElementsByTagName('tr');
    
    for (let i = 1; i < rows.length; i++) {
        const row = rows[i];
        const cells = row.getElementsByTagName('td');
        let found = false;
        
        for (let j = 0; j < cells.length; j++) {
            const cellText = cells[j].textContent || cells[j].innerText;
            if (cellText.toLowerCase().indexOf(filter) > -1) {
                found = true;
                break;
            }
        }
        
        row.style.display = found ? '' : 'none';
    }
}

/**
 * Confirm delete action
 */
function confirmDelete(message) {
    return confirm(message || 'Are you sure you want to delete this item?');
}


