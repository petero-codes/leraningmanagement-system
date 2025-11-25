# SYSTEM DESIGN

## 2.1 Flowcharts

### Flowchart: User Registration

```
                    [START]
                       │
                       ▼
            [Display Registration Form]
                       │
                       ▼
        [User Enters: Username, Email, Password]
                       │
                       ▼
            [Client-Side Validation]
                       │
                       ▼
            ┌──────────┴──────────┐
            │                     │
         Valid?                 Invalid?
            │                     │
            ▼                     ▼
    [Submit to Server]    [Display Error Messages]
            │                     │
            │                     └───┐
            │                         │
            ▼                         │
    [Server-Side Validation]          │
            │                         │
            ▼                         │
    ┌───────┴────────┐                │
    │                │                │
 Valid?          Invalid?            │
    │                │                │
    ▼                ▼                │
[Check if Username/Email Exists] [Return Error]──┘
    │
    ▼
┌───┴────┐
│        │
Exists?  Not Exists?
│        │
▼        ▼
[Return Error] [Hash Password]
                │
                ▼
        [Insert into Database]
                │
                ▼
        [Registration Success]
                │
                ▼
        [Redirect to Login]
                │
                ▼
              [END]
```

### Flowchart: Login

```
                    [START]
                       │
                       ▼
            [Display Login Form]
                       │
                       ▼
        [User Enters: Username, Password]
                       │
                       ▼
            [Client-Side Validation]
                       │
                       ▼
            ┌──────────┴──────────┐
            │                     │
         Valid?                 Invalid?
            │                     │
            ▼                     ▼
    [Submit to Server]    [Display Error Messages]
            │                     │
            │                     └───┐
            │                         │
            ▼                         │
    [Server-Side Validation]          │
            │                         │
            ▼                         │
    [Query Database for User]         │
            │                         │
            ▼                         │
    ┌───────┴────────┐                │
    │                │                │
 User Found?     User Not Found?      │
    │                │                │
    ▼                ▼                │
[Verify Password] [Return Error]──────┘
    │
    ▼
┌───┴────┐
│        │
Match?   No Match?
│        │
▼        ▼
[Create Session] [Return Error]──┐
    │                           │
    ▼                           │
[Set Session Variables]         │
    │                           │
    ▼                           │
[Redirect to Dashboard]         │
    │                           │
    ▼                           │
              [END]             │
                                │
                                └───┐
                                    │
                            [Retry Login]
                                    │
                                    └───→ [START]
```

### Flowchart: CRUD Operations

```
                    [START]
                       │
                       ▼
            [Display CRUD Menu]
                       │
                       ▼
    ┌──────────────────┼──────────────────┐
    │                  │                  │
    ▼                  ▼                  ▼
[CREATE]          [READ]            [UPDATE/DELETE]
    │                  │                  │
    ▼                  ▼                  ▼
[Display Form]  [Query Database]   [Display List]
    │                  │                  │
    ▼                  ▼                  ▼
[User Input]     [Fetch Records]   [Select Record]
    │                  │                  │
    ▼                  ▼                  ▼
[Validate]       [Display List]    [Display Form]
    │                  │                  │
    ▼                  ▼                  ▼
┌───┴────┐        [END]            [User Modifies]
│        │                          │
Valid? Invalid?                     ▼
│        │                    [Validate]
│        │                          │
▼        ▼                          ▼
[Insert] [Error]            ┌───────┴───────┐
    │                      │               │
    ▼                  [UPDATE]        [DELETE]
[Success]                  │               │
    │                      ▼               ▼
    │              [Update Query]   [Delete Query]
    │                      │               │
    │                      ▼               ▼
    │              [Success]         [Success]
    │                      │               │
    └──────────────────────┴───────────────┘
                            │
                            ▼
                        [Refresh List]
                            │
                            ▼
                          [END]
```

### Flowchart: Report Generation

```
                    [START]
                       │
                       ▼
        [Display Report Selection Menu]
                       │
                       ▼
    ┌──────────────────┼──────────────────┐
    │                  │                  │
    ▼                  ▼                  ▼
[Student Summary] [Enrollment Stats] [Performance Report]
    │                  │                  │
    ▼                  ▼                  ▼
[Select Parameters] [Select Course/Date] [Select Criteria]
    │                  │                  │
    ▼                  ▼                  ▼
[Query Database]  [Query Database]   [Query Database]
    │                  │                  │
    ▼                  ▼                  ▼
[Join Tables]     [Aggregate Data]   [Calculate Metrics]
    │                  │                  │
    ▼                  ▼                  ▼
[Format Data]     [Format Data]      [Format Data]
    │                  │                  │
    ▼                  ▼                  ▼
[Generate Table]  [Generate Chart]   [Generate Summary]
    │                  │                  │
    └──────────────────┴──────────────────┘
                            │
                            ▼
                    [Display Report]
                            │
                            ▼
                ┌───────────┴───────────┐
                │                       │
                ▼                       ▼
        [Export to PDF/CSV]      [Print Report]
                │                       │
                └───────────┬───────────┘
                            │
                            ▼
                          [END]
```

---

## 2.2 Database Design

### ERD (Entity Relationship Diagram) - Text-Based

```
┌─────────────────┐
│      USERS      │
├─────────────────┤
│ PK id            │
│    username      │
│    email         │
│    password      │
│    role          │
│    created_at    │
└────────┬────────┘
         │
         │ (1:N)
         │
┌────────▼────────┐
│    STUDENTS     │
├─────────────────┤
│ PK id            │
│    student_id    │
│    first_name    │
│    last_name     │
│    email         │
│    phone         │
│    address       │
│    date_of_birth │
│    enrollment_date│
│    status        │
│    created_at    │
└────────┬────────┘
         │
         │ (1:N)
         │
┌────────▼─────────────────┐
│      ENROLLMENTS         │
├──────────────────────────┤
│ PK id                    │
│ FK student_id            │──────┐
│ FK course_id             │──┐   │
│    enrollment_date       │  │   │
│    status                │  │   │
│    grade                 │  │   │
│    created_at            │  │   │
└──────────────────────────┘  │   │
                               │   │
                               │   │ (N:1)
                               │   │
┌──────────────────────────────┘   │
│         COURSES                 │
├─────────────────────────────────┤
│ PK id                            │
│    course_code                   │
│    course_name                   │
│    credits                       │
│    description                   │
│    capacity                      │
│    enrolled_count                │
│    created_at                    │
└──────────────────────────────────┘
```

### Database Schema

#### Table: users

| Field       | Type         | Constraints           | Description                    |
|-------------|--------------|-----------------------|--------------------------------|
| id          | INT(11)      | PRIMARY KEY, AUTO_INCREMENT | Unique user identifier      |
| username    | VARCHAR(50)  | UNIQUE, NOT NULL      | Login username                |
| email       | VARCHAR(100) | UNIQUE, NOT NULL      | User email address            |
| password    | VARCHAR(255) | NOT NULL              | Hashed password               |
| role        | VARCHAR(20)  | DEFAULT 'staff'       | User role (admin/staff)       |
| created_at  | TIMESTAMP    | DEFAULT CURRENT_TIMESTAMP | Account creation time      |

#### Table: students

| Field          | Type         | Constraints           | Description                    |
|----------------|--------------|-----------------------|--------------------------------|
| id             | INT(11)      | PRIMARY KEY, AUTO_INCREMENT | Unique identifier          |
| student_id     | VARCHAR(20)  | UNIQUE, NOT NULL      | Student ID number             |
| first_name     | VARCHAR(50)  | NOT NULL              | Student first name            |
| last_name      | VARCHAR(50)  | NOT NULL              | Student last name             |
| email          | VARCHAR(100) | UNIQUE, NOT NULL      | Student email                 |
| phone          | VARCHAR(20)  |                       | Contact phone number          |
| address        | TEXT         |                       | Student address               |
| date_of_birth  | DATE         |                       | Date of birth                 |
| enrollment_date| DATE         | NOT NULL              | Enrollment date               |
| status         | VARCHAR(20)  | DEFAULT 'active'      | Status (active/inactive)      |
| created_at     | TIMESTAMP    | DEFAULT CURRENT_TIMESTAMP | Record creation time      |

#### Table: courses

| Field          | Type         | Constraints           | Description                    |
|----------------|--------------|-----------------------|--------------------------------|
| id             | INT(11)      | PRIMARY KEY, AUTO_INCREMENT | Unique identifier          |
| course_code    | VARCHAR(20)  | UNIQUE, NOT NULL      | Course code (e.g., CS101)      |
| course_name    | VARCHAR(100) | NOT NULL              | Course name                   |
| credits        | INT(3)       | DEFAULT 3             | Credit hours                  |
| description    | TEXT         |                       | Course description            |
| capacity       | INT(5)       | DEFAULT 30            | Maximum enrollment            |
| enrolled_count | INT(5)       | DEFAULT 0             | Current enrollment count      |
| created_at     | TIMESTAMP    | DEFAULT CURRENT_TIMESTAMP | Record creation time      |

#### Table: enrollments

| Field          | Type         | Constraints           | Description                    |
|----------------|--------------|-----------------------|--------------------------------|
| id             | INT(11)      | PRIMARY KEY, AUTO_INCREMENT | Unique identifier          |
| student_id     | INT(11)      | FOREIGN KEY → students(id) | Reference to student      |
| course_id      | INT(11)      | FOREIGN KEY → courses(id) | Reference to course        |
| enrollment_date| DATE         | NOT NULL              | Enrollment date               |
| status         | VARCHAR(20)  | DEFAULT 'enrolled'    | Status (enrolled/completed/dropped) |
| grade          | VARCHAR(5)   |                       | Grade (A, B, C, D, F)         |
| created_at     | TIMESTAMP    | DEFAULT CURRENT_TIMESTAMP | Record creation time      |

---

## 2.3 UI Layouts / Wireframes

### Login Page Wireframe

```
┌─────────────────────────────────────────────────────────┐
│                    STUDENT ACADEMIC                      │
│                   MANAGEMENT SYSTEM                      │
│                                                          │
│                                                          │
│              ┌──────────────────────────┐                │
│              │                          │                │
│              │      LOGIN FORM          │                │
│              │                          │                │
│              │  Username: [___________] │                │
│              │                          │                │
│              │  Password: [___________] │                │
│              │                          │                │
│              │  [ ] Remember Me         │                │
│              │                          │                │
│              │  [    LOGIN    ]        │                │
│              │                          │                │
│              │  Don't have account?     │                │
│              │  [Register Here]         │                │
│              │                          │                │
│              └──────────────────────────┘                │
│                                                          │
└─────────────────────────────────────────────────────────┘
```

### Dashboard Wireframe

```
┌─────────────────────────────────────────────────────────┐
│ [Logo]  Student Management System    [User] [Logout]    │
├─────────────────────────────────────────────────────────┤
│                                                          │
│  ┌──────────┐  ┌──────────┐  ┌──────────┐  ┌─────────┐│
│  │ Students │  │ Courses  │  │Enrollments│ │ Reports ││
│  │   150    │  │    25    │  │    320    │ │    [View]││
│  └──────────┘  └──────────┘  └──────────┘  └─────────┘│
│                                                          │
│  ┌────────────────────────────────────────────────────┐ │
│  │              RECENT ACTIVITIES                     │ │
│  │  • New student registered: John Doe               │ │
│  │  • Course CS101 enrollment increased              │ │
│  │  • Report generated: Student Summary              │ │
│  └────────────────────────────────────────────────────┘ │
│                                                          │
│  ┌────────────────────────────────────────────────────┐ │
│  │              QUICK ACTIONS                         │ │
│  │  [Add Student]  [Add Course]  [View Reports]      │ │
│  └────────────────────────────────────────────────────┘ │
│                                                          │
└─────────────────────────────────────────────────────────┘
```

### Student Form (Add/Edit) Wireframe

```
┌─────────────────────────────────────────────────────────┐
│ [Logo]  Student Management    [Dashboard] [Logout]      │
├─────────────────────────────────────────────────────────┤
│                                                          │
│              ADD NEW STUDENT                            │
│                                                          │
│  ┌────────────────────────────────────────────────────┐ │
│  │  Student ID:     [STU-2024-001        ]           │ │
│  │  First Name:    [John                ]           │ │
│  │  Last Name:     [Doe                 ]           │ │
│  │  Email:         [john.doe@email.com  ]           │ │
│  │  Phone:         [+1234567890         ]           │ │
│  │  Address:       [123 Main St         ]           │ │
│  │                 [City, State, ZIP    ]           │ │
│  │  Date of Birth: [YYYY-MM-DD          ]           │ │
│  │  Enrollment Date:[YYYY-MM-DD         ]           │ │
│  │  Status:        [Active ▼            ]           │ │
│  │                                                 │ │
│  │  [Cancel]                    [Save Student]    │ │
│  └────────────────────────────────────────────────────┘ │
│                                                          │
└─────────────────────────────────────────────────────────┘
```

### Student List Wireframe

```
┌─────────────────────────────────────────────────────────┐
│ [Logo]  Student Management    [Dashboard] [Logout]      │
├─────────────────────────────────────────────────────────┤
│                                                          │
│  STUDENTS                    [Search: _____] [Add New]  │
│                                                          │
│  ┌────────────────────────────────────────────────────┐ │
│  │ ID      │ Name        │ Email          │ Status  │ │
│  ├─────────┼─────────────┼────────────────┼──────────┤ │
│  │ STU-001 │ John Doe    │ john@email.com │ Active  │ │
│  │         │             │                │ [Edit]  │ │
│  ├─────────┼─────────────┼────────────────┼──────────┤ │
│  │ STU-002 │ Jane Smith  │ jane@email.com │ Active  │ │
│  │         │             │                │ [Edit]  │ │
│  ├─────────┼─────────────┼────────────────┼──────────┤ │
│  │ STU-003 │ Bob Johnson │ bob@email.com  │ Active  │ │
│  │         │             │                │ [Edit]  │ │
│  └────────────────────────────────────────────────────┘ │
│                                                          │
│  [< Previous]  Page 1 of 5  [Next >]                   │
│                                                          │
└─────────────────────────────────────────────────────────┘
```

### Reports Page Wireframe

```
┌─────────────────────────────────────────────────────────┐
│ [Logo]  Reports              [Dashboard] [Logout]        │
├─────────────────────────────────────────────────────────┤
│                                                          │
│  SELECT REPORT TYPE:                                    │
│                                                          │
│  ┌────────────────────────────────────────────────────┐ │
│  │  ○ Student Summary Report                          │ │
│  │  ○ Course Enrollment Statistics                   │ │
│  │  ○ Academic Performance Report                    │ │
│  │                                                     │ │
│  │  [Generate Report]                                 │ │
│  └────────────────────────────────────────────────────┘ │
│                                                          │
│  ┌────────────────────────────────────────────────────┐ │
│  │              REPORT RESULTS                        │ │
│  │                                                     │ │
│  │  Student Summary Report                            │ │
│  │  Generated: 2024-01-15                             │ │
│  │                                                     │ │
│  │  ┌─────────┬──────────┬───────────┬──────────┐   │ │
│  │  │ Student │ Name     │ Courses   │ Status   │   │ │
│  │  ├─────────┼──────────┼───────────┼──────────┤   │ │
│  │  │ STU-001 │ John Doe │ 5         │ Active   │   │ │
│  │  │ STU-002 │ Jane S.  │ 4         │ Active   │   │ │
│  │  └─────────┴──────────┴───────────┴──────────┘   │ │
│  │                                                     │ │
│  │  [Export PDF]  [Export CSV]  [Print]               │ │
│  └────────────────────────────────────────────────────┘ │
│                                                          │
└─────────────────────────────────────────────────────────┘
```

---

*End of System Design*


