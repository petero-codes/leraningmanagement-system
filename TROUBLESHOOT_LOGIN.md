# Troubleshooting Login Issues

## Current Situation
- ✅ Login page is loading correctly
- ❌ Getting "Invalid username or password" error
- Username "admin" is entered
- Password field appears empty

## Step-by-Step Fix

### Step 1: Verify Database Was Imported

1. Go to: `http://localhost/phpmyadmin`
2. In the left sidebar, click on **"sams_db"** database
3. You should see 4 tables:
   - `users`
   - `students`
   - `courses`
   - `enrollments`

**If you don't see `sams_db`:**
- The database wasn't imported
- Go back and import `config/database.sql` again

**If you see `sams_db` but no tables:**
- The import didn't complete
- Try importing again

### Step 2: Check Admin User Exists

1. In phpMyAdmin, click on **"sams_db"** → **"users"** table
2. Click **"Browse"** tab
3. You should see 1 row with:
   - username: `admin`
   - email: `admin@sams.edu`
   - password: (hashed - long string starting with $2y$10$)

**If the users table is empty:**
- The import didn't work
- You need to import the database again

### Step 3: Verify Database Connection

Check `config/db.php` has correct settings:
- DB_HOST: `localhost`
- DB_USER: `root`
- DB_PASS: (empty, or your MySQL password)
- DB_NAME: `sams_db`

**If you set a MySQL password:**
- Edit `config/db.php`
- Change: `define('DB_PASS', '');`
- To: `define('DB_PASS', 'your_password');`

### Step 4: Try Login Again

**Default Credentials:**
- Username: `admin`
- Password: `admin123`

**Important:** Make sure you:
1. Type the password: `admin123`
2. Don't leave password field empty
3. Click "Login" button

### Step 5: If Still Not Working - Reset Password

If login still fails, you can reset the admin password in phpMyAdmin:

1. Go to phpMyAdmin
2. Click `sams_db` → `users` table
3. Click "Edit" on the admin user
4. In the password field, select "MD5" or "PHP" function
5. Enter new password: `admin123`
6. Or use this SQL query:

```sql
UPDATE users 
SET password = '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi' 
WHERE username = 'admin';
```

This sets password to: `admin123`

## Quick Checklist

- [ ] Database `sams_db` exists in phpMyAdmin
- [ ] `users` table has 1 row (admin user)
- [ ] MySQL is running in XAMPP
- [ ] Database credentials in `config/db.php` are correct
- [ ] Password field is filled with `admin123`
- [ ] Clicked "Login" button

## Common Issues

**Issue 1: "Database connection failed"**
- Solution: Check MySQL is running in XAMPP
- Verify `config/db.php` settings

**Issue 2: "Table doesn't exist"**
- Solution: Import database again
- Make sure import completed successfully

**Issue 3: "Invalid credentials"**
- Solution: Verify admin user exists in database
- Make sure password is `admin123`
- Check password hash in database

---

**After fixing, try login again with:**
- Username: `admin`
- Password: `admin123`

