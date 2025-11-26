# Render.com Setup - Complete Guide

## 🚀 Quick Deployment Steps

### Step 1: Create PostgreSQL Database

1. Go to https://dashboard.render.com
2. Click **"New +"** → **"PostgreSQL"**
3. Configure:
   - **Name:** `sams-db`
   - **Database:** `sams_db`
   - **Region:** Choose closest
   - **Plan:** Free
4. Click **"Create Database"**
5. Wait 2-3 minutes
6. **Copy the "Internal Database URL"** (you'll need this!)

### Step 2: Create Web Service

1. In Render dashboard, click **"New +"** → **"Web Service"**
2. **Connect GitHub:**
   - Click **"Connect GitHub"**
   - Authorize Render
   - Select repository: `petero-codes/leraningmanagement-system`
3. **Configure:**
   - **Name:** `sams-web` (or any name)
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
5. Click **"Create Web Service"**
6. Wait 5-10 minutes for deployment

### Step 3: Import Database

1. In Render dashboard, go to your PostgreSQL database
2. Find **"Connect"** or **"psql"** option
3. Use the SQL console or connect via psql
4. Copy contents of `config/database.postgresql.sql`
5. Paste and execute in database console
6. Wait for import to complete

### Step 4: Fix Admin Password

Run this SQL in the database console:

```sql
UPDATE users 
SET password = '$2y$10$N9qo8uLOickgx2ZMRZoMyeIjZAgcfl7p92ldGxad68LJZdL17lhWy' 
WHERE username = 'admin';
```

### Step 5: Update BASE_URL

1. After deployment, get your live URL from Render
2. Update `config/config.php` locally:
   ```php
   define('BASE_URL', 'https://your-actual-url.onrender.com/');
   ```
3. Commit and push to GitHub:
   ```bash
   git add config/config.php
   git commit -m "Update BASE_URL for Render"
   git push
   ```
4. Render will auto-deploy the update

### Step 6: Test Your Site

1. Visit your Render app URL
2. Login: `admin` / `admin123`
3. Test all features

---

## ✅ Checklist

- [ ] PostgreSQL database created
- [ ] Database URL copied
- [ ] Web Service created
- [ ] GitHub connected
- [ ] Environment variables set (DATABASE_URL, BASE_URL)
- [ ] Service deployed
- [ ] Database imported
- [ ] Admin password fixed
- [ ] BASE_URL updated
- [ ] Site tested

---

## 📝 Important Notes

- **Free Tier:** Spins down after 15 minutes of inactivity
- **First Load:** May take 30-60 seconds (cold start)
- **Database:** Uses PostgreSQL (not MySQL)
- **Auto-Deploy:** Changes pushed to GitHub auto-deploy

---

**Your project is ready for Render deployment!** 🚀

