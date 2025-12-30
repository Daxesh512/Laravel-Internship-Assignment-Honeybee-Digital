# Business Directory & Duplicate Management System

A robust Laravel-based application designed to manage large volumes of business listings. It features an intelligent **Import Engine** that automatically detects duplicates and incomplete data, a **Merge Module** for data consolidation, and an **Analytical Dashboard**.

## 🚀 Key Features

* **Smart Import:** Upload `.xlsx` or `.csv` files. The system automatically flags records based on predefined duplicate logic.
* **Duplicate Management:** Side-by-side comparison UI to merge redundant records while choosing which data points to keep.
* **Data Health Tracking:** Automatically identifies "Incomplete" records (missing phone numbers, ratings, or addresses).
* **Analytical Reporting:** Visual breakdown of business density by City and Category.
* **Excel Exports:** Generate comprehensive database health reports in Excel format.
* **Secure Auth:** Built on Laravel Breeze (Tailwind + Alpine.js) with a Bootstrap 5 integrated data layer.

---

## 🛠️ Tech Stack

* **Framework:** [Laravel 11.x](https://laravel.com)
* **Frontend:** Tailwind CSS (Auth/Layout) & Bootstrap 5 (Data Tables/Forms)
* **Database:** MySQL / PostgreSQL
* **Excel Engine:** [Laravel Excel (Maatwebsite)](https://docs.laravel-excel.com/)
* **Auth:** Laravel Breeze

---

## 📦 Installation Guide

### 1. Clone and Install Dependencies

```bash
git clone https://github.com/yourusername/business-directory.git
cd business-directory
composer install
npm install && npm run build

```

### 2. Environment Setup

```bash
cp .env.example .env
php artisan key:generate

```

*Configure your database settings in the `.env` file:*

```text
DB_DATABASE=your_db_name
DB_USERNAME=your_db_user
DB_PASSWORD=your_db_password

```

### 3. Database Migration & Storage

```bash
php artisan migrate
php artisan storage:link

```

### 4. Run the Application

```bash
php artisan serve
```

## 🔐 User Registration
Users can register an account by visiting the `/register` route. Once registered, they gain full access to the management dashboard.

```
🔐 Authentication & User Access
The system uses Laravel Breeze for secure access control.

Registration: New administrators can create an account by navigating to /register.

Access Control: All core modules (Businesses, Imports, Duplicates, and Reports) are protected by the auth middleware. Unauthenticated users will be redirected to the login page.

Profile Management: Users can update their name, email, and password via the /profile section accessible from the top-right navigation dropdown.

---

## 📂 Project Structure Highlights

* **`App\Services\BusinessService`**: Contains the core logic for duplicate identification and the atomic `DB::transaction` merge logic.
* **`App\Imports\BusinessImport`**: Manages the mapping of Excel rows to the database and triggers health checks.
* **`App\Http\Controllers\DuplicateController`**: Handles the complex side-by-side comparison logic.

---

## 📊 Import Template

To ensure the import works correctly, use a CSV/Excel file with the following headers:
`business_name`, `category`, `ratings`, `address`, `area`, `city`, `phone1`, `phone2`.

---

