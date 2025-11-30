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

| Platform | PHP Support | Database Support | Always-On | Setup Difficulty | Selected |
|----------|------------|------------------|-----------|------------------|----------|
| **Render.com** | ✅ | ✅ (PostgreSQL) | ❌ (Spins down) | Medium | ✅ **YES** |
| InfinityFree | ✅ | ✅ (MySQL) | ✅ | Easy | Alternative |
| 000webhost | ✅ | ✅ (MySQL) | ✅ | Easy | Alternative |
| Vercel/Netlify | ❌ | ❌ | ✅ | Hard | ❌ |

---

## 3. Deployment Steps

### Step 1: Create PostgreSQL Database on Render

1. **Visit:** https://dashboard.render.com
2. **Sign Up/Login:** Create free account or log in
3. **Create Database:**
   - Click "New +" → "PostgreSQL"
   - Name: `sams-db`
   - Database: `sams_db`
   - Region: `Oregon (US West)` (or your preferred region)
   - PostgreSQL Version: `18`
   - Plan: **Free**
   - Click "Create Database"

4. **Wait for Creation:**
   - Wait 2-3 minutes for database to be created
   - Note the **Internal Database URL** (you'll need this)

**Result:** PostgreSQL database created on Render

---

### Step 2: Create Web Service on Render

1. **Create Web Service:**
   - Click "New +" → "Web Service"
   - Connect your GitHub repository: `petero-codes/leraningmanagement-system`
   - Name: `leraningmanagement-system` (or your preferred name)

2. **Configure Service:**
   - **Environment:** Docker
   - **Build Command:** (leave empty - Docker handles this)
   - **Start Command:** (leave empty - Docker handles this)
   - **Plan:** Free

3. **Add Environment Variables:**
   - Click "Environment" tab
   - Add `DATABASE_URL`: (paste Internal Database URL from PostgreSQL)
   - Add `BASE_URL`: `https://leraningmanagement-system.onrender.com/`
   - Save

4. **Deploy:**
   - Click "Create Web Service"
   - Render will automatically build and deploy

**Result:** Web service created and deploying

---

### Step 3: Import Database Schema

1. **Get Database Connection:**
   - Go to your PostgreSQL database on Render
   - Copy the **Internal Database URL**

2. **Import Schema:**
   - Use Render's PostgreSQL web interface (psql)
   - Or use a local PostgreSQL client
   - Import `config/database.postgresql.sql`

3. **Verify Import:**
   - Check that 4 tables are created:
     - `users`
     - `students`
     - `courses`
     - `enrollments`
   - Verify sample data is loaded

**Result:** Database schema and sample data imported

---

### Step 4: Verify Deployment

1. **Access Live Site:**
   - Open browser
   - Go to: `https://leraningmanagement-system.onrender.com/`
   - Wait for first load (free tier spins down after inactivity)

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

### GitHub Deployment (Automatic)

Render automatically deploys from GitHub:

1. **Automatic Deployment:**
   - Render watches your GitHub repository
   - Every push to `main` branch triggers automatic deployment
   - No manual upload needed

2. **Manual Deploy:**
   - In Render dashboard, click "Manual Deploy"
   - Select branch to deploy
   - Click "Deploy"

---

## 5. Environment Configuration

### Production Environment Variables

**Database Configuration:**
- Connection: Via `DATABASE_URL` environment variable
- Format: `postgresql://user:password@host:port/database`
- Automatically provided by Render PostgreSQL service

**Application Configuration:**
- Base URL: `https://leraningmanagement-system.onrender.com/`
- PHP Version: 8.3 (via Docker)
- PostgreSQL Version: 18

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
- Verify `DATABASE_URL` environment variable is set correctly
- Check PostgreSQL database is running on Render
- Ensure Internal Database URL is used (not external)
- Verify database schema is imported

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
- [ ] Render account created
- [ ] PostgreSQL database created
- [ ] Web service created
- [ ] Environment variables set (DATABASE_URL, BASE_URL)
- [ ] GitHub repository connected
- [ ] Database schema imported
- [ ] Deployment successful

### Post-Deployment
- [ ] Live site accessible
- [ ] Login works
- [ ] All features functional
- [ ] Reports generate correctly
- [ ] Mobile responsive
- [ ] No errors in browser console

---

## 8. Alternative Deployment Options

### Option 1: InfinityFree

**Steps:**
1. Sign up at https://www.infinityfree.net
2. Create hosting account
3. Upload files via FTP to `htdocs`
4. Create MySQL database
5. Import MySQL schema via phpMyAdmin
6. Update configuration files

**Advantages:**
- Free MySQL
- Always-on
- Easy setup

**Note:** Requires MySQL schema (not PostgreSQL)

### Option 2: 000webhost

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

**Note:** Requires MySQL schema (not PostgreSQL)

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

3. **Automatic Deployment:**
   - Render automatically detects GitHub push
   - Builds and deploys automatically
   - No manual upload needed

### Database Backups

1. **Via Render Dashboard:**
   - Go to PostgreSQL database
   - Use "Backup" feature (if available)
   - Or use `pg_dump` command

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
**URL:** `https://leraningmanagement-system.onrender.com/`

**Access:**
- Public access
- Login required for features
- Default credentials: admin / admin123
- Note: Free tier spins down after inactivity (first load may take 30-60 seconds)

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

### Screenshot 1: Render Dashboard
**Description:** Render dashboard showing PostgreSQL database and web service

### Screenshot 2: Database Configuration
**Description:** PostgreSQL database created on Render with connection details

### Screenshot 3: Web Service Configuration
**Description:** Web service settings showing Docker environment and environment variables

### Screenshot 4: GitHub Integration
**Description:** GitHub repository connected for automatic deployment

### Screenshot 5: Live Application
**Description:** Application running on Render domain

### Screenshot 6: Environment Variables
**Description:** DATABASE_URL and BASE_URL configured in Render

---

## 12. Conclusion

The Student Academic Management System has been successfully deployed to Render.com, providing:

- ✅ Free hosting with PHP/PostgreSQL support
- ✅ Automatic deployment from GitHub
- ✅ Modern Docker-based deployment
- ✅ Complete source code on GitHub
- ✅ Full documentation and deployment guide
- ✅ Working live application

**Deployment Status:** ✅ **COMPLETE**

**Live Link:** `https://leraningmanagement-system.onrender.com/`  
**GitHub Link:** https://github.com/petero-codes/leraningmanagement-system.git

---

*End of Deployment Guide*

