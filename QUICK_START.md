# Quick Start Guide

## Installation Steps

### 1. Download/Extract Project
- Extract all files to your web server directory (e.g., `htdocs/sams/` or `www/sams/`)

### 2. Create Database
```sql
-- Option 1: Using phpMyAdmin
-- Import config/database.sql file

-- Option 2: Using MySQL command line
mysql -u root -p
CREATE DATABASE sams_db;
USE sams_db;
SOURCE config/database.sql;
```

### 3. Configure Database Connection
Edit `config/db.php`:
```php
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', 'your_password');
define('DB_NAME', 'sams_db');
```

### 4. Configure Base URL
Edit `config/config.php`:
```php
define('BASE_URL', 'http://localhost/sams/');
// Or for production:
// define('BASE_URL', 'https://yourdomain.com/');
```

### 5. Set File Permissions (Linux/Mac)
```bash
chmod 755 config/
chmod 644 config/*.php
chmod 644 *.php
```

### 6. Access Application
- Open browser: `http://localhost/sams/`
- Default login:
  - Username: `admin`
  - Password: `admin123`

## Default Credentials

**Admin User:**
- Username: `admin`
- Email: `admin@sams.edu`
- Password: `admin123`

## Sample Data

The database includes:
- 5 sample students
- 6 sample courses
- 14 sample enrollments

## Common Issues

**Database Connection Error:**
- Check database credentials in `config/db.php`
- Verify MySQL is running
- Ensure database exists

**Page Not Found:**
- Check BASE_URL in `config/config.php`
- Verify .htaccess file (if using Apache)
- Check file paths

**Session Errors:**
- Ensure PHP sessions are enabled
- Check file permissions
- Verify session directory is writable

## Testing Checklist

- [ ] Login with admin credentials
- [ ] View dashboard
- [ ] Add new student
- [ ] Edit student record
- [ ] Add new course
- [ ] Create enrollment
- [ ] Generate all 3 reports
- [ ] Test search functionality
- [ ] Test logout

## Support

For detailed information, see:
- `PROJECT_SUMMARY.md` - Complete project overview
- `docs/04_COMPLETE_DOCUMENTATION.md` - Full documentation
- `docs/03_DEPLOYMENT_GUIDE.md` - Deployment instructions

