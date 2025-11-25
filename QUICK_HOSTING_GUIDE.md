# Quick Hosting Guide - InfinityFree

## Step-by-Step: Host Your Project Now

### Step 1: Create Hosting Account

1. **On InfinityFree Dashboard:**
   - You're currently on "Hosting Accounts" page
   - Click the purple **"Create Account"** button (top right)

2. **Choose Domain Name:**
   - **Subdomain:** Enter a valid name (NO SPACES!)
     - ✅ Good: `sams`, `learningsystem`, `student-management`
     - ❌ Bad: `learning system` (has space)
   - **Domain Extension:** Select from dropdown
     - Choose: `infinityfree.app` or `epizy.com`
   - Click **"Check Availability"**

3. **Complete Account Creation:**
   - Wait for account setup (2-3 minutes)
   - Account will be created

---

### Step 2: Get FTP Credentials

1. **After Account is Created:**
   - Go back to "Hosting Accounts"
   - Click on your new account

2. **Find FTP Details:**
   - Look for "FTP Accounts" or "File Manager" section
   - Note down:
     - **FTP Host:** `ftpupload.net`
     - **FTP Username:** (provided)
     - **FTP Password:** (provided)
     - **Port:** `21`

---

### Step 3: Create Database

1. **In Your Account Dashboard:**
   - Find "MySQL Databases" section
   - Click "Create Database"

2. **Database Settings:**
   - **Database Name:** `sams_db`
   - **Password:** (choose a strong password)
   - Click "Create"

3. **Note Database Info:**
   - **Database Host:** `sqlXXX.epizy.com` (provided)
   - **Database Username:** (usually same as database name)
   - **Database Password:** (the one you set)
   - **Database Name:** `sams_db` or `epiz_XXXXXXX_sams_db`

---

### Step 4: Prepare Files for Upload

1. **Update Configuration Files:**

   **Edit `config/db.php`:**
   ```php
   define('DB_HOST', 'sqlXXX.epizy.com');  // Your database host
   define('DB_USER', 'epiz_XXXXXXX');      // Your database username
   define('DB_PASS', 'your_password');     // Your database password
   define('DB_NAME', 'epiz_XXXXXXX_sams_db'); // Your database name
   ```

   **Edit `config/config.php`:**
   ```php
   define('BASE_URL', 'https://your-subdomain.infinityfree.app/');
   // Or
   define('BASE_URL', 'https://your-subdomain.epizy.com/');
   ```

---

### Step 5: Upload Files via FTP

#### Option A: Using FileZilla (Recommended)

1. **Download FileZilla:**
   - Go to: https://filezilla-project.org/
   - Download and install FileZilla Client

2. **Connect to Server:**
   - Open FileZilla
   - Enter:
     - **Host:** `ftpupload.net`
     - **Username:** (from Step 2)
     - **Password:** (from Step 2)
     - **Port:** `21`
   - Click "Quickconnect"

3. **Upload Files:**
   - **Left side:** Your local project folder
   - **Right side:** Navigate to `htdocs` folder
   - Select ALL files and folders
   - Drag and drop to `htdocs`
   - Wait for upload to complete

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

2. **Import Database:**
   - Select your database from left sidebar
   - Click "Import" tab
   - Click "Choose File"
   - Select `config/database.sql` from your computer
   - Click "Go"
   - Wait for "Import has been successfully finished"

3. **Fix Admin Password:**
   - Click "SQL" tab
   - Paste this query:
     ```sql
     UPDATE users 
     SET password = '$2y$10$N9qo8uLOickgx2ZMRZoMyeIjZAgcfl7p92ldGxad68LJZdL17lhWy' 
     WHERE username = 'admin';
     ```
   - Click "Go"

---

### Step 7: Access Your Live Site

1. **Your Live URL:**
   - `https://your-subdomain.infinityfree.app/`
   - Or: `https://your-subdomain.epizy.com/`

2. **Test Login:**
   - Username: `admin`
   - Password: `admin123`

3. **Verify Everything Works:**
   - Dashboard loads
   - Can view students
   - Can add/edit/delete
   - Reports work

---

## Quick Checklist

- [ ] Click "Create Account" on InfinityFree
- [ ] Enter valid subdomain (no spaces!)
- [ ] Account created successfully
- [ ] Got FTP credentials
- [ ] Created MySQL database
- [ ] Updated `config/db.php` with database info
- [ ] Updated `config/config.php` with live URL
- [ ] Uploaded all files to `htdocs` folder
- [ ] Imported database via phpMyAdmin
- [ ] Fixed admin password
- [ ] Tested live site
- [ ] Got live URL

---

## Need Help?

**Detailed Guides:**
- `INFINITYFREE_DEPLOYMENT_GUIDE.md` - Complete step-by-step
- `docs/06_DEPLOYMENT_GUIDE_ACADEMIC.md` - Academic deployment guide

**Common Issues:**
- Subdomain has space? Remove it or use dash
- Can't connect FTP? Check credentials
- Database error? Verify database host and credentials
- 404 error? Check BASE_URL and file paths

---

**Ready to start? Click "Create Account" on InfinityFree now!** 🚀

