# Add Environment Variables to Render - Quick Guide

## 🎯 You Need to Add 2 Variables

Click the **"Edit"** button (pencil icon) next to "Environment Variables" and add these:

---

## ✅ Variable 1: DATABASE_URL

**Key:** `DATABASE_URL`

**Value:** Get this from your PostgreSQL database:
1. Go to your **PostgreSQL database** in Render (the one you just created)
2. Find **"Internal Database URL"** (it's usually on the main database page)
3. Copy the entire URL (starts with `postgresql://`)

**Example format:**
```
postgresql://sams_db_user:password123@dpg-xxxxx-a.oregon-postgres.render.com:5432/sams_db_xxxx
```

**Steps:**
- Click **"Edit"** button
- Click **"Add Environment Variable"** or **"+"**
- **Key:** `DATABASE_URL`
- **Value:** (paste the Internal Database URL from your PostgreSQL database)
- Click **"Save"**

---

## ✅ Variable 2: BASE_URL

**Key:** `BASE_URL`

**Value:** `https://leraningmanagement-system.onrender.com/`

**Steps:**
- Click **"Add Environment Variable"** again
- **Key:** `BASE_URL`
- **Value:** `https://leraningmanagement-system.onrender.com/`
- Click **"Save"`

---

## 📋 Quick Summary

| Key | Value | Where to Get |
|-----|-------|--------------|
| `DATABASE_URL` | `postgresql://...` | From PostgreSQL database → "Internal Database URL" |
| `BASE_URL` | `https://leraningmanagement-system.onrender.com/` | Your web service URL (already shown on your page) |

---

## ⚠️ Important Notes

- **DATABASE_URL:** Must be the **Internal Database URL** (not external)
- **BASE_URL:** Include the trailing slash `/` at the end
- **After saving:** Render will automatically redeploy
- **Case sensitive:** Use exact case: `DATABASE_URL` and `BASE_URL`

---

## 🔍 How to Get DATABASE_URL

1. In Render dashboard, click on your **PostgreSQL database** service
2. Look for **"Internal Database URL"** section
3. Copy the entire URL (it's long, starts with `postgresql://`)
4. Paste it as the value for `DATABASE_URL`

---

**Click "Edit" and add both variables now!** 🚀


