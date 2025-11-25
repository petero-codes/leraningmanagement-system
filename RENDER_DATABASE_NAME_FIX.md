# Render Database Name Format Fix

## Error: Database name validation
The database name must match: `/(^[a-z_][a-z0-9_]*$)|(^$)/`

This means:
- ✅ Must start with lowercase letter (a-z) or underscore (_)
- ✅ Can contain lowercase letters, numbers, and underscores only
- ❌ NO uppercase letters
- ❌ NO hyphens (-)
- ❌ NO spaces
- ❌ NO special characters

---

## Correct Database Names

### ✅ VALID Names:
- `sams_db` ✅
- `samsdb` ✅
- `student_management` ✅
- `sams_project` ✅
- `_sams_db` ✅ (starts with underscore)

### ❌ INVALID Names:
- `sams-db` ❌ (has hyphen)
- `SAMS_DB` ❌ (has uppercase)
- `sams db` ❌ (has space)
- `sams.db` ❌ (has period)

---

## Solution: Use `sams_db`

**In the Render PostgreSQL form:**

1. **Database Name:** `sams_db` (lowercase, underscore - no hyphen!)
2. **Service Name:** `sams-db` (this can have hyphens - it's different from database name)

**Important:** 
- **Service Name** (the hosting service) can have hyphens: `sams-db`
- **Database Name** (the actual database) must use underscores: `sams_db`

---

## Step-by-Step Fix

1. **In the PostgreSQL creation form:**
   - **Name (Service Name):** `sams-db` ✅ (can have hyphen)
   - **Database:** `sams_db` ✅ (must use underscore, lowercase only)
   - **User:** (auto-generated)
   - **Region:** Your chosen region
   - **Plan:** Free

2. **Click "Create Database"**

---

## Quick Reference

| Field | Format | Example | Notes |
|-------|--------|---------|-------|
| **Service Name** | Can have hyphens | `sams-db` | This is the hosting service name |
| **Database Name** | Lowercase + underscore only | `sams_db` | Must match regex pattern |

---

**Use `sams_db` (with underscore) for the database name!** ✅

