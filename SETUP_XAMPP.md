# Setting Up with XAMPP (Recommended)

## Step 1: Install XAMPP (if not installed)

1. Download XAMPP from: https://www.apachefriends.org/
2. Install it (usually to `C:\xampp`)
3. Open XAMPP Control Panel

## Step 2: Start Services

1. In XAMPP Control Panel, click "Start" for:
   - **Apache** (web server)
   - **MySQL** (database)

## Step 3: Move Project to htdocs

**Option A: Copy Project**
1. Copy your project folder to: `C:\xampp\htdocs\`
2. Rename it to `sams` (remove spaces)
3. Access at: `http://localhost/sams/`

**Option B: Create Symbolic Link (Keep project where it is)**
1. Open Command Prompt as Administrator
2. Run:
   ```cmd
   mklink /D "C:\xampp\htdocs\sams" "C:\Users\Admin\OneDrive\Documents\projo y ann"
   ```
3. Access at: `http://localhost/sams/`

**Option C: Access Directly (Keep project where it is)**
1. Keep project in current location
2. Update `config/config.php`:
   ```php
   define('BASE_URL', 'http://localhost/projo%20y%20ann/');
   ```
3. Access at: `http://localhost/projo%20y%20ann/`

## Step 4: Update Configuration

Edit `config/config.php`:
```php
define('BASE_URL', 'http://localhost/sams/');  // If moved to htdocs/sams
// OR
define('BASE_URL', 'http://localhost/projo%20y%20ann/');  // If kept in current location
```

## Step 5: Import Database

1. Open: `http://localhost/phpmyadmin`
2. Click "Import" tab
3. Choose file: `config/database.sql`
4. Click "Go"

## Step 6: Access Application

1. Open browser: `http://localhost/sams/` (or your custom URL)
2. Login with:
   - Username: `admin`
   - Password: `admin123`

---

## Alternative: Use Built-in PHP Server

If you prefer not to use XAMPP Apache:

1. Double-click `start_server.bat` in your project folder
2. Browser will open automatically
3. Server runs on `http://localhost:8000`

Make sure to update `config/config.php`:
```php
define('BASE_URL', 'http://localhost:8000/');
```

