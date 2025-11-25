# How to Install PHP for This Project

## 🚀 Quick Solution: Install XAMPP (5 minutes)

### Step 1: Download XAMPP
1. Go to: **https://www.apachefriends.org/**
2. Click "Download" for Windows
3. Download the installer (about 150MB)

### Step 2: Install XAMPP
1. Run the installer
2. Choose installation location (default: `C:\xampp`)
3. Select components: **Apache**, **MySQL**, **PHP**, **phpMyAdmin**
4. Click "Install"
5. Wait for installation to complete

### Step 3: Start XAMPP
1. Open **XAMPP Control Panel**
2. Click **"Start"** for:
   - ✅ **Apache** (web server)
   - ✅ **MySQL** (database)

### Step 4: Set Up Your Project

**Option A: Copy to htdocs (Easiest)**
1. Copy your project folder to: `C:\xampp\htdocs\`
2. Rename it to `sams` (remove spaces)
3. Update `config/config.php`:
   ```php
   define('BASE_URL', 'http://localhost/sams/');
   ```
4. Access: **http://localhost/sams/**

**Option B: Keep Current Location**
1. Keep project where it is
2. Update `config/config.php`:
   ```php
   define('BASE_URL', 'http://localhost/projo%20y%20ann/');
   ```
3. Access: **http://localhost/projo%20y%20ann/**

### Step 5: Import Database
1. Open: **http://localhost/phpmyadmin**
2. Click **"Import"** tab
3. Choose file: `config/database.sql`
4. Click **"Go"**

### Step 6: Access Your Application
1. Open browser: **http://localhost/sams/** (or your URL)
2. Login:
   - Username: `admin`
   - Password: `admin123`

---

## ✅ That's It!

XAMPP includes everything you need:
- ✅ Apache (web server)
- ✅ MySQL (database)
- ✅ PHP (programming language)
- ✅ phpMyAdmin (database management)

**No need to install anything else!**

---

## Alternative: Portable PHP (Advanced)

If you only want PHP (not the full server):

1. Download PHP from: https://windows.php.net/download/
2. Download PHP 8.2 Thread Safe ZIP
3. Extract to: `C:\php\`
4. Update `start_server.bat` to use: `C:\php\php.exe`
5. Run `start_server.bat`

**Note:** You'll still need MySQL separately for the database.

---

## Need Help?

- XAMPP Documentation: https://www.apachefriends.org/docs/
- PHP Documentation: https://www.php.net/docs.php

