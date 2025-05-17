# System Inventory

© 2024 Copyright : Revanza

---

## Table of Contents
1. [Requirements](#requirements)
2. [Installation](#installation)
3. [Configuration](#configuration)
4. [Database Setup](#database-setup)
5. [Seeding Initial Data](#seeding-initial-data)
6. [Storage Link](#storage-link)
7. [Running the Application](#running-the-application)
8. [Default Accounts](#default-accounts)
9. [Troubleshooting](#troubleshooting)
10. [About & Contact](#about--contact)

---

## Requirements
- **PHP 8.x**: Runs the backend logic and API for the inventory system.
- **Composer**: Manages PHP dependencies and Laravel packages.
- **Node.js & npm**: Used for compiling and managing frontend assets (CSS, JS) for the user interface.
- **SQL Server**: Stores all inventory, user, and transaction data securely.
- **Git** (optional): For version control and code management.

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

<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains over 2000 video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

## Laravel Sponsors

We would like to extend our thanks to the following sponsors for funding Laravel development. If you are interested in becoming a sponsor, please visit the Laravel [Patreon page](https://patreon.com/taylorotwell).

### Premium Partners

- **[Vehikl](https://vehikl.com/)**
- **[Tighten Co.](https://tighten.co)**
- **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
- **[64 Robots](https://64robots.com)**
- **[Cubet Techno Labs](https://cubettech.com)**
- **[Cyber-Duck](https://cyber-duck.co.uk)**
- **[Many](https://www.many.co.uk)**
- **[Webdock, Fast VPS Hosting](https://www.webdock.io/en)**
- **[DevSquad](https://devsquad.com)**
- **[Curotec](https://www.curotec.com/services/technologies/laravel/)**
- **[OP.GG](https://op.gg)**
- **[WebReinvent](https://webreinvent.com/?utm_source=laravel&utm_medium=github&utm_campaign=patreon-sponsors)**
- **[Lendio](https://lendio.com)**

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
