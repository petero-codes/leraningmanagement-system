# Setup Instructions - Student Academic Management System

## Step-by-Step Setup Guide

### Step 1: Import Database to MySQL

**Option A: Using phpMyAdmin (Recommended)**
1. Open phpMyAdmin in your browser (usually `http://localhost/phpmyadmin`)
2. Click on "New" to create a database (or skip if using SQL file)
3. Click on "Import" tab
4. Click "Choose File" and select `config/database.sql`
5. Click "Go" to import
6. Database `sams_db` will be created with all tables and sample data

**Option B: Using MySQL Command Line**
```bash
# Open command prompt/terminal
mysql -u root -p

# Then run:
source C:/Users/Admin/OneDrive/Documents/projo y ann/config/database.sql

# Or if you're in the project directory:
source config/database.sql
```

**Option C: Using MySQL Workbench**
1. Open MySQL Workbench
2. Connect to your MySQL server
3. File → Open SQL Script → Select `config/database.sql`
4. Click "Execute" button

### Step 2: Verify Database Configuration

The file `config/db.php` is already configured with default settings:
- **Host:** localhost
- **User:** root
- **Password:** (empty - change if you have a password)
- **Database:** sams_db

**If you need to change these settings:**
1. Open `config/db.php`
2. Update the constants:
   ```php
   define('DB_HOST', 'localhost');      // Your MySQL host
   define('DB_USER', 'root');            // Your MySQL username
   define('DB_PASS', 'your_password');  // Your MySQL password
   define('DB_NAME', 'sams_db');        // Database name
   ```

### Step 3: Update BASE_URL

The BASE_URL in `config/config.php` is currently set to:
```php
define('BASE_URL', 'http://localhost/sams/');
```

**Important:** Adjust this based on your folder structure:

**If your project is in a folder named "sams":**
- Keep as: `http://localhost/sams/`

**If your project is in "projo y ann" folder:**
- Change to: `http://localhost/projo%20y%20ann/`
- Or better: Rename folder to "sams" (remove spaces)

**If using XAMPP with htdocs:**
- If folder is `htdocs/sams/` → `http://localhost/sams/`
- If folder is `htdocs/projo y ann/` → `http://localhost/projo%20y%20ann/`

**To update BASE_URL:**
1. Open `config/config.php`
2. Find line 15: `define('BASE_URL', 'http://localhost/sams/');`
3. Change to match your folder structure

### Step 4: Access the Application

1. **Start your web server:**
   - XAMPP: Start Apache and MySQL
   - WAMP: Start all services
   - MAMP: Start servers

2. **Open your browser and navigate to:**
   - `http://localhost/sams/` (if folder is named "sams")
   - Or your custom URL based on folder name

3. **You should see the login page**

### Step 5: Login with Default Credentials

**Default Admin Account:**
- **Username:** `admin`
- **Password:** `admin123`

**After login, you will see:**
- Dashboard with statistics
- Navigation menu
- Access to all features

## Quick Verification Checklist

- [ ] MySQL server is running
- [ ] Database `sams_db` is created
- [ ] All tables are imported (users, students, courses, enrollments)
- [ ] Sample data is loaded (5 students, 6 courses, 14 enrollments)
- [ ] Database credentials in `config/db.php` are correct
- [ ] BASE_URL in `config/config.php` matches your folder structure
- [ ] Web server (Apache/Nginx) is running
- [ ] Can access login page in browser
- [ ] Can login with admin credentials

## Troubleshooting

### Database Connection Error
**Error:** "Database connection failed"
**Solution:**
1. Check MySQL is running
2. Verify database credentials in `config/db.php`
3. Ensure database `sams_db` exists
4. Check MySQL user has proper permissions

### Page Not Found (404)
**Error:** "Page not found" or blank page
**Solution:**
1. Check BASE_URL matches your folder structure
2. Verify all files are in correct location
3. Check web server is running
4. Try accessing: `http://localhost/sams/login.php` directly

### Session Errors
**Error:** "Session not working"
**Solution:**
1. Check PHP sessions are enabled
2. Verify `session_start()` is called
3. Check file permissions (folders should be 755, files 644)

### Can't Login
**Error:** "Invalid credentials"
**Solution:**
1. Verify database was imported correctly
2. Check admin user exists in `users` table
3. Try resetting password in database:
   ```sql
   UPDATE users SET password = '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi' 
   WHERE username = 'admin';
   ```
   (This sets password to: admin123)

## Testing the Setup

After setup, test these features:

1. **Login/Logout**
   - Login with admin credentials
   - Logout and verify session cleared

2. **View Dashboard**
   - Check statistics display correctly
   - Verify recent students and courses show

3. **Student Management**
   - View student list
   - Add a new student
   - Edit a student
   - Search for students

4. **Course Management**
   - View course list
   - Add a new course
   - Edit a course

5. **Enrollment**
   - Create new enrollment
   - View all enrollments

6. **Reports**
   - Generate Student Summary Report
   - Generate Enrollment Statistics
   - Generate Performance Report

## Next Steps

Once setup is complete:
1. Change the default admin password
2. Add your own data
3. Customize the application as needed
4. Review the documentation in `/docs` folder

## Need Help?

Refer to:
- `QUICK_START.md` - Quick reference
- `PROJECT_SUMMARY.md` - Complete overview
- `docs/04_COMPLETE_DOCUMENTATION.md` - Full documentation

---

**Setup Complete!** 🎉

