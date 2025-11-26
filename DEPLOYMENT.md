# Render Deployment Guide

## Quick Deployment Steps

### 1. Create PostgreSQL Database
- Render Dashboard → New → PostgreSQL
- Note the Internal Database URL

### 2. Create Web Service
- Render Dashboard → New → Web Service
- Connect GitHub repository
- Environment: PHP
- Start Command: `php -S 0.0.0.0:$PORT`
- Environment Variables:
  - `DATABASE_URL` - From PostgreSQL service
  - `BASE_URL` - Your Render app URL

### 3. Import Database
- Use `config/database.postgresql.sql`
- Import via Render database console

### 4. Deploy
- Render will auto-deploy from GitHub
- Wait for build to complete
- Access your live site!

## Detailed Guide

See `RENDER_DEPLOYMENT_STEPS.md` for complete instructions.

