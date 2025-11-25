# InfinityFree Complete Setup Guide

## Step-by-Step Deployment to InfinityFree

### Step 1: Create InfinityFree Account & Hosting

1. **Go to:** https://www.infinityfree.net
2. **Sign up** for free account
3. **Verify email**
4. **Create Hosting Account:**
   - Click "Create a Free Hosting Account"
   - **Subdomain:** Enter valid name (e.g., `sams` or `learningsystem`)
     - ✅ Valid: `sams`, `learningsystem`, `student-management`
     - ❌ Invalid: `learning system` (no spaces!)
   - **Domain Extension:** Choose (e.g., `infinityfree.app` or `epizy.com`)
   - Click "Check Availability"
   - Complete account creation

**Your live URL will be:** `https://your-subdomain.infinityfree.app/`

---

### Step 2: Get FTP Credentials

1. **In InfinityFree Dashboard:**
   - Go to "Hosting Accounts"
   - Click on your account

2. **Find FTP Details:**
   - Go to "FTP Accounts" or "File Manager"
   - Note down:
     - **FTP Host:** `ftpupload.net`
     - **FTP Username:** (provided)
     - **FTP Password:** (provided)
     - **Port:** `21`

---

### Step 3: Create MySQL Database

1. **In Your Account Dashboard:**
   - Go to "MySQL Databases"
   - Click "Create Database"

2. **Database Settings:**
   - **Database Name:** `sams_db`
   - **Password:** (choose a strong password - save it!)
   - Click "Create"

3. **Note Database Credentials:**
   - **Database Host:** Usually `sqlXXX.epizy.com` (provided)
   - **Database Username:** Usually `epiz_XXXXXXX` (provided)
   - **Database Password:** (the one you set)
   - **Database Name:** Usually `epiz_XXXXXXX_sams_db` (provided)

---

### Step 4: Update Configuration Files

#### 4.1 Update Database Configuration

**Edit `config/db.php`** with your InfinityFree database credentials:

```php
define('DB_HOST', 'sqlXXX.epizy.com');  // Your database host
define('DB_USER', 'epiz_XXXXXXX');      // Your database username
define('DB_PASS', 'your_password');     // Your database password
define('DB_NAME', 'epiz_XXXXXXX_sams_db'); // Your database name
```

#### 4.2 Update Base URL

**Edit `config/config.php`** with your live domain:

```php
define('BASE_URL', 'https://your-subdomain.infinityfree.app/');
// Or
define('BASE_URL', 'https://your-subdomain.epizy.com/');
```

**Replace `your-subdomain` with your actual subdomain!**

---

### Step 5: Upload Files via FTP

#### Option A: Using FileZilla (Recommended)

1. **Download FileZilla:**
   - Go to: https://filezilla-project.org/
   - Download and install FileZilla Client

2. **Connect:**
   - Open FileZilla
   - Enter:
     - **Host:** `ftpupload.net`
     - **Username:** (from Step 2)
     - **Password:** (from Step 2)
     - **Port:** `21`
   - Click "Quickconnect"

3. **Upload Files:**
   - **Left side:** Navigate to your project folder
   - **Right side:** Navigate to `htdocs` folder
   - Select ALL files and folders from your project
   - Drag and drop to `htdocs` folder
   - Wait for upload to complete

**Upload Structure:**
```
/htdocs
   /assets
   /config
   /includes
   /php
   /reports
   /views
   /docs
   index.php
   login.php
   dashboard.php
   register.php
   (all other files)
```

#### Option B: Using InfinityFree File Manager

1. **In Account Dashboard:**
   - Click "File Manager"
   - Navigate to `htdocs` folder
   - Click "Upload Files"
   - Select all project files
   - Upload

---

### Step 6: Import Database

1. **Access phpMyAdmin:**
   - In InfinityFree dashboard
   - Click "phpMyAdmin" link
   - Or go to: `https://phpmyadmin.epizy.com`

2. **Select Database:**
   - Click on your database (e.g., `epiz_XXXXXXX_sams_db`)

3. **Import SQL File:**
   - Click "Import" tab
   - Click "Choose File"
   - Select `config/database.sql` from your local project
   - Click "Go"
   - Wait for "Import has been successfully finished"

4. **Verify Import:**
   - Check that 4 tables are created:
     - `users`
     - `students`
     - `courses`
     - `enrollments`

---

### Step 7: Fix Admin Password

1. **In phpMyAdmin:**
   - Select your database
   - Click `users` table
   - Click "SQL" tab

2. **Run SQL Query:**
   ```sql
   UPDATE users 
   SET password = '$2y$10$N9qo8uLOickgx2ZMRZoMyeIjZAgcfl7p92ldGxad68LJZdL17lhWy' 
   WHERE username = 'admin';
   ```

3. **Click "Go"**

**This sets password to:** `admin123`

---

### Step 8: Access Your Live Site

1. **Your Live URL:**
   - `https://your-subdomain.infinityfree.app/`
   - Or: `https://your-subdomain.epizy.com/`

2. **Test Login:**
   - Username: `admin`
   - Password: `admin123`

3. **Test Features:**
   - [ ] Dashboard loads
   - [ ] Can view students
   - [ ] Can add/edit/delete students
   - [ ] Can view courses
   - [ ] Can manage enrollments
   - [ ] Reports generate correctly

---

## Configuration Checklist

### Before Upload:
- [ ] Updated `config/db.php` with database credentials
- [ ] Updated `config/config.php` with BASE_URL
- [ ] All files ready for upload

### After Upload:
- [ ] All files uploaded to `htdocs` folder
- [ ] Database imported via phpMyAdmin
- [ ] Admin password fixed
- [ ] Live site accessible
- [ ] Login works

---

## Troubleshooting

### Database Connection Error
- Double-check database credentials in `config/db.php`
- Verify database host is correct (usually `sqlXXX.epizy.com`)
- Make sure database was created

### Page Not Found (404)
- Check BASE_URL in `config/config.php`
- Verify all files uploaded to `htdocs` folder
- Check file permissions

### Can't Login
- Make sure you ran the password fix SQL query
- Verify admin user exists in database
- Check database connection is working

### CSS/JS Not Loading
- Verify `assets` folder uploaded correctly
- Check file paths in HTML
- Ensure BASE_URL is correct

---

## Quick Reference

**Files to Update:**
- `config/db.php` - Database credentials
- `config/config.php` - BASE_URL

**Files to Upload:**
- All project files to `htdocs` folder

**Database:**
- Import `config/database.sql` via phpMyAdmin
- Fix admin password with SQL query

**Live URL:**
- `https://your-subdomain.infinityfree.app/`

---

**Your project is now ready for InfinityFree!** 🚀

