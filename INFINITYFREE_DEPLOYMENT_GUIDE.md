# InfinityFree Deployment Guide - Step by Step

## Step 1: Fix Subdomain Name

**Current Issue:** "learning system" contains a space (invalid)

**Valid Subdomain Options:**
- ✅ `learningsystem` (no space)
- ✅ `learning-system` (with dash)
- ✅ `sams` (Student Academic Management System)
- ✅ `student-management`
- ✅ `sams-project`

**Choose one and enter it in the subdomain field**

## Step 2: Complete Account Creation

1. **Enter valid subdomain** (e.g., `sams` or `learningsystem`)
2. **Select domain extension** from dropdown (e.g., `infinityfree.app` or `epizy.com`)
3. Click **"Check Availability"**
4. If available, proceed to create account
5. Wait for account setup (2-3 minutes)

## Step 3: Get FTP Credentials

1. After account is created, go to **"Hosting Accounts"**
2. Click on your account
3. Find **"FTP Details"** section
4. Note down:
   - **FTP Host:** Usually `ftpupload.net`
   - **FTP Username:** (provided)
   - **FTP Password:** (provided)
   - **Port:** Usually `21`

## Step 4: Get Database Credentials

1. In your hosting account dashboard
2. Go to **"MySQL Databases"**
3. Click **"Create Database"**
4. Enter database name: `sams_db`
5. Note down:
   - **Database Name:** `sams_db`
   - **Database Username:** (usually same as database name)
   - **Database Password:** (you'll set this)
   - **Database Host:** Usually `sqlXXX.epizy.com` (provided)

## Step 5: Upload Project Files

### Using FileZilla (Recommended):

1. **Download FileZilla:** https://filezilla-project.org/
2. **Open FileZilla**
3. **Connect:**
   - Host: `ftpupload.net`
   - Username: (from Step 3)
   - Password: (from Step 3)
   - Port: `21`
4. **Navigate to:** `htdocs` folder
5. **Upload all project files** maintaining folder structure:
   ```
   /htdocs
      /assets
      /config
      /includes
      /php
      /reports
      /views
      index.php
      login.php
      dashboard.php
      etc.
   ```

## Step 6: Configure Database Connection

1. **Edit `config/db.php`** (before uploading or via File Manager):
   ```php
   define('DB_HOST', 'sqlXXX.epizy.com'); // Your database host
   define('DB_USER', 'your_db_username');   // Your database username
   define('DB_PASS', 'your_db_password');   // Your database password
   define('DB_NAME', 'sams_db');            // Your database name
   ```

2. **Edit `config/config.php`:**
   ```php
   define('BASE_URL', 'https://your-subdomain.infinityfree.app/');
   // Or
   define('BASE_URL', 'https://your-subdomain.epizy.com/');
   ```

3. **Re-upload** the updated files

## Step 7: Import Database

1. In InfinityFree dashboard, go to **"phpMyAdmin"**
2. Click on your database (`sams_db`)
3. Click **"Import"** tab
4. Click **"Choose File"**
5. Select `config/database.sql`
6. Click **"Go"**
7. Wait for import to complete

## Step 8: Fix Admin Password (Important!)

After importing, you need to fix the admin password:

1. In phpMyAdmin, go to `sams_db` → `users` table
2. Click **"SQL"** tab
3. Run this query:
   ```sql
   UPDATE users 
   SET password = '$2y$10$N9qo8uLOickgx2ZMRZoMyeIjZAgcfl7p92ldGxad68LJZdL17lhWy' 
   WHERE username = 'admin';
   ```
4. This sets password to: `admin123`

## Step 9: Access Your Application

1. **Your live URL:** `https://your-subdomain.infinityfree.app/`
   - Or: `https://your-subdomain.epizy.com/`
2. **Login:**
   - Username: `admin`
   - Password: `admin123`

## Step 10: Test Everything

- [ ] Login works
- [ ] Dashboard loads
- [ ] Can view students
- [ ] Can add/edit/delete students
- [ ] Can view courses
- [ ] Can manage enrollments
- [ ] Reports generate correctly

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

## Quick Checklist

- [ ] Valid subdomain created (no spaces)
- [ ] FTP credentials obtained
- [ ] Database created
- [ ] All files uploaded to htdocs
- [ ] Database credentials updated in `config/db.php`
- [ ] BASE_URL updated in `config/config.php`
- [ ] Database imported via phpMyAdmin
- [ ] Admin password fixed
- [ ] Application accessible via live URL
- [ ] Login works

---

**Your project will be live at:** `https://your-subdomain.infinityfree.app/`

Good luck with your deployment! 🚀

