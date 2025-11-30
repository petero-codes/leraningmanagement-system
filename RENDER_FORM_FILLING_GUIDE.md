# How to Fill Render Web Service Form

## 📝 Form Fields - What to Enter

### ✅ Name
**Value:** `leraningmanagement-system-1` (or any name you prefer)
- ✅ Already filled correctly
- This is your service name

### ✅ Project (Optional)
**Value:** Leave empty or select/create a project
- This is optional
- You can skip it

### ✅ Environment (Optional)
**Value:** Leave empty
- This is optional
- You can skip it

### ⚠️ Language - IMPORTANT!
**Current:** Shows "Node" ❌
**Change to:** `PHP` ✅

**How to change:**
1. Click the "Language" dropdown
2. Look for **"PHP"** in the list
3. Select **"PHP"**
4. If PHP is not in the dropdown, see alternative below

### ✅ Branch
**Value:** `main`
- ✅ Already correct
- This is your GitHub branch

### ✅ Region
**Value:** `Oregon (US West)` (or your preferred region)
- ✅ Already selected
- This is fine

### ✅ Root Directory (Optional)
**Value:** Leave **EMPTY**
- Don't enter anything
- Your files are in the repository root

### ⚠️ Build Command - IMPORTANT!
**Current:** `yarn` ❌
**Change to:** Leave **EMPTY** or delete the text

**How to change:**
1. Clear the "Build Command" field
2. Leave it completely empty
3. PHP doesn't need a build command

### ⚠️ Start Command - IMPORTANT!
**Current:** `yarn start` ❌
**Change to:** `php -S 0.0.0.0:$PORT` ✅

**How to change:**
1. Clear the "Start Command" field
2. Enter exactly: `php -S 0.0.0.0:$PORT`
3. This starts the PHP development server

### ✅ Instance Type
**Value:** Select **"Free"** (if available)
- Free tier is sufficient
- Or choose the cheapest option

---

## 🎯 Complete Form Summary

| Field | Value |
|-------|-------|
| **Name** | `leraningmanagement-system-1` ✅ |
| **Project** | (Leave empty) |
| **Environment** | (Leave empty) |
| **Language** | **PHP** ⚠️ CHANGE THIS |
| **Branch** | `main` ✅ |
| **Region** | `Oregon (US West)` ✅ |
| **Root Directory** | (Leave empty) |
| **Build Command** | (Leave empty) ⚠️ CLEAR THIS |
| **Start Command** | `php -S 0.0.0.0:$PORT` ⚠️ CHANGE THIS |
| **Instance Type** | **Free** |

---

## ⚠️ If PHP is Not in Language Dropdown

**Option 1: Use "Docker"**
- Select "Docker" as language
- We'll need to create a Dockerfile (I can help with this)

**Option 2: Use "Static Site"**
- Not recommended for PHP apps

**Option 3: Contact Render Support**
- Ask them to enable PHP for your account

**Most Common:** PHP should be in the dropdown. Look carefully or scroll down.

---

## ✅ After Filling Form

1. **Click "Create Web Service"**
2. **Add Environment Variables:**
   - `DATABASE_URL` - From your PostgreSQL database
   - `BASE_URL` - Your Render app URL (update after creation)
3. **Wait for deployment** (5-10 minutes)

---

## 🔑 Key Changes Needed

1. **Language:** Change from "Node" to **"PHP"**
2. **Build Command:** Clear it (leave empty)
3. **Start Command:** Change to `php -S 0.0.0.0:$PORT`

---

**Make those 3 changes and you're good to go!** 🚀


