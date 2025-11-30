# Render Environment Variables - Complete Guide

## 🔑 Environment Variables to Add

After creating your Web Service on Render, you need to add these environment variables:

---

## Step 1: Access Environment Variables

1. In Render dashboard, go to your **Web Service**
2. Click on **"Environment"** tab (or look for "Environment Variables" section)
3. Click **"Add Environment Variable"** or **"+"** button

---

## Step 2: Add These Variables

### Variable 1: DATABASE_URL

**Key:** `DATABASE_URL`

**Value:** Get this from your PostgreSQL database:
1. Go to your **PostgreSQL database** in Render dashboard
2. Find **"Internal Database URL"** or **"Connection String"**
3. It looks like: `postgresql://user:password@host:port/database`
4. **Copy the entire URL**

**Example:**
```
postgresql://sams_db_user:abc123xyz@dpg-xxxxx-a.oregon-postgres.render.com:5432/sams_db_xxxx
```

**How to add:**
- Click **"Add Environment Variable"**
- **Key:** `DATABASE_URL`
- **Value:** (paste the Internal Database URL)
- Click **"Save"** or **"Add"**

---

### Variable 2: BASE_URL

**Key:** `BASE_URL`

**Value:** Your Render app URL
- Format: `https://your-service-name.onrender.com/`
- Replace `your-service-name` with your actual service name
- Example: `https://leraningmanagement-system-1.onrender.com/`

**How to add:**
- Click **"Add Environment Variable"** again
- **Key:** `BASE_URL`
- **Value:** `https://leraningmanagement-system-1.onrender.com/`
- Click **"Save"** or **"Add"**

---

## ✅ Final Environment Variables

You should have **2 environment variables**:

| Key | Value | Source |
|-----|-------|--------|
| `DATABASE_URL` | `postgresql://...` | From PostgreSQL database |
| `BASE_URL` | `https://leraningmanagement-system-1.onrender.com/` | Your Render app URL |

---

## 📋 Step-by-Step

### Getting DATABASE_URL:

1. **In Render dashboard:**
   - Go to your **PostgreSQL database** service
   - Look for **"Internal Database URL"** or **"Connection String"**
   - It's usually in the database overview page
   - **Copy the entire URL**

2. **If you can't find it:**
   - Click on your database
   - Look for **"Connect"** or **"Connection Info"** section
   - The Internal Database URL should be there

### Adding Variables:

1. **Go to your Web Service**
2. **Click "Environment" tab**
3. **Add DATABASE_URL:**
   - Key: `DATABASE_URL`
   - Value: (paste from PostgreSQL)
4. **Add BASE_URL:**
   - Key: `BASE_URL`
   - Value: `https://leraningmanagement-system-1.onrender.com/`
5. **Save changes**

---

## ⚠️ Important Notes

- **DATABASE_URL:** Must be the **Internal Database URL** (not external)
- **BASE_URL:** Include the trailing slash `/` at the end
- **After adding:** Render will automatically redeploy with new variables
- **Case sensitive:** Use exact case: `DATABASE_URL` and `BASE_URL`

---

## 🔍 Where to Find Internal Database URL

**In Render Dashboard:**
1. Click on your **PostgreSQL database**
2. Look for:
   - **"Internal Database URL"** section
   - Or **"Connection"** tab
   - Or **"Info"** section
3. Copy the URL that starts with `postgresql://`

---

## ✅ Verification

After adding both variables:
- They should appear in the Environment Variables list
- Render will show a message about redeploying
- Wait for the redeploy to complete

---

**Add these 2 environment variables and your app will connect to the database!** 🔑


