# Render Deployment with Docker (No PHP Option)

## Solution: Use Docker Instead

Since PHP isn't available in the Render dropdown, we'll use **Docker** to run your PHP application.

---

## Step 1: Select Docker in Render Form

1. **In the Language dropdown:**
   - Select **"Docker"** (instead of PHP)
   - This will use the Dockerfile I created

2. **Other Settings:**
   - **Name:** `leraningmanagement-system` ✅
   - **Branch:** `main` ✅
   - **Region:** `Oregon (US West)` ✅
   - **Root Directory:** Leave empty ✅

---

## Step 2: Configure Docker Settings

After selecting Docker, you'll see Docker-specific fields:

**Dockerfile Path:**
- Leave as default: `Dockerfile`
- (I created this file for you)

**Docker Context:**
- Leave empty (uses root directory)

---

## Step 3: Environment Variables

Add these environment variables:

1. **DATABASE_URL:**
   - Key: `DATABASE_URL`
   - Value: (From your PostgreSQL database - Internal Database URL)

2. **BASE_URL:**
   - Key: `BASE_URL`
   - Value: `https://leraningmanagement-system.onrender.com`

3. **PORT:**
   - Key: `PORT`
   - Value: (Render sets this automatically - you might not need to add it)

---

## Step 4: Create PostgreSQL Database First

**Before creating web service:**

1. Go to Render dashboard
2. Click **"New +"** → **"PostgreSQL"**
3. Name: `sams-db`
4. Copy **"Internal Database URL"**
5. Use this in DATABASE_URL environment variable

---

## Step 5: Commit Dockerfile to GitHub

The Dockerfile needs to be in your GitHub repository:

```bash
git add Dockerfile .dockerignore .htaccess
git commit -m "Add Dockerfile for Render deployment"
git push
```

---

## Step 6: Create Web Service

1. **Select Docker** in Language dropdown
2. **Add environment variables** (DATABASE_URL, BASE_URL)
3. **Click "Create Web Service"**
4. **Wait 5-10 minutes** for build and deployment

---

## What the Dockerfile Does

- Uses PHP 8.1 with Apache
- Installs PHP extensions (PDO for MySQL/PostgreSQL)
- Copies your application files
- Sets up Apache web server
- Exposes port 80 (Render maps this to $PORT)

---

## Quick Checklist

- [ ] Select **"Docker"** in Language dropdown
- [ ] Create PostgreSQL database first
- [ ] Get DATABASE_URL from database
- [ ] Commit Dockerfile to GitHub (I'll help with this)
- [ ] Add DATABASE_URL environment variable
- [ ] Add BASE_URL environment variable
- [ ] Click "Create Web Service"

---

**Next Step:** Select "Docker" in the dropdown, then I'll help you commit the Dockerfile to GitHub! 🚀

