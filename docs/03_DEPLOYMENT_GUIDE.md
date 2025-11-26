# Deployment Guide - Render.com

## Overview

This guide covers deployment of the Student Academic Management System to Render.com.

---

## Prerequisites

- GitHub account
- Render.com account (free tier available)
- Project files pushed to GitHub repository

---

## Step-by-Step Instructions

### Step 1: Create PostgreSQL Database

1. Log in to Render.com
2. Click **"New +"** → **"PostgreSQL"**
3. Configure database:
   - Name: `sams-db`
   - Database: `sams_db`
   - User: Auto-generated
   - Region: Choose closest to you
   - Plan: Free tier
4. Click **"Create Database"**
5. Wait 2-3 minutes
6. Note down the **"Internal Database URL"**

### Step 2: Create Web Service

1. In Render dashboard, click **"New +"** → **"Web Service"**
2. Connect your GitHub repository
3. Configure service:
   - Name: `sams-web`
   - Environment: `PHP`
   - Build Command: (leave empty)
   - Start Command: `php -S 0.0.0.0:$PORT`
4. Add Environment Variables:
   - `DATABASE_URL`: (from PostgreSQL service)
   - `BASE_URL`: `https://your-app-name.onrender.com`
5. Click **"Create Web Service"**

### Step 3: Import Database Schema

1. Access your PostgreSQL database via Render dashboard
2. Use the SQL console or connect via psql
3. Run the SQL script from `config/database.postgresql.sql`
4. Fix admin password:
   ```sql
   UPDATE users 
   SET password = '$2y$10$N9qo8uLOickgx2ZMRZoMyeIjZAgcfl7p92ldGxad68LJZdL17lhWy' 
   WHERE username = 'admin';
   ```

### Step 4: Verify Deployment

1. Wait for build to complete (5-10 minutes)
2. Visit your app URL: `https://your-app-name.onrender.com`
3. Test login with default admin credentials

---

## Getting Live Link

- Your app will be available at: `https://your-app-name.onrender.com`
- Free tier includes automatic SSL certificate

---

## Important Notes

- **Free Tier:** Spins down after 15 minutes of inactivity
- **First Request:** May take 30-60 seconds (cold start)
- **Database:** Uses PostgreSQL (not MySQL)
- **Auto-Deploy:** Changes pushed to GitHub auto-deploy

---

For detailed instructions, see `RENDER_SETUP.md` or `RENDER_DEPLOYMENT_STEPS.md`.

