# How to Import Database in phpMyAdmin

## Step-by-Step Instructions

### Step 1: Select the File
1. Click **"Browse your computer"** or **"Choose File"** button
2. Navigate to: `C:\xampp\htdocs\sams\config\database.sql`
   - Or: `C:\Users\Admin\OneDrive\Documents\projo y ann\config\database.sql`
3. Select the file: `database.sql`
4. Click **"Open"**

### Step 2: Configure Import Settings

**Character set of the file:**
- ✅ Keep as: **utf-8** (already correct)

**Partial import:**
- ✅ **Leave UNCHECKED** (for small files like this)

**Skip this number of queries:**
- ✅ Keep as: **0** (already correct)

**Other options:**
- ✅ **Enable foreign key checks** - **CHECK THIS** (important!)

**Format:**
- ✅ Keep as: **SQL** (already correct)

**SQL compatibility mode:**
- ✅ Keep as: **NONE** (already correct)

**Do not use AUTO_INCREMENT for zero values:**
- ✅ **Leave UNCHECKED**

### Step 3: Execute Import
1. Scroll down to the bottom
2. Click the **"Go"** button (usually blue, at the bottom right)
3. Wait for the import to complete
4. You should see: **"Import has been successfully finished"**

### Step 4: Verify Import
1. In the left sidebar, click on **"sams_db"** database
2. You should see 4 tables:
   - ✅ `users`
   - ✅ `students`
   - ✅ `courses`
   - ✅ `enrollments`
3. Click on each table to verify data was imported

## Expected Results

After successful import:
- **users** table: 1 admin user
- **students** table: 5 sample students
- **courses** table: 6 sample courses
- **enrollments** table: 14 sample enrollments

## Troubleshooting

**If you get an error:**
- Make sure the file path is correct
- Check that MySQL is running in XAMPP
- Verify file size is under 40MB (it should be very small)
- Try refreshing phpMyAdmin

**If tables already exist:**
- You may need to drop existing tables first
- Or select "Drop" option if available in import settings

## Quick Checklist

- [ ] File selected: `database.sql`
- [ ] Character set: `utf-8`
- [ ] Foreign key checks: **ENABLED**
- [ ] Format: `SQL`
- [ ] Clicked "Go" button
- [ ] Saw success message
- [ ] Verified tables exist

---

**After import, you can login with:**
- Username: `admin`
- Password: `admin123`

