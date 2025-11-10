# 🧭 GRC Platform

A modern **Governance, Risk & Compliance (GRC)** management platform built with **Laravel 12**, **TailwindCSS**, and **Vite**.  
It provides dynamic dashboards, assessment modules, and analytics tools to help organizations manage risk, ensure compliance, and monitor performance — all in one unified platform.

---

## 🚀 Features

### 🔐 Core System
- **Authentication & Authorization** via Laravel Breeze / Jetstream  
- **Role-based Access Control (RBAC)** (Admin, Manager, User)  
- **Spatie Query Builder** integration for flexible API filtering and sorting  
- **CSRF-protected forms**, secure session handling, and user management  

### 📊 Admin Dashboard
- Clean, responsive **dark theme** with orange accent (`#FF7500`)  
- Dynamic widgets for:
  - Total assessments
  - Active users
  - Compliance overview  
- Interactive sidebar with icons and active link highlighting  

### 🧩 Assessments Module
- Create, view, and manage compliance assessments  
- Advanced filtering and searching powered by **Spatie QueryBuilder**  
- Export data to **Excel / CSV** with Laravel Excel  
- Validation and secure file handling  

### 🗂️ Articles & Resources
- CMS-style article management with timestamps and CKEditor  
- Pagination, sorting, and soft deletion support  
- File upload system integrated with the `media` table  

### ⚙️ Additional Features
- Dynamic Blade layout using Tailwind and Alpine.js  
- Responsive design (desktop + mobile friendly)  
- Live Chatbot integration (ChatGPT API)  
- Import/Export tools for Excel  
- Modular routing (Admin / Client separation)  

---

## 🧱 Tech Stack

| Layer | Technologies |
|-------|---------------|
| **Backend** | Laravel 12 (PHP 8.3), Spatie QueryBuilder |
| **Frontend** | TailwindCSS, Alpine.js, Blade Templates |
| **Database** | MySQL / PostgreSQL |
| **Utilities** | Vite, Laravel Excel, CKEditor |
| **Authentication** | Laravel Breeze / Sanctum |
| **Deployment** | DigitalOcean / Laravel Forge compatible |

---

## ⚡ Installation

### 1. Clone the repository
```bash
git clone https://github.com/abuel3ees/GRC.git
cd GRC
```
### 2. Install Dependencies
```bash
composer install
npm installcp
```
### 3. Configure environment
```bash
.env.example .env
```
Then edit your .env file
```bash
APP_NAME=GRC
APP_ENV=local
APP_DEBUG=true
APP_URL=http://localhost

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=grc_db
DB_USERNAME=root
DB_PASSWORD=
```
### 4. Generate app key
```bash
php artisan key:generate
php artisan migrate --seed
```
### 5. Build and serve the app
```bash
npm run dev
php artisan serve
```


