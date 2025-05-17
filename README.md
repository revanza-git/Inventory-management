# System Inventory

© 2024 Copyright : Revanza

---

## Table of Contents
1. [Requirements](#requirements)
2. [Features](#features)
3. [UI Preview](#ui-preview)
4. [Installation](#installation)
5. [Configuration](#configuration)
6. [Database Setup](#database-setup)
7. [Seeding Initial Data](#seeding-initial-data)
8. [Storage Link](#storage-link)
9. [Running the Application](#running-the-application)
10. [Default Accounts](#default-accounts)
11. [Troubleshooting](#troubleshooting)
12. [About & Contact](#about--contact)

---

## Requirements
- **PHP 8.x**: Runs the backend logic and API for the inventory system.
- **Composer**: Manages PHP dependencies and Laravel packages.
- **Node.js & npm**: Used for compiling and managing frontend assets (CSS, JS) for the user interface.
- **SQL Server**: Stores all inventory, user, and transaction data securely.
- **Git** (optional): For version control and code management.

---

## Features

### Inventory Management
- **Multi-Category Inventory Tracking**
  - Electrical parts and equipment
  - Instrumentation components
  - Mechanical parts
  - Provision/Tie-in materials
  - Emergency supplies
  - Reliability equipment
  - Scrap materials
  - IT equipment
  - Department-specific inventories (Layum, Sekper, HSSE)

### Stock Control
- **Stock In/Out Management**
  - Add new stock with detailed information
  - Remove stock with tracking
  - Historical stock tracking
  - Stock level monitoring
  - Old stock management

### Document Management
- **File Attachments**
  - Support for photos (JPG, PNG)
  - PDF document storage (PO, BAST)
  - Digital signature storage
  - Document version control

### User Management
- **Role-Based Access Control**
  - Admin privileges
  - Department-specific access
  - User authentication
  - Secure login system

### Approval System
- **Multi-level Approval Process**
  - First approval
  - Second approval
  - Third approval
  - Fourth approval
  - Digital signature integration

### Reporting & Analytics
- **Transaction Tracking**
  - Stock movement history
  - Department-wise reports
  - Date-range based filtering
  - Transaction counts and summaries

### Additional Features
- **Search & Filter**
  - Part number search
  - Category-based filtering
  - Location tracking
  - Material categorization

- **Data Validation**
  - Input validation
  - Data integrity checks
  - Error handling
  - Duplicate prevention

---

## UI Preview

### Main Dashboard
![System Inventory Dashboard](sinv0.jpg)

### Inventory Management Interface
![Inventory Management](sinv1.jpg)

---

## Installation
1. **Clone the repository:**
   ```bash
   git clone <your-repo-url>
   cd <your-project-directory>
   ```
2. **Install PHP dependencies:**
   ```bash
   composer install
   ```
3. **Install Node.js dependencies:**
   ```bash
   npm install
   ```

---

## Configuration
1. **Copy the example environment file (if available) or create a new `.env`:**
   ```bash
   cp .env.example .env
   ```
   If `.env.example` does not exist, create a `.env` file manually.
2. **Set your database credentials and other environment variables in `.env`:**
   ```
   DB_CONNECTION=sqlsrv
   DB_HOST=127.0.0.1
   DB_PORT=1433
   DB_DATABASE=your_database
   DB_USERNAME=your_username
   DB_PASSWORD=your_password
   ```
3. **Generate application key:**
   ```bash
   php artisan key:generate
   ```

---

## Database Setup
1. **Create a new database** in your SQL Server for this project.
2. **Run migrations to create tables:**
   ```bash
   php artisan migrate
   ```
   _This will create all tables required for inventory, user management, and transaction tracking._

---

## Seeding Initial Data
1. **Edit `database/seeders/DatabaseSeeder.php`** if you want to change the default secret code or superadmin account.
2. **Run the database seeder:**
   ```bash
   php artisan db:seed
   ```
   _This will create the initial superadmin account and secret code for system access._

---

## Storage Link
If your application uses file uploads or needs access to the `storage` directory, create a symbolic link:
```bash
php artisan storage:link
```
_This allows uploaded files (such as part images or documents) to be accessible from the web interface._

---

## Running the Application
1. **Start the Laravel development server:**
   ```bash
   php artisan serve
   ```
   _This launches the backend API and web server for the inventory system._
2. **(Optional) Build frontend assets:**
   ```bash
   npm run dev
   ```
   _This compiles and serves the latest CSS and JavaScript for the user interface._
3. **Access the application:**
   Open your browser and go to [http://localhost:8000](http://localhost:8000)

---

## Default Accounts
- **Superadmin**
  - Email: `superadmin@gmail.com`
  - Password: `Nusantara1;`
- **Secret Code:** `Nusantara08*Regas` (hashed in the database)

_After logging in as superadmin, you can create accounts for other departments/users._

---

## Troubleshooting
- **Date Conversion Errors:**  
  Ensure your `.env` database settings are correct and that your database is empty or contains only valid data after migration and seeding.
- **File Upload Issues:**  
  Make sure you have run `php artisan storage:link` and the `public/data` directory is accessible.
- **Permission Issues:**  
  Ensure your web server user has write permissions to the `storage` and `bootstrap/cache` directories.

---

## About & Contact
This project is a Laravel-based inventory management system, customized and maintained by Revanza.

**Contact:**
- Email: revanza.raytama@gmail.com
- LinkedIn: [linkedin.com/in/revanzaraytama/](https://linkedin.com/in/revanzaraytama/)

For more information, see the [Laravel documentation](https://laravel.com/docs).

If you need further customization or run into issues, please contact Revanza.