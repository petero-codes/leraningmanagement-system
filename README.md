# Student Academic Management System (SAMS)

A complete dynamic web application built with PHP, PostgreSQL, HTML, CSS, and JavaScript for managing student records, courses, and academic reports.

## 🚀 Deployment

This project is configured for deployment on **Render.com**.

- **GitHub Repository:** https://github.com/petero-codes/leraningmanagement-system.git
- **Live Application:** (Update after deployment)

## 📋 Features

- User Authentication (Login/Logout with Sessions)
- Student CRUD Operations
- Course Management
- Enrollment Management
- Academic Reports (3 different report types)
- Responsive UI Design (Neomorphism & Glassmorphism)
- Secure Database Operations (Prepared Statements)

## 🛠️ Technology Stack

- **Backend:** PHP 7.4+
- **Database:** PostgreSQL (Render)
- **Frontend:** HTML5, CSS3, JavaScript
- **Design:** Responsive with Neomorphism & Glassmorphism effects

## 📁 Project Structure

```
/project-root
   /assets
      /css
      /js
   /config
      db.php (PostgreSQL for Render)
      config.php
      database.postgresql.sql
   /includes
   /php
   /reports
   /views
   /docs
   index.php
   login.php
   dashboard.php
   register.php
```

## 🚀 Quick Start (Render Deployment)

### Prerequisites
- GitHub account
- Render.com account
- PostgreSQL database on Render

### Deployment Steps

1. **Create PostgreSQL Database on Render**
   - Go to Render dashboard
   - Create new PostgreSQL database
   - Note the Internal Database URL

2. **Create Web Service on Render**
   - Connect GitHub repository
   - Environment: PHP
   - Start Command: `php -S 0.0.0.0:$PORT`
   - Add Environment Variable: `DATABASE_URL` (from PostgreSQL)

3. **Import Database**
   - Use `config/database.postgresql.sql`
   - Import via Render's database console or psql

4. **Set Environment Variables**
   - `DATABASE_URL` - PostgreSQL connection string
   - `BASE_URL` - Your Render app URL

## 📚 Documentation

Complete project documentation is available in the `/docs` folder:
- Project Proposal
- System Design
- Deployment Guide
- Complete Documentation
- User Manual

## 🔐 Default Login

- **Username:** `admin`
- **Password:** `admin123`

## 📝 License

Academic Project - Student Academic Management System
