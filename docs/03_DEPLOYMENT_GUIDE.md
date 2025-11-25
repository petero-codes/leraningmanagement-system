# DEPLOYMENT GUIDE

## Deployment Options

This guide covers deployment of the Student Academic Management System to three popular hosting platforms:
1. Render.com
2. 000webhost
3. InfinityFree

---

## 1. Deployment to Render.com

### Prerequisites
- GitHub account
- Render.com account (free tier available)
- Project files pushed to GitHub repository

### Step-by-Step Instructions

#### Step 1: Prepare GitHub Repository
1. Create a new repository on GitHub
2. Initialize git in your project directory:
   ```bash
   git init
   git add .
   git commit -m "Initial commit"
   git remote add origin https://github.com/yourusername/sams.git
   git push -u origin main
   ```

#### Step 2: Create Database on Render
1. Log in to Render.com
2. Click "New +" → "PostgreSQL"
3. Configure database:
   - Name: `sams_db`
   - Database: `sams_db`
   - User: Auto-generated
   - Region: Choose closest to you
   - Plan: Free tier
4. Click "Create Database"
5. Note down the connection details (Internal Database URL)

#### Step 3: Update Database Configuration
1. Update `config/db.php`:
   ```php
   // Parse PostgreSQL connection string
   $dbUrl = getenv('DATABASE_URL');
   $dbParts = parse_url($dbUrl);
   
   define('DB_HOST', $dbParts['host']);
   define('DB_USER', $dbParts['user']);
   define('DB_PASS', $dbParts['pass']);
   define('DB_NAME', ltrim($dbParts['path'], '/'));
   define('DB_PORT', $dbParts['port']);
   ```

#### Step 4: Create Web Service
1. In Render dashboard, click "New +" → "Web Service"
2. Connect your GitHub repository
3. Configure service:
   - Name: `sams-web`
   - Environment: PHP
   - Build Command: `composer install` (if using Composer)
   - Start Command: `php -S 0.0.0.0:$PORT`
4. Add Environment Variables:
   - `DATABASE_URL`: (from PostgreSQL service)
   - `BASE_URL`: `https://your-app-name.onrender.com`
5. Click "Create Web Service"

#### Step 5: Import Database Schema
1. Access your PostgreSQL database via Render dashboard
2. Use the SQL console or connect via psql
3. Run the SQL script from `config/database.sql`
4. Note: Adjust SQL syntax for PostgreSQL if needed

#### Step 6: Verify Deployment
1. Wait for build to complete (5-10 minutes)
2. Visit your app URL: `https://your-app-name.onrender.com`
3. Test login with default admin credentials

### Getting Live Link
- Your app will be available at: `https://your-app-name.onrender.com`
- Free tier includes automatic SSL certificate

---

## 2. Deployment to 000webhost

### Prerequisites
- 000webhost account (free)
- FTP client (FileZilla recommended)

### Step-by-Step Instructions

#### Step 1: Create Account
1. Visit https://www.000webhost.com
2. Sign up for free account
3. Verify email address

#### Step 2: Create Website
1. Log in to dashboard
2. Click "Create Website"
3. Enter website details:
   - Website Name: `sams`
   - Domain: Choose subdomain or use provided
4. Click "Create"

#### Step 3: Access Database
1. In dashboard, go to "Databases" section
2. Click "Create Database"
3. Note down:
   - Database Name
   - Database Username
   - Database Password
   - Database Host (usually `localhost`)

#### Step 4: Upload Project Files
1. Download all project files
2. Open FileZilla or FTP client
3. Connect using FTP credentials from 000webhost dashboard:
   - Host: `files.000webhost.com`
   - Username: (from dashboard)
   - Password: (from dashboard)
   - Port: 21
4. Navigate to `public_html` folder
5. Upload all project files maintaining folder structure

#### Step 5: Configure Database Connection
1. Edit `config/db.php` via File Manager or FTP:
   ```php
   define('DB_HOST', 'localhost');
   define('DB_USER', 'your_db_username');
   define('DB_PASS', 'your_db_password');
   define('DB_NAME', 'your_db_name');
   ```
2. Update `config/config.php`:
   ```php
   define('BASE_URL', 'https://your-domain.000webhostapp.com/');
   ```

#### Step 6: Import Database
1. In 000webhost dashboard, go to "phpMyAdmin"
2. Select your database
3. Click "Import" tab
4. Choose `config/database.sql` file
5. Click "Go" to import

#### Step 7: Set File Permissions
1. Set `config/` folder permissions to 755
2. Ensure PHP files have 644 permissions

#### Step 8: Verify Deployment
1. Visit your website URL
2. Test login functionality
3. Verify database connection

### Getting Live Link
- Your app will be available at: `https://your-domain.000webhostapp.com`
- Free SSL available in dashboard

---

## 3. Deployment to InfinityFree

### Prerequisites
- InfinityFree account (free)
- FTP client

### Step-by-Step Instructions

#### Step 1: Create Account
1. Visit https://www.infinityfree.net
2. Sign up for free account
3. Verify email address

#### Step 2: Add Website
1. Log in to control panel
2. Click "Add Website"
3. Enter domain details:
   - Domain: Choose from available or use subdomain
   - PHP Version: 7.4 or higher
4. Click "Create Website"

#### Step 3: Create Database
1. In control panel, go to "MySQL Databases"
2. Click "Create Database"
3. Enter database name: `sams_db`
4. Note down:
   - Database Name
   - Database Username (usually same as database name)
   - Database Password
   - Database Host: `sqlXXX.epizy.com` (provided)

#### Step 4: Upload Files via FTP
1. Get FTP credentials from control panel:
   - Host: `ftpupload.net`
   - Username: (from control panel)
   - Password: (from control panel)
   - Port: 21
2. Connect using FileZilla
3. Navigate to `htdocs` folder
4. Upload all project files

#### Step 5: Configure Application
1. Edit `config/db.php`:
   ```php
   define('DB_HOST', 'sqlXXX.epizy.com');
   define('DB_USER', 'your_db_username');
   define('DB_PASS', 'your_db_password');
   define('DB_NAME', 'your_db_name');
   ```
2. Update `config/config.php`:
   ```php
   define('BASE_URL', 'https://your-domain.epizy.com/');
   ```

#### Step 6: Import Database
1. In control panel, go to "phpMyAdmin"
2. Select your database
3. Click "Import"
4. Upload `config/database.sql`
5. Execute import

#### Step 7: Verify Deployment
1. Visit your website
2. Test all functionality
3. Check error logs if issues occur

### Getting Live Link
- Your app will be available at: `https://your-domain.epizy.com`
- Free SSL certificate included

---

## General Deployment Notes

### Environment Variables
For production, consider using environment variables instead of hardcoding:
```php
define('DB_HOST', getenv('DB_HOST') ?: 'localhost');
define('DB_USER', getenv('DB_USER') ?: 'root');
define('DB_PASS', getenv('DB_PASS') ?: '');
define('DB_NAME', getenv('DB_NAME') ?: 'sams_db');
```

### Security Checklist
- [ ] Change default admin password
- [ ] Enable HTTPS/SSL
- [ ] Set proper file permissions (644 for files, 755 for folders)
- [ ] Disable error display in production (`ini_set('display_errors', 0)`)
- [ ] Use strong database passwords
- [ ] Regularly backup database
- [ ] Keep PHP version updated

### Troubleshooting

**Database Connection Errors:**
- Verify database credentials
- Check if database host allows remote connections
- Ensure database exists and user has permissions

**File Upload Issues:**
- Check file permissions
- Verify folder structure is maintained
- Ensure all files uploaded completely

**404 Errors:**
- Check `.htaccess` file (if using Apache)
- Verify BASE_URL configuration
- Check file paths are correct

**Session Issues:**
- Ensure session directory is writable
- Check PHP session configuration
- Verify cookies are enabled

---

## Connecting GitHub Repository to Hosting

### For Render.com
1. Repository connection is built-in during service creation
2. Automatic deployments on push to main branch
3. Configure in service settings → "Auto-Deploy"

### For 000webhost / InfinityFree
1. Use Git deployment (if available) or manual FTP
2. For automated deployment:
   - Set up GitHub Actions
   - Use FTP deployment action
   - Configure secrets for FTP credentials

### GitHub Actions Example
Create `.github/workflows/deploy.yml`:
```yaml
name: Deploy to Hosting
on:
  push:
    branches: [ main ]
jobs:
  deploy:
    runs-on: ubuntu-latest
    steps:
      - uses: actions/checkout@v2
      - name: Deploy via FTP
        uses: SamKirkland/FTP-Deploy-Action@4.0.0
        with:
          server: ${{ secrets.FTP_SERVER }}
          username: ${{ secrets.FTP_USERNAME }}
          password: ${{ secrets.FTP_PASSWORD }}
          local-dir: ./
```

---

*End of Deployment Guide*


