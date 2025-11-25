# Render Deployment - Quick Start Guide

## ⚠️ Important: Render Uses PostgreSQL (Not MySQL)

Your project uses MySQL, but Render uses PostgreSQL. I've created converted files for you.

---

## Step 1: Create PostgreSQL Database on Render

1. **Go to Render Dashboard:** https://dashboard.render.com
2. **Click "New +"** → **"PostgreSQL"**
3. **Configure:**
   - Name: `sams-db`
   - Database: `sams_db`
   - Region: Choose closest
   - Plan: Free
   - Click **"Create Database"**
4. **Wait 2-3 minutes** for creation
5. **Copy the "Internal Database URL"** (you'll need this!)

---

## Step 2: Update Database File for Render

**You need to replace `config/db.php` with the Render version:**

1. **Backup current file** (optional):
   - Rename `config/db.php` to `config/db.localhost.php`

2. **Use Render version:**
   - Copy `config/db.render.php` to `config/db.php`
   - OR manually update `config/db.php` to use PostgreSQL

3. **Commit to GitHub:**
   ```bash
   git add config/db.php
   git commit -m "Update database config for Render PostgreSQL"
   git push
   ```

---

## Step 3: Create Web Service on Render

1. **In Render Dashboard:**
   - Click **"New +"** → **"Web Service"**

2. **Connect GitHub:**
   - Click **"Connect GitHub"**
   - Authorize Render
   - Select: `petero-codes/leraningmanagement-system`

3. **Configure:**
   - **Name:** `sams-web`
   - **Environment:** `PHP`
   - **Build Command:** (leave empty)
   - **Start Command:** `php -S 0.0.0.0:$PORT`

4. **Add Environment Variables:**
   - Click **"Advanced"** → **"Environment"**
   - Add:
     - **Key:** `DATABASE_URL`
     - **Value:** (paste Internal Database URL from Step 1)
   - Add:
     - **Key:** `BASE_URL`
     - **Value:** `https://sams-web.onrender.com` (or your service name)

5. **Click "Create Web Service"**
6. **Wait 5-10 minutes** for deployment

---

## Step 4: Import Database

1. **Get Database Access:**
   - In Render dashboard, go to your PostgreSQL database
   - Find connection details or use psql

2. **Import Schema:**
   - Use `config/database.postgresql.sql` (I created this for you!)
   - Copy the SQL content
   - Run it in Render's database console or via psql

3. **Fix Admin Password:**
   ```sql
   UPDATE users 
   SET password = '$2y$10$N9qo8uLOickgx2ZMRZoMyeIjZAgcfl7p92ldGxad68LJZdL17lhWy' 
   WHERE username = 'admin';
   ```

---

## Step 5: Update BASE_URL

1. **Get Your Live URL:**
   - In Render dashboard → Your Web Service
   - Your URL: `https://sams-web.onrender.com` (or your service name)

2. **Update Locally:**
   - Edit `config/config.php`
   - Change: `define('BASE_URL', 'https://sams-web.onrender.com/');`

3. **Push to GitHub:**
   ```bash
   git add config/config.php
   git commit -m "Update BASE_URL for Render"
   git push
   ```
   - Render will auto-deploy the update

---

## Step 6: Test Your Live Site

1. **Visit:** `https://sams-web.onrender.com`
2. **Login:**
   - Username: `admin`
   - Password: `admin123`

---

## ⚠️ Important Notes

### Free Tier Limitations:
- **Spins down after 15 minutes of inactivity**
- **First request takes 30-60 seconds** (cold start)
- **Not ideal for demos** - may be sleeping

### Files I Created for You:
- ✅ `config/database.postgresql.sql` - PostgreSQL version of your database
- ✅ `config/db.render.php` - Render database configuration
- ✅ `RENDER_DEPLOYMENT_STEPS.md` - Complete detailed guide

---

## Quick Checklist

- [ ] Render account created
- [ ] PostgreSQL database created
- [ ] Database URL copied
- [ ] `config/db.php` updated (use `db.render.php`)
- [ ] Changes committed and pushed to GitHub
- [ ] Web Service created on Render
- [ ] GitHub connected
- [ ] Environment variables set (DATABASE_URL, BASE_URL)
- [ ] Service deployed
- [ ] Database imported (using `database.postgresql.sql`)
- [ ] Admin password fixed
- [ ] BASE_URL updated
- [ ] Live site tested

---

**Need detailed steps? See `RENDER_DEPLOYMENT_STEPS.md`**

**Your live URL will be:** `https://your-service-name.onrender.com`

Good luck! 🚀

