# Capstone System - Barangay Management System

A comprehensive backend API system for barangay management built with Laravel 12.

## Features

- **User Management**: Multi-role authentication (User, Admin, SuperAdmin)
- **Complaint System**: File and track community complaints
- **Document Requests**: Request official barangay documents with tracking
- **Announcements**: Public announcements and news
- **Officials Directory**: Manage barangay officials information
- **API Authentication**: Secure token-based authentication with Laravel Sanctum

## Tech Stack

- **Framework**: Laravel 12
- **Database**: SQLite (default) / MySQL
- **Authentication**: Laravel Sanctum
- **PHP Version**: 8.3+

## Installation

1. Install dependencies: `composer install`
2. Copy environment: `cp .env.example .env`
3. Generate key: `php artisan key:generate`
4. Run migrations: `php artisan migrate`
5. Seed database: `php artisan db:seed`
6. Start server: `php artisan serve`

## Default Accounts

**Super Admin**: superadmin@capstone.com / password
**Admin**: admin@capstone.com / password
**User**: john@example.com / password

## API Documentation

See [API_DOCUMENTATION.md](API_DOCUMENTATION.md) for complete API documentation.

API Base URL: `http://localhost:8000/api`

## License

MIT License
