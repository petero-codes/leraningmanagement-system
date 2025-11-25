# Render.com Deployment - Complete Step-by-Step Guide

## Prerequisites
- ✅ GitHub account
- ✅ Render.com account (sign up at https://render.com)
- ✅ Project already on GitHub: https://github.com/petero-codes/leraningmanagement-system.git

---

## Step 1: Create PostgreSQL Database on Render

1. **Log in to Render.com**
   - Go to: https://dashboard.render.com
   - Sign in or create account

2. **Create Database**
   - Click **"New +"** button (top right)
   - Select **"PostgreSQL"**

3. **Configure Database:**
   - **Name:** `sams-db` (or any name you prefer)
   - **Database:** `sams_db`
   - **User:** (auto-generated)
   - **Region:** Choose closest to you
   - **PostgreSQL Version:** Latest
   - **Plan:** Free (or Starter if you want)
   - Click **"Create Database"**

4. **Wait for Creation** (2-3 minutes)

5. **Get Connection String:**
   - Once created, click on your database
   - Find **"Internal Database URL"** or **"Connection String"**
   - Copy this URL (looks like: `postgresql://user:password@host:port/database`)
   - **Save this - you'll need it!**

---

## Step 2: Update Database Configuration for Render

You need to update `config/db.php` to work with PostgreSQL and Render's environment variables.

**Option A: Replace the file** (Recommended)
1. Copy `config/db.render.php` to `config/db.php`
2. This file is already configured for Render

**Option B: Manual update**
1. Edit `config/db.php`
2. Replace the entire file content with the PostgreSQL version
3. It will automatically use `DATABASE_URL` environment variable from Render

---

## Step 3: Update BASE_URL

Edit `config/config.php`:
```php
define('BASE_URL', 'https://your-app-name.onrender.com/');
```
(You'll update this with your actual Render URL after deployment)

---

## Step 4: Create Web Service on Render

1. **In Render Dashboard:**
   - Click **"New +"** button
   - Select **"Web Service"**

2. **Connect GitHub:**
   - Click **"Connect GitHub"** or **"Connect Repository"**
   - Authorize Render to access your GitHub
   - Select repository: `petero-codes/leraningmanagement-system`

3. **Configure Service:**
   - **Name:** `sams-web` (or any name)
   - **Region:** Same as database
   - **Branch:** `main`
   - **Root Directory:** (leave empty - root of repo)
   - **Environment:** `PHP`
   - **Build Command:** (leave empty or use `composer install` if you add composer.json)
   - **Start Command:** `php -S 0.0.0.0:$PORT`

4. **Add Environment Variables:**
   - Click **"Advanced"** or **"Environment"**
   - Add these variables:
     - **Key:** `DATABASE_URL`
     - **Value:** (paste the Internal Database URL from Step 1)
   - **Key:** `BASE_URL`
   - **Value:** `https://your-app-name.onrender.com` (update after deployment)

5. **Click "Create Web Service"**

6. **Wait for Deployment** (5-10 minutes)
   - Render will:
     - Clone your GitHub repo
     - Build the service
     - Deploy it

---

## Step 5: Import Database Schema

1. **Get Database Connection:**
   - In Render dashboard, go to your PostgreSQL database
   - Find **"psql"** connection command or use **"Connect"** option
   - Or use the **"Internal Database URL"**

2. **Import Database:**
   
   **Option A: Using Render's Database Dashboard**
   - Some Render plans include a web SQL editor
   - Copy contents of `config/database.postgresql.sql`
   - Paste and execute

   **Option B: Using psql Command Line**
   ```bash
   # Get connection string from Render
   psql "postgresql://user:password@host:port/database"
   
   # Then run:
   \i config/database.postgresql.sql
   ```

   **Option C: Using pgAdmin or DBeaver**
   - Connect using Render's database credentials
   - Import the SQL file

3. **Fix Admin Password:**
   ```sql
   UPDATE users 
   SET password = '$2y$10$N9qo8uLOickgx2ZMRZoMyeIjZAgcfl7p92ldGxad68LJZdL17lhWy' 
   WHERE username = 'admin';
   ```

---

## Step 6: Update BASE_URL After Deployment

1. **Get Your Live URL:**
   - In Render dashboard, go to your Web Service
   - Your URL will be: `https://your-app-name.onrender.com`
   - Copy this URL

2. **Update Configuration:**
   - Edit `config/config.php` locally
   - Change BASE_URL to your actual Render URL
   - Commit and push to GitHub:
     ```bash
     git add config/config.php
     git commit -m "Update BASE_URL for Render deployment"
     git push
     ```
   - Render will auto-deploy the update

---

## Step 7: Verify Deployment

1. **Access Your Live Site:**
   - Go to: `https://your-app-name.onrender.com`
   - You should see the login page

2. **Test Login:**
   - Username: `admin`
   - Password: `admin123`

3. **Test Features:**
   - [ ] Dashboard loads
   - [ ] Can view students
   - [ ] Can add/edit/delete
   - [ ] Reports work

---

## Important Notes for Render

### Free Tier Limitations:
- ⚠️ **Spins down after 15 minutes of inactivity**
- ⚠️ **First request after spin-down takes 30-60 seconds** (cold start)
- ⚠️ **Not ideal for demos** - service may be sleeping

### Solutions:
- Keep service awake by pinging it regularly
- Or upgrade to Starter plan ($7/month) for always-on

### Database Connection:
- Render provides `DATABASE_URL` automatically
- The updated `db.php` reads this automatically
- No manual configuration needed if using `db.render.php`

---

## Quick Checklist

- [ ] Render account created
- [ ] PostgreSQL database created
- [ ] Database URL copied
- [ ] `config/db.php` updated for PostgreSQL (or replaced with `db.render.php`)
- [ ] Web Service created
- [ ] GitHub repository connected
- [ ] Environment variables set (DATABASE_URL, BASE_URL)
- [ ] Service deployed
- [ ] Database schema imported
- [ ] Admin password fixed
- [ ] BASE_URL updated with actual Render URL
- [ ] Live site tested

---

## Troubleshooting

### Service Won't Start
- Check build logs in Render dashboard
- Verify Start Command: `php -S 0.0.0.0:$PORT`
- Check for PHP errors in logs

### Database Connection Error
- Verify DATABASE_URL environment variable is set
- Check database is running in Render dashboard
- Verify `config/db.php` uses PostgreSQL connection

### 404 Errors
- Check BASE_URL is correct
- Verify all files are in repository
- Check file paths are correct

### Slow First Load
- This is normal on free tier (cold start)
- Service spins up after first request
- Consider upgrading for always-on

---

**Your project will be live at:** `https://your-app-name.onrender.com`

Good luck with your Render deployment! 🚀

