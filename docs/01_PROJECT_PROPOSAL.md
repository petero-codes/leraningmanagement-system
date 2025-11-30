# PROJECT PROPOSAL

## 1.1 Project Title

**Title Options:**

1. **Student Academic Management System (SAMS)** - A comprehensive web-based platform for managing student records, academic performance, and institutional reporting.

2. **Digital Student Information Management System (DSIMS)** - An integrated solution for educational institutions to digitize student data management and academic tracking.

3. **Academic Record Management System (ARMS)** - A dynamic web application for efficient student enrollment, course management, and academic reporting.

**Final Selected Title: Student Academic Management System (SAMS)**

---

## 1.2 Group Members

- **Member 1:** John Michael Smith (Project Lead)
- **Member 2:** Sarah Elizabeth Johnson (Backend Developer)
- **Member 3:** David Robert Williams (Frontend Developer)
- **Member 4:** Emily Grace Brown (Database Administrator)

---

## 1.3 Problem Statement

Educational institutions, particularly schools and colleges, face significant challenges in managing student information, academic records, and institutional data using traditional paper-based or fragmented digital systems. The current manual processes lead to:

- **Data Inconsistency:** Student information scattered across multiple files and departments
- **Time Inefficiency:** Administrative staff spend excessive time on repetitive data entry and retrieval tasks
- **Error-Prone Operations:** Manual record-keeping increases the likelihood of data entry errors and loss of information
- **Limited Accessibility:** Student records are not easily accessible to authorized personnel when needed
- **Poor Reporting Capabilities:** Generating academic reports, summaries, and analytics requires extensive manual compilation
- **Security Concerns:** Physical files and unsecured digital documents pose risks to student privacy and data integrity

The absence of a centralized, web-based student management system prevents institutions from efficiently tracking student enrollment, academic performance, course assignments, and generating timely reports for decision-making.

---

## 1.4 Problem Justification

The development of a Student Academic Management System addresses critical operational inefficiencies in educational administration:

**1. Operational Efficiency:**
- Reduces administrative workload by automating routine tasks
- Enables quick data retrieval and updates
- Minimizes redundant data entry across departments

**2. Data Accuracy and Integrity:**
- Centralized database ensures single source of truth
- Automated validation reduces human errors
- Maintains data consistency across all system modules

**3. Improved Decision-Making:**
- Real-time access to student data and academic reports
- Data-driven insights for institutional planning
- Enhanced ability to track student progress and performance

**4. Cost Reduction:**
- Eliminates need for physical storage space
- Reduces paper and printing costs
- Decreases time spent on manual record management

**5. Enhanced Security:**
- Role-based access control protects sensitive student information
- Secure authentication mechanisms prevent unauthorized access
- Regular backups ensure data preservation

**6. Scalability:**
- System can accommodate growing student populations
- Easy to add new features and modules as needed
- Supports multiple users simultaneously

**Expected Benefits:**
- 70% reduction in time spent on administrative tasks
- 90% improvement in data accuracy
- Instant report generation capability
- 24/7 accessibility for authorized users
- Improved student service delivery

---

## 1.5 Objectives

### General Objective

To develop a comprehensive, web-based Student Academic Management System that automates student record management, course administration, and academic reporting, thereby improving operational efficiency, data accuracy, and decision-making capabilities for educational institutions.

### Specific Objectives

1. **To design and implement a secure user authentication system** that allows authorized personnel (administrators, staff) to access the system with role-based permissions, ensuring data security and privacy.

2. **To develop a centralized database system** that stores and manages student information, course details, enrollment records, and academic performance data with proper relationships and data integrity constraints.

3. **To create a complete CRUD (Create, Read, Update, Delete) interface** for managing student records, including personal information, contact details, academic status, and course enrollments, with validation and error handling.

4. **To implement a reporting module** that generates at least three different types of academic reports (student summary reports, course enrollment statistics, and academic performance analytics) in a user-friendly format.

5. **To build a responsive and intuitive user interface** that works seamlessly across different devices (desktop, tablet, mobile) and provides an excellent user experience for all system users.

6. **To ensure system security** through prepared SQL statements, input validation, session management, and secure password handling to protect against common web vulnerabilities.

---

## 1.6 Methodology

### System Development Approach

**Iterative Development Model:**

The project follows an iterative development approach, allowing for incremental improvements and continuous feedback integration:

- **Phase 1: Planning & Analysis** - Requirements gathering, system analysis, and design
- **Phase 2: Design** - Database design, UI/UX wireframes, system architecture
- **Phase 3: Development** - Core functionality implementation (authentication, CRUD operations)
- **Phase 4: Enhancement** - Reports module, UI refinement, security hardening
- **Phase 5: Testing** - Unit testing, integration testing, user acceptance testing
- **Phase 6: Deployment** - Server setup, database migration, go-live

### Technologies

**Frontend Technologies:**
- **HTML5:** Semantic markup for structure
- **CSS3:** Styling, responsive design, modern UI components
- **JavaScript (ES6+):** Client-side validation, dynamic interactions, AJAX operations

**Backend Technologies:**
- **PHP 7.4+:** Server-side scripting, business logic, data processing
- **PostgreSQL 18+:** Relational database management system

**Additional Tools:**
- **Git:** Version control
- **phpMyAdmin:** Database administration
- **VS Code / PHPStorm:** Development environment

### Client-Server Architecture

The system follows a traditional three-tier client-server architecture:

```
┌─────────────────┐
│   Presentation  │  HTML, CSS, JavaScript
│      Layer      │  (Client Browser)
┌─────────────────┐
│  Application    │  PHP Scripts
│      Layer      │  Business Logic
┌─────────────────┐
│    Database     │  PostgreSQL Database
│      Layer      │  Data Storage
└─────────────────┘
```

**Client Side:**
- Web browser renders HTML/CSS/JS
- Handles user interactions and form validation
- Sends HTTP requests to server

**Server Side:**
- PHP processes requests
- Executes business logic
- Interacts with PostgreSQL database
- Returns HTML/JSON responses

### Database Plan

**Database Design Strategy:**
- Normalized relational database (3NF)
- Primary keys for unique identification
- Foreign keys for referential integrity
- Indexes for performance optimization
- Proper data types for each field

**Core Tables:**
- `users` - System users (administrators, staff)
- `students` - Student personal and academic information
- `courses` - Course catalog
- `enrollments` - Student-course relationships
- `grades` - Academic performance records

### System Modules

**1. Authentication Module**
- User registration
- Login/logout functionality
- Session management
- Password security

**2. Student Management Module**
- Add new students
- View student list
- Update student information
- Delete student records
- Search and filter students

**3. Course Management Module**
- Create courses
- View course catalog
- Update course details
- Delete courses
- Manage course capacity

**4. Enrollment Module**
- Enroll students in courses
- View enrollment records
- Update enrollment status
- Drop enrollments

**5. Reporting Module**
- Student summary report
- Course enrollment statistics
- Academic performance report
- Export capabilities

**6. Dashboard Module**
- System overview
- Quick statistics
- Recent activities
- Navigation hub

---

## 1.7 System Analysis

### Functional Requirements

**FR1: User Authentication**
- System shall allow users to register with username, email, and password
- System shall authenticate users during login
- System shall maintain user sessions after successful login
- System shall log out users and destroy sessions

**FR2: Student Management**
- System shall allow authorized users to add new student records
- System shall display a list of all registered students
- System shall enable editing of existing student information
- System shall allow deletion of student records
- System shall validate student data before saving

**FR3: Course Management**
- System shall allow creation of new courses with details (code, name, credits, description)
- System shall display all available courses
- System shall enable modification of course information
- System shall allow deletion of courses
- System shall track course capacity and enrollment count

**FR4: Enrollment Management**
- System shall allow enrollment of students in courses
- System shall prevent duplicate enrollments
- System shall check course capacity before enrollment
- System shall display all enrollments for a student
- System shall allow dropping of enrollments

**FR5: Data Validation**
- System shall validate all form inputs on client-side
- System shall perform server-side validation for security
- System shall display appropriate error messages
- System shall prevent SQL injection attacks

**FR6: Search and Filter**
- System shall provide search functionality for students
- System shall allow filtering students by various criteria
- System shall provide quick access to student records

**FR7: Reporting**
- System shall generate student summary reports
- System shall create course enrollment statistics
- System shall produce academic performance reports
- System shall format reports in readable tables

**FR8: Session Management**
- System shall maintain user sessions securely
- System shall redirect unauthorized users to login
- System shall handle session expiration
- System shall protect pages requiring authentication

**FR9: Error Handling**
- System shall handle database connection errors gracefully
- System shall display user-friendly error messages
- System shall log errors for debugging
- System shall prevent system crashes

**FR10: Data Security**
- System shall use prepared statements for database queries
- System shall hash passwords using secure algorithms
- System shall sanitize all user inputs
- System shall protect against XSS attacks

### Non-Functional Requirements

**NFR1: Performance**
- System shall load pages within 2 seconds under normal load
- Database queries shall execute within 500ms
- System shall support at least 100 concurrent users

**NFR2: Usability**
- System shall have an intuitive user interface
- System shall provide clear navigation
- System shall display helpful error messages
- System shall be accessible to users with basic computer skills

**NFR3: Reliability**
- System shall have 99% uptime availability
- System shall handle errors without crashing
- System shall recover gracefully from failures
- System shall maintain data integrity

**NFR4: Security**
- System shall encrypt sensitive data in transit
- System shall protect against SQL injection
- System shall prevent unauthorized access
- System shall implement secure session management

**NFR5: Scalability**
- System shall handle increasing number of students
- Database design shall support growth
- System architecture shall allow feature additions
- System shall perform well with large datasets

**NFR6: Maintainability**
- Code shall follow PHP best practices
- Code shall be well-documented
- System shall have modular structure
- Code shall be reusable and organized

**NFR7: Compatibility**
- System shall work on major web browsers (Chrome, Firefox, Safari, Edge)
- System shall be responsive on mobile devices
- System shall support PHP 7.4 and above
- System shall work with PostgreSQL 18 and above

**NFR8: Portability**
- System shall be deployable on various hosting platforms
- Database schema shall be portable
- Configuration shall be externalized
- System shall not depend on specific server configurations

---

## UML Diagrams

### Use Case Diagram

```
                    Student Academic Management System
                            ┌─────────────────────┐
                            │                     │
    ┌──────────────┐        │                     │        ┌──────────────┐
    │ Administrator│        │                     │        │    Staff     │
    └──────┬───────┘        │                     │        └──────┬───────┘
           │                │                     │               │
           │                │                     │               │
           │  ┌─────────────▼─────────────┐      │               │
           │  │   Login to System         │      │               │
           │  └─────────────┬─────────────┘      │               │
           │                │                    │               │
           │  ┌─────────────▼─────────────┐      │               │
           │  │   View Dashboard          │      │               │
           │  └─────────────┬─────────────┘      │               │
           │                │                    │               │
           │  ┌─────────────▼─────────────┐      │               │
           │  │   Manage Students         │      │               │
           │  │   (CRUD Operations)       │      │               │
           │  └─────────────┬─────────────┘      │               │
           │                │                    │               │
           │  ┌─────────────▼─────────────┐      │               │
           │  │   Manage Courses          │      │               │
           │  │   (CRUD Operations)       │      │               │
           │  └─────────────┬─────────────┘      │               │
           │                │                    │               │
           │  ┌─────────────▼─────────────┐      │               │
           │  │   Manage Enrollments      │      │               │
           │  └─────────────┬─────────────┘      │               │
           │                │                    │               │
           │  ┌─────────────▼─────────────┐      │               │
           │  │   Generate Reports        │      │               │
           │  └─────────────┬─────────────┘      │               │
           │                │                    │               │
           │  ┌─────────────▼─────────────┐      │               │
           │  │   Logout                  │      │               │
           │  └───────────────────────────┘      │               │
           │                                     │               │
           └─────────────────────────────────────┴───────────────┘
```

### Use Case Descriptions

**UC1: Login to System**
- **Actor:** Administrator, Staff
- **Precondition:** User has valid account credentials
- **Main Flow:**
  1. User navigates to login page
  2. User enters username and password
  3. System validates credentials
  4. System creates session
  5. System redirects to dashboard
- **Alternative Flow:** Invalid credentials → Display error message
- **Postcondition:** User is logged in and can access system

**UC2: Manage Students (CRUD)**
- **Actor:** Administrator
- **Precondition:** User is logged in
- **Main Flow:**
  1. User navigates to Students page
  2. User selects action (Add/Edit/Delete/View)
  3. System displays appropriate form/list
  4. User performs operation
  5. System validates and saves data
  6. System confirms operation
- **Postcondition:** Student data is updated in database

**UC3: Generate Reports**
- **Actor:** Administrator, Staff
- **Precondition:** User is logged in
- **Main Flow:**
  1. User navigates to Reports page
  2. User selects report type
  3. System queries database
  4. System formats and displays report
  5. User can view/export report
- **Postcondition:** Report is generated and displayed

### Activity Diagram

```
[Start] → [Display Login Page] → [Enter Credentials] → [Validate Credentials]
    │                                                              │
    │                                                              │
    └────────────────────────────────────────────────────────────┘
                                 │
                                 │ Valid?
                                 │
                    ┌────────────┴────────────┐
                    │                         │
                 Yes│                         │No
                    │                         │
                    ▼                         ▼
        [Create Session]          [Display Error Message]
                    │                         │
                    │                         │
                    ▼                         └─────────────┐
        [Redirect to Dashboard]                              │
                    │                                        │
                    ▼                                        │
        [Display Dashboard]                                  │
                    │                                        │
                    ▼                                        │
        [Select Module]                                      │
                    │                                        │
        ┌───────────┴───────────┐                           │
        │                       │                           │
        ▼                       ▼                           │
[Student Management]    [Course Management]                 │
        │                       │                           │
        ▼                       ▼                           │
[Perform CRUD]          [Perform CRUD]                       │
        │                       │                           │
        └───────────┬───────────┘                           │
                    │                                       │
                    ▼                                       │
        [Generate Reports]                                  │
                    │                                       │
                    ▼                                       │
        [Logout] → [Destroy Session] → [End]                │
                                                             │
                                                             │
                                                             └──→[Retry Login]
```

### Class Diagram

```
┌─────────────────────┐
│       User          │
├─────────────────────┤
│ - id: int           │
│ - username: string  │
│ - email: string     │
│ - password: string  │
│ - role: string      │
│ - created_at: date  │
├─────────────────────┤
│ + login()           │
│ + logout()          │
│ + register()        │
└─────────────────────┘
         │
         │
┌────────▼────────────┐
│     Student         │
├─────────────────────┤
│ - id: int           │
│ - student_id: string│
│ - first_name: string│
│ - last_name: string │
│ - email: string     │
│ - phone: string     │
│ - address: string   │
│ - date_of_birth:date│
│ - enrollment_date:date│
│ - status: string    │
├─────────────────────┤
│ + create()          │
│ + read()            │
│ + update()          │
│ + delete()          │
│ + search()          │
└─────────────────────┘
         │
         │
┌────────▼────────────┐
│      Course         │
├─────────────────────┤
│ - id: int           │
│ - course_code: string│
│ - course_name: string│
│ - credits: int      │
│ - description: text │
│ - capacity: int     │
│ - enrolled: int     │
├─────────────────────┤
│ + create()          │
│ + read()            │
│ + update()          │
│ + delete()          │
└─────────────────────┘
         │
         │
┌────────▼────────────┐
│    Enrollment       │
├─────────────────────┤
│ - id: int           │
│ - student_id: int   │
│ - course_id: int    │
│ - enrollment_date:date│
│ - status: string    │
├─────────────────────┤
│ + enroll()          │
│ + drop()            │
│ + getByStudent()    │
│ + getByCourse()     │
└─────────────────────┘
         │
         │
┌────────▼────────────┐
│   DatabaseHandler   │
├─────────────────────┤
│ - connection: PDO   │
├─────────────────────┤
│ + connect()         │
│ + query()           │
│ + prepare()         │
│ + execute()         │
│ + fetch()           │
│ + close()           │
└─────────────────────┘
```

### Sequence Diagram

```
User          Browser         PHP Controller      Database
 │               │                  │                │
 │──Login Form──>│                  │                │
 │               │──POST Request───>│                │
 │               │                  │──Validate──────>│
 │               │                  │                │
 │               │                  │<──User Data────│
 │               │                  │                │
 │               │                  │──Create Session│
 │               │<──Session Set────│                │
 │               │                  │                │
 │<──Dashboard───│<──HTML Response─│                │
 │               │                  │                │
 │──View Students>│                  │                │
 │               │──GET Request────>│                │
 │               │                  │──SELECT Query─>│
 │               │                  │                │
 │               │                  │<──Student List─│
 │               │                  │                │
 │<──Student List│<──HTML Response─│                │
 │               │                  │                │
 │──Add Student──>│                  │                │
 │               │──POST Request───>│                │
 │               │                  │──INSERT Query─>│
 │               │                  │                │
 │               │                  │<──Success──────│
 │               │                  │                │
 │<──Confirmation│<──HTML Response─│                │
 │               │                  │                │
```

---

*End of Project Proposal*


