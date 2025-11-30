# Render PostgreSQL Database Form - How to Fill

## 📝 Form Fields - What to Enter

### ✅ Name
**Value:** `sams-db` (or any name you prefer)
- This is your database service name
- Example: `sams-db` or `learning-management-db`

### ✅ Project (Optional)
**Value:** Leave **EMPTY** or select/create a project
- This is optional
- You can skip it

### ✅ Environment (Optional)
**Value:** Leave **EMPTY**
- This is optional
- You can skip it

### ✅ Database (Optional)
**Value:** `sams_db` (recommended)
- This is the actual database name inside PostgreSQL
- Or leave empty to auto-generate
- Recommended: Enter `sams_db` to match your code

### ✅ User (Optional)
**Value:** Leave **EMPTY** (auto-generate)
- Render will create a user automatically
- You can leave this empty

### ✅ Region
**Value:** `Oregon (US West)` ✅
- ✅ Already selected correctly
- Keep this (same region as your web service)

### ✅ PostgreSQL Version
**Value:** `18` ✅
- ✅ Already selected
- PostgreSQL 18 is fine (latest version)

### ✅ Datadog API Key (Optional)
**Value:** Leave **EMPTY**
- This is for monitoring (optional)
- You can skip it

### ✅ Datadog Region (Optional)
**Value:** Leave **EMPTY**
- Only needed if you set Datadog API Key
- Skip it

### ✅ Plan Options
**Value:** Select **"Free"** plan
- Free tier is sufficient for your project
- Click on "Free" option

---

## 🎯 Complete Form Summary

| Field | Value |
|-------|-------|
| **Name** | `sams-db` |
| **Project** | (Leave empty) |
| **Environment** | (Leave empty) |
| **Database** | `sams_db` (recommended) |
| **User** | (Leave empty - auto-generate) |
| **Region** | `Oregon (US West)` ✅ |
| **PostgreSQL Version** | `18` ✅ |
| **Datadog API Key** | (Leave empty) |
| **Datadog Region** | (Leave empty) |
| **Plan** | **Free** ⚠️ SELECT THIS |

---

## ✅ Quick Checklist

- [ ] Name: `sams-db`
- [ ] Database: `sams_db` (optional but recommended)
- [ ] Region: `Oregon (US West)` ✅
- [ ] PostgreSQL Version: `18` ✅
- [ ] Plan: **Free** ⚠️ SELECT THIS
- [ ] Other fields: Leave empty (optional)

---

## 🚀 After Creating Database

1. **Wait 2-3 minutes** for database creation
2. **Get Internal Database URL:**
   - Click on your database
   - Find **"Internal Database URL"**
   - Copy it (you'll need it for environment variables)

3. **Use this URL for:**
   - `DATABASE_URL` environment variable in your Web Service

---

## 📋 Important Notes

- **Database Name:** `sams_db` matches your code
- **Free Plan:** Sufficient for academic projects
- **Same Region:** Keep Oregon (same as web service)
- **Internal URL:** You'll get this after creation

---

**Fill the form and click "Create Database"!** 🚀


