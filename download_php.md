# Quick PHP Setup Guide

## Option 1: Download Portable PHP (Fastest)

1. **Download PHP:**
   - Go to: https://windows.php.net/download/
   - Download PHP 8.2 Thread Safe ZIP (or latest version)
   - Extract to: `C:\php\`

2. **Update the batch file:**
   - The `start_server.bat` will automatically detect it
   - Or manually edit and change path to: `C:\php\php.exe`

3. **Run `start_server.bat`**

## Option 2: Install XAMPP (Recommended for Full Setup)

1. **Download XAMPP:**
   - Go to: https://www.apachefriends.org/
   - Download XAMPP for Windows
   - Install to default location: `C:\xampp`

2. **Start Services:**
   - Open XAMPP Control Panel
   - Start Apache and MySQL

3. **Move Project:**
   - Copy project to: `C:\xampp\htdocs\sams\`
   - Access: `http://localhost/sams/`

## Option 3: Use Online PHP Tester (Temporary)

For quick testing, you can use online PHP environments, but for full functionality with MySQL, you need local setup.

---

**I recommend Option 2 (XAMPP) as it includes everything you need: Apache, MySQL, and PHP.**

