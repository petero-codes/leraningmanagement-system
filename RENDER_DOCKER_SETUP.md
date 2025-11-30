# Render Setup with Docker (PHP Not Available)

## ⚠️ Problem: PHP Not in Language Dropdown

Render doesn't always show PHP in the web service dropdown. **Solution: Use Docker!**

---

## ✅ Solution: Use Docker

I've created a `Dockerfile` for you. Here's how to use it:

---

## 📝 How to Fill the Form

### Language
- **Select:** `Docker` ✅
- This will use the Dockerfile I created

### Build Command
- **Leave EMPTY** ✅
- Docker will build automatically

### Start Command
- **Leave EMPTY** ✅
- Docker will start automatically

### Other Fields
- **Name:** `leraningmanagement-system-1` ✅
- **Branch:** `main` ✅
- **Region:** `Oregon (US West)` ✅
- **Root Directory:** (empty) ✅
- **Instance Type:** `Free` ✅

---

## 🚀 Steps

### Step 1: Fill Form
1. **Language:** Select `Docker`
2. **Build Command:** (empty)
3. **Start Command:** (empty)
4. Fill other fields as shown above
5. Click **"Create Web Service"**

### Step 2: Add Environment Variables
After creating the service:
1. Go to **"Environment"** tab
2. Add:
   - **Key:** `DATABASE_URL`
   - **Value:** (from your PostgreSQL database)
   - **Key:** `BASE_URL`
   - **Value:** `https://leraningmanagement-system-1.onrender.com`

### Step 3: Wait for Deployment
- Render will build the Docker image
- This takes 5-10 minutes
- Watch the build logs

---

## ✅ What I Created

1. **`Dockerfile`** - PHP 8.3 with Apache and PostgreSQL support
2. **`.htaccess`** - URL rewriting for clean URLs

---

## 📋 Form Summary

| Field | Value |
|-------|-------|
| **Language** | **Docker** ⚠️ SELECT THIS |
| **Build Command** | (empty) |
| **Start Command** | (empty) |
| **Name** | `leraningmanagement-system-1` |
| **Branch** | `main` |
| **Region** | `Oregon (US West)` |
| **Instance Type** | `Free` |

---

## ✅ After Deployment

1. **Import Database:**
   - Use `config/database.postgresql.sql`
   - Import via Render database console

2. **Fix Admin Password:**
   ```sql
   UPDATE users 
   SET password = '$2y$10$N9qo8uLOickgx2ZMRZoMyeIjZAgcfl7p92ldGxad68LJZdL17lhWy' 
   WHERE username = 'admin';
   ```

3. **Test:**
   - Visit your Render URL
   - Login: `admin` / `admin123`

---

**Select "Docker" as the language - it will work perfectly!** 🐳


