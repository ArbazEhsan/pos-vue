# POS Management System

A web-based **Point of Sale (POS) Management System** built with **Laravel and Vue.js**, designed to manage sales, transactions, products, purchasing, reporting, and other day-to-day business operations through a centralized application.

This repository represents the modernized version of the POS system, rebuilt using a Laravel-based backend and modern frontend tooling.

## 🚀 Features

* 🧾 **Point of Sale**

  * Process sales transactions
  * Manage POS operations
  * Generate transaction records

* 📦 **Product & Inventory Management**

  * Manage products
  * Track product-related information
  * Support barcode-based workflows

* 💰 **Ledger Management**

  * Maintain financial records
  * Track business transactions

* 🛒 **Purchase Management**

  * Manage purchasing activities
  * Maintain purchase records

* 📊 **Reports**

  * Access business and transaction reports
  * Review historical records

* 👤 **Authentication**

  * User authentication
  * Session management
  * Protected application areas

* 🏷️ **Barcode Support**

  * Barcode generation and processing support

## 🛠️ Technology Stack

### Backend

* **Laravel 8**
* **PHP 7.3+ / PHP 8.x**
* **MySQL**
* **Laravel Eloquent ORM**
* **Laravel Tinker**
* **Guzzle HTTP Client**

The project's Composer configuration specifies Laravel 8 and PHP `^7.3|^8.0`, along with the other backend dependencies.

### Frontend

* **Vue.js**
* **JavaScript**
* **Axios**
* **Alpine.js**
* **Tailwind CSS**
* **Laravel Mix**
* **PostCSS**
* **Autoprefixer**

The repository uses Laravel Mix for development and production asset compilation.

## 📁 Project Structure

```text
pos-vue/
├── app/                    # Application logic, models and controllers
├── bootstrap/              # Framework bootstrap files
├── config/                 # Application configuration
├── database/               # Migrations, factories and seeders
├── public/                 # Public assets and application entry point
├── resources/              # Views, JavaScript and frontend assets
├── routes/                 # Application routes
├── storage/                # Logs, cache and generated files
├── tests/                  # Automated tests
├── .env.example            # Environment configuration template
├── artisan                 # Laravel command-line interface
├── composer.json           # PHP dependencies
├── package.json            # Frontend dependencies and scripts
├── tailwind.config.js      # Tailwind CSS configuration
└── webpack.mix.js          # Laravel Mix configuration
```

The repository currently follows the standard Laravel project structure, including `app`, `bootstrap`, `config`, `database`, `public`, `resources`, `routes`, `storage`, and `tests`.

## 💻 Requirements

Before installing the project, make sure you have:

* PHP 7.3 or later
* Composer
* MySQL
* Node.js and npm
* Apache/Nginx or another PHP-compatible web server

For local development, you can use **XAMPP**, **Laragon**, or another Laravel-compatible environment.

## ⚙️ Installation

### 1. Clone the repository

```bash
git clone https://github.com/ArbazEhsan/pos-vue.git
```

Navigate into the project:

```bash
cd pos-vue
```

### 2. Install PHP dependencies

```bash
composer install
```

### 3. Install frontend dependencies

```bash
npm install
```

### 4. Configure environment

Copy the example environment file:

```bash
cp .env.example .env
```

On Windows, you can simply copy `.env.example` and rename the copy to:

```text
.env
```

### 5. Generate the Laravel application key

```bash
php artisan key:generate
```

### 6. Configure the database

Open `.env` and configure your MySQL database:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=pos
DB_USERNAME=root
DB_PASSWORD=
```

Create the database in MySQL before running the migrations.

### 7. Run database migrations

```bash
php artisan migrate
```

If the project contains seeders and you want to populate the database with sample/default data:

```bash
php artisan db:seed
```

### 8. Compile frontend assets

For development:

```bash
npm run dev
```

For production:

```bash
npm run production
```

The available npm scripts are defined through Laravel Mix.

### 9. Start the Laravel development server

```bash
php artisan serve
```

The application will normally be available at:

```text
http://127.0.0.1:8000
```

## 🔧 Development

During development, you can run:

```bash
php artisan serve
```

and in another terminal:

```bash
npm run watch
```

This allows Laravel to run the backend while Laravel Mix watches frontend assets for changes.

## 🗄️ Database

The application uses **MySQL** for persistent data storage.

Database configuration is controlled through the Laravel `.env` file.

Before deploying the application, make sure the database credentials and environment configuration are correctly set.

## 🔐 Security

Do not commit sensitive environment information to GitHub.

In particular, never commit:

```text
.env
```

or production database credentials, API keys, passwords, or other secrets.

Before deploying to production:

* Use strong database credentials.
* Enable HTTPS.
* Configure production environment variables.
* Disable unnecessary debug output.
* Keep Laravel and dependencies updated.
* Use secure authentication practices.
* Regularly back up the database.

## 🧪 Testing

Laravel's testing infrastructure is included in the project.

Run the test suite with:

```bash
php artisan test
```

or:

```bash
vendor/bin/phpunit
```

## 📦 Production Build

Before deploying the frontend assets to production:

```bash
npm run production
```

Then configure Laravel for production and serve the application through Apache or Nginx.

## 📌 Project Status

**Current Version:** POS Vue

This project is an updated implementation of the POS Management System using a Laravel-based backend and modern frontend tooling.

## 🔗 Repository

[POS Management System — GitHub Repository](https://github.com/ArbazEhsan/pos-vue?utm_source=chatgpt.com)

## 👨‍💻 Author

**Arbaz Ehsan**

[GitHub Profile — Arbaz Ehsan](https://github.com/ArbazEhsan?utm_source=chatgpt.com)

## 📄 License

This project is currently licensed under the **MIT License**, as specified in the project's Composer configuration.
