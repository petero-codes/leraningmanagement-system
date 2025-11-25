# Render Web Service Form - Correct Settings

## Current Form Status

Looking at your form, here's what needs to be fixed:

### ✅ CORRECT Settings:
1. **Name:** `leraningmanagement-system` ✅ (Good!)
2. **Branch:** `main` ✅ (Correct!)
3. **Region:** `Oregon (US West)` ✅ (Any region works, this is fine!)

### ❌ NEEDS FIXING:
1. **Language:** Currently `Node` ❌ → Should be **`PHP`** ✅

### ✅ OPTIONAL (Leave Empty):
- **Root Directory:** Leave empty ✅

---

## Step-by-Step: Fix the Form

### Step 1: Change Language to PHP
1. **Click on the "Language" dropdown** (currently shows "Node")
2. **Select "PHP"** from the dropdown menu
3. This is CRITICAL - your project is PHP, not Node.js!

### Step 2: Continue with Form
After changing to PHP, you'll see additional fields appear:

**Build Command:**
- Leave empty OR use: `composer install` (if you add composer.json later)
- For now, leave it empty

**Start Command:**
- Enter: `php -S 0.0.0.0:$PORT`
- This starts the PHP built-in server

### Step 3: Environment Variables (Important!)
Scroll down or look for "Environment" or "Advanced" section:

**Add these environment variables:**

1. **DATABASE_URL:**
   - Key: `DATABASE_URL`
   - Value: (You'll get this from your PostgreSQL database - copy the "Internal Database URL")
   - ⚠️ You need to create the PostgreSQL database first!

2. **BASE_URL:**
   - Key: `BASE_URL`
   - Value: `https://leraningmanagement-system.onrender.com`
   - (This will be your live URL)

### Step 4: Create the Service
- Click "Create Web Service" button
- Wait 5-10 minutes for deployment

---

## Important: Create Database First!

**Before creating the web service, you should:**

1. **Create PostgreSQL Database:**
   - Go back to Render dashboard
   - Click "New +" → "PostgreSQL"
   - Name: `sams-db`
   - Copy the "Internal Database URL"
   - Then come back to create the web service

2. **Use that Database URL** in the DATABASE_URL environment variable

---

## Quick Checklist

- [ ] Change Language from "Node" to "PHP"
- [ ] Start Command: `php -S 0.0.0.0:$PORT`
- [ ] Create PostgreSQL database first (get DATABASE_URL)
- [ ] Add DATABASE_URL environment variable
- [ ] Add BASE_URL environment variable
- [ ] Click "Create Web Service"

---

**Most Important:** Change Language to **PHP** right now! 🚀

