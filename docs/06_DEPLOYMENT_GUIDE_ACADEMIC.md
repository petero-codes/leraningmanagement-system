# DEPLOYMENT GUIDE - ACADEMIC REQUIREMENTS

## Overview

This document provides a complete deployment guide for the Student Academic Management System (SAMS) to meet academic submission requirements. The project has been deployed to **Render.com** (free PHP/PostgreSQL hosting) and is available via GitHub repository.

---

## 1. Project Links

### GitHub Repository
**Repository URL:** https://github.com/petero-codes/leraningmanagement-system.git

**Repository Contents:**
- Complete source code
- Database schema
- Documentation
- Setup guides
- All project files

### Live Project Link
**Live Application URL:** `https://your-app-name.onrender.com/`

*(Update this with your actual Render app URL after deployment)*

---

## 2. Hosting Platform: Render.com

### Platform Selection Justification

**Render.com** was selected as the hosting platform for the following reasons:

1. **Free PHP/PostgreSQL Hosting** ✅
   - Supports PHP 7.4+ (required for the project)
   - Free PostgreSQL database
   - No cost for academic projects

2. **Modern Platform** ✅
   - Auto-deploy from GitHub
   - Modern CI/CD practices
   - Free SSL certificate included
   - Good for learning modern deployment

3. **Developer-Friendly** ✅
   - Easy GitHub integration
   - Environment variable management
   - Automatic deployments
   - Good documentation

4. **Scalability** ✅
   - Can upgrade to paid plans if needed
   - Professional hosting environment
   - Suitable for academic and professional projects

### Platform Comparison

| Platform | PHP Support | MySQL Support | Always-On | Setup Difficulty | Selected |
|----------|------------|---------------|-----------|------------------|----------|
| **InfinityFree** | ✅ | ✅ | ✅ | Easy | ✅ **YES** |
| Render.com | ✅ | ❌ (PostgreSQL) | ❌ (Spins down) | Medium | ❌ |
| 000webhost | ✅ | ✅ | ✅ | Easy | Alternative |
| Vercel/Netlify | ❌ | ❌ | ✅ | Hard | ❌ |

---

## 3. Deployment Steps

### Step 1: Account Creation

1. **Visit:** https://www.infinityfree.net
2. **Sign Up:** Create free account
3. **Verify Email:** Confirm email address
4. **Create Hosting Account:**
   - Click "Create a Free Hosting Account"
   - Enter subdomain (e.g., `sams` or `learningsystem`)
   - Select domain extension (e.g., `infinityfree.app` or `epizy.com`)
   - Click "Check Availability"
   - Complete account creation

**Result:** Hosting account created with subdomain

---

### Step 2: Database Setup

1. **Access Dashboard:**
   - Log in to InfinityFree control panel
   - Navigate to "Hosting Accounts"
   - Select your account

2. **Create MySQL Database:**
   - Go to "MySQL Databases" section
   - Click "Create Database"
   - Database Name: `sams_db`
   - Set database password
   - Click "Create"

3. **Note Database Credentials:**
   - Database Host: `sqlXXX.epizy.com` (provided)
   - Database Username: (provided)
   - Database Password: (your chosen password)
   - Database Name: `sams_db`

**Result:** MySQL database created and ready

---

### Step 3: Configure Project Files

#### 3.1 Update Database Configuration

**File:** `config/db.php`

```php
// Update with InfinityFree database credentials
define('DB_HOST', 'sqlXXX.epizy.com');  // Your database host
define('DB_USER', 'epiz_XXXXXXX');      // Your database username
define('DB_PASS', 'your_password');     // Your database password
define('DB_NAME', 'epiz_XXXXXXX_sams_db'); // Your database name
```

#### 3.2 Update Base URL

**File:** `config/config.php`

```php
// Update with your live domain
define('BASE_URL', 'https://your-subdomain.infinityfree.app/');
// Or
define('BASE_URL', 'https://your-subdomain.epizy.com/');
```

**Result:** Configuration files updated for production

---

### Step 4: Upload Project Files

#### 4.1 Install FileZilla

1. Download FileZilla: https://filezilla-project.org/
2. Install on your computer

#### 4.2 Get FTP Credentials

1. In InfinityFree dashboard
2. Go to "FTP Accounts" or "File Manager"
3. Note FTP details:
   - **FTP Host:** `ftpupload.net`
   - **FTP Username:** (provided)
   - **FTP Password:** (provided)
   - **Port:** `21`

#### 4.3 Connect and Upload

1. **Open FileZilla**
2. **Connect:**
   - Host: `ftpupload.net`
   - Username: (from dashboard)
   - Password: (from dashboard)
   - Port: `21`
   - Click "Quickconnect"

3. **Navigate:**
   - Remote site: Go to `htdocs` folder
   - Local site: Navigate to your project folder

4. **Upload Files:**
   - Select all project files and folders
   - Drag and drop to `htdocs` folder
   - Wait for upload to complete

**Uploaded Structure:**
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

**Result:** All project files uploaded to server

---

### Step 5: Import Database

1. **Access phpMyAdmin:**
   - In InfinityFree dashboard
   - Click "phpMyAdmin" link
   - Or go to: `https://phpmyadmin.epizy.com`

2. **Select Database:**
   - Click on your database (`sams_db` or `epiz_XXXXXXX_sams_db`)

3. **Import SQL File:**
   - Click "Import" tab
   - Click "Choose File"
   - Select `config/database.sql` from your local project
   - Click "Go"
   - Wait for import to complete

4. **Verify Import:**
   - Check that 4 tables are created:
     - `users`
     - `students`
     - `courses`
     - `enrollments`
   - Verify sample data is loaded

**Result:** Database schema and sample data imported

---

### Step 6: Fix Admin Password

1. **In phpMyAdmin:**
   - Select `sams_db` database
   - Click `users` table
   - Click "SQL" tab

2. **Run SQL Query:**
   ```sql
   UPDATE users 
   SET password = '$2y$10$N9qo8uLOickgx2ZMRZoMyeIjZAgcfl7p92ldGxad68LJZdL17lhWy' 
   WHERE username = 'admin';
   ```

3. **Click "Go"**

**Result:** Admin password set to `admin123`

---

### Step 7: Verify Deployment

1. **Access Live Site:**
   - Open browser
   - Go to: `https://your-subdomain.infinityfree.app/`
   - Or: `https://your-subdomain.epizy.com/`

2. **Test Login:**
   - Username: `admin`
   - Password: `admin123`
   - Should redirect to dashboard

3. **Test Features:**
   - [ ] Dashboard loads correctly
   - [ ] Can view students list
   - [ ] Can add new student
   - [ ] Can edit student
   - [ ] Can delete student
   - [ ] Can view courses
   - [ ] Can manage enrollments
   - [ ] Reports generate correctly

**Result:** Application is live and functional

---

## 4. GitHub Repository Setup

### Repository Information

**Repository Name:** leraningmanagement-system  
**GitHub URL:** https://github.com/petero-codes/leraningmanagement-system.git  
**Branch:** main  
**Last Updated:** [Current Date]

### Repository Contents

The GitHub repository includes:

1. **Source Code:**
   - All PHP files
   - HTML/CSS/JavaScript
   - Configuration files

2. **Database:**
   - SQL schema file (`config/database.sql`)
   - Sample data

3. **Documentation:**
   - Project proposal
   - System design
   - User manual
   - Deployment guides
   - Test cases

4. **Setup Files:**
   - README.md
   - Installation guides
   - Configuration examples

### GitHub Deployment (Optional)

For automatic deployment from GitHub:

1. **Connect Repository:**
   - In InfinityFree, go to "Git Deployment" (if available)
   - Connect GitHub repository
   - Enable auto-deploy

2. **Manual Updates:**
   - Make changes locally
   - Commit and push to GitHub
   - Upload updated files via FTP

---

## 5. Environment Configuration

### Production Environment Variables

**Database Configuration:**
- Host: `sqlXXX.epizy.com`
- Username: `epiz_XXXXXXX`
- Password: `[secure password]`
- Database: `epiz_XXXXXXX_sams_db`

**Application Configuration:**
- Base URL: `https://your-subdomain.infinityfree.app/`
- PHP Version: 7.4+
- MySQL Version: 5.7+

### Security Considerations

1. **Database Credentials:**
   - Never commit real credentials to GitHub
   - Use `.gitignore` for sensitive files
   - Store credentials securely

2. **Error Display:**
   - Production: `display_errors = 0`
   - Development: `display_errors = 1`

3. **File Permissions:**
   - Folders: 755
   - Files: 644

---

## 6. Troubleshooting

### Common Issues and Solutions

#### Issue 1: Database Connection Failed
**Symptoms:** "Database connection failed" error

**Solutions:**
- Verify database credentials in `config/db.php`
- Check database host is correct
- Ensure database exists in InfinityFree
- Verify MySQL service is running

#### Issue 2: Page Not Found (404)
**Symptoms:** Blank page or 404 error

**Solutions:**
- Check BASE_URL in `config/config.php`
- Verify all files uploaded to `htdocs` folder
- Check file permissions
- Ensure `index.php` exists in root

#### Issue 3: Cannot Login
**Symptoms:** "Invalid username or password"

**Solutions:**
- Verify admin user exists in database
- Run password fix SQL query
- Check database connection is working
- Clear browser cache and cookies

#### Issue 4: CSS/JS Not Loading
**Symptoms:** Styling missing, JavaScript not working

**Solutions:**
- Verify `assets` folder uploaded correctly
- Check file paths in HTML
- Ensure BASE_URL is correct
- Clear browser cache

---

## 7. Deployment Verification Checklist

### Pre-Deployment
- [ ] All code tested locally
- [ ] Database schema ready
- [ ] Configuration files prepared
- [ ] Documentation complete

### Deployment Steps
- [ ] InfinityFree account created
- [ ] Database created
- [ ] FTP credentials obtained
- [ ] Files uploaded to server
- [ ] Database credentials updated
- [ ] BASE_URL updated
- [ ] Database imported
- [ ] Admin password fixed

### Post-Deployment
- [ ] Live site accessible
- [ ] Login works
- [ ] All features functional
- [ ] Reports generate correctly
- [ ] Mobile responsive
- [ ] No errors in browser console

---

## 8. Alternative Deployment Options

### Option 1: 000webhost

**Steps:**
1. Sign up at https://www.000webhost.com
2. Create website
3. Upload files via FTP to `public_html`
4. Create MySQL database
5. Import database via phpMyAdmin
6. Update configuration files

**Advantages:**
- Free MySQL
- Always-on
- Easy setup

### Option 2: Render.com

**Steps:**
1. Sign up at https://render.com
2. Create PostgreSQL database
3. Convert MySQL schema to PostgreSQL
4. Create Web Service
5. Connect GitHub repository
6. Set environment variables
7. Deploy

**Advantages:**
- Modern platform
- Auto-deploy from GitHub
- Free SSL

**Disadvantages:**
- Requires PostgreSQL conversion
- Free tier spins down

---

## 9. Maintenance and Updates

### Updating the Application

1. **Make Changes Locally:**
   - Edit files on your computer
   - Test changes

2. **Commit to GitHub:**
   ```bash
   git add .
   git commit -m "Update description"
   git push
   ```

3. **Upload to Server:**
   - Connect via FTP
   - Upload changed files
   - Test on live site

### Database Backups

1. **Via phpMyAdmin:**
   - Select database
   - Click "Export"
   - Choose "Quick" or "Custom"
   - Click "Go"
   - Save SQL file

2. **Regular Backups:**
   - Backup weekly or before major changes
   - Store backups securely

---

## 10. Project Links Summary

### GitHub Repository
**URL:** https://github.com/petero-codes/leraningmanagement-system.git

**Access:**
- Public repository
- All source code available
- Complete documentation included

### Live Application
**URL:** `https://[your-subdomain].infinityfree.app/`

**Access:**
- Public access
- Login required for features
- Default credentials: admin / admin123

### Documentation
**Location:** `/docs` folder in repository

**Includes:**
- Project proposal
- System design
- User manual
- Deployment guide
- Test cases

---

## 11. Screenshots of Deployment

### Screenshot 1: InfinityFree Dashboard
**Description:** Hosting account dashboard showing active services

### Screenshot 2: Database Configuration
**Description:** MySQL database created in InfinityFree

### Screenshot 3: File Upload (FileZilla)
**Description:** Project files being uploaded via FTP

### Screenshot 4: phpMyAdmin Import
**Description:** Database schema being imported

### Screenshot 5: Live Application
**Description:** Application running on live domain

### Screenshot 6: GitHub Repository
**Description:** Repository showing all project files

---

## 12. Conclusion

The Student Academic Management System has been successfully deployed to InfinityFree, providing:

- ✅ Free hosting with PHP/MySQL support
- ✅ Always-on service for reliable access
- ✅ Complete source code on GitHub
- ✅ Full documentation and deployment guide
- ✅ Working live application

**Deployment Status:** ✅ **COMPLETE**

**Live Link:** `https://[your-subdomain].infinityfree.app/`  
**GitHub Link:** https://github.com/petero-codes/leraningmanagement-system.git

---

*End of Deployment Guide*

