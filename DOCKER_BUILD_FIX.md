# Docker Build Error Fix

## Problem
The Docker build is failing when installing PHP extensions, specifically the GD extension with freetype/jpeg support.

## Solution Options

### Option 1: Use Simplified Dockerfile (Recommended)
I've created a simpler version that doesn't require GD extension (which is causing the error).

**Steps:**
1. Rename `Dockerfile.simple` to `Dockerfile`
2. Or update Render to use `Dockerfile.simple` as the Dockerfile path

### Option 2: Fix Current Dockerfile
I've updated the Dockerfile with:
- Better error handling
- Cleanup commands
- Fixed library names (libjpeg62-turbo-dev instead of libjpeg-dev)

### Option 3: Use Different Base Image
If issues persist, we can use a pre-built PHP image with extensions already installed.

---

## Quick Fix: Use Simplified Version

Since your project doesn't strictly need GD extension (for image processing), use the simplified version:

1. **In Render Dashboard:**
   - Go to your web service settings
   - Find "Dockerfile Path" or "Docker Settings"
   - Change from `Dockerfile` to `Dockerfile.simple`
   - Save and redeploy

2. **Or rename locally and push:**
   ```bash
   git mv Dockerfile Dockerfile.original
   git mv Dockerfile.simple Dockerfile
   git commit -m "Use simplified Dockerfile to fix build errors"
   git push
   ```

---

## What Changed

**Original Dockerfile issues:**
- GD extension with freetype/jpeg was failing
- Complex dependency chain

**Simplified Dockerfile:**
- Removed GD extension (not needed for your project)
- Only installs essential extensions: PDO, MySQL, PostgreSQL, ZIP
- Faster build time
- More reliable

---

## After Fix

Once the build succeeds:
1. Service will deploy
2. You can import the database schema
3. Test the application

---

**Try the simplified Dockerfile first - it should work!** 🚀

