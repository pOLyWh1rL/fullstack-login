# Full Stack Login System (PHP MVC)

A fully integrated, monolithic web application demonstrating a strict Model-View-Controller (MVC) architecture built entirely from scratch. 

## 🚀 Tech Stack
* **Architecture:** MVC (Model-View-Controller)
* **Backend:** PHP 8.x
* **Frontend (Views):** HTML5, PHP, Bootstrap 5
* **Database:** MySQL (PDO Prepared Statements)
* **APIs:** Native REST and SOAP implementations
* **Environment:** XAMPP (Apache/MySQL)

## 🌟 Key Features
* **Secure Authentication:** User registration and login utilizing `password_hash()` and `password_verify()`.
* **Session Management:** Protected dashboard and routes using native PHP `$_SESSION`.
* **Strict MVC Separation:** * **Models:** Handle all direct database interactions and SQL queries.
  * **Controllers:** Manage input validation, business logic, and data passing.
  * **Views:** Dynamic frontend rendering using embedded PHP and Bootstrap.
* **API Integration:** Includes custom-built REST endpoints and a native PHP SOAP server to demonstrate API data fetching.
* **Security Best Practices:** Excluded database credentials via `.gitignore` and utilized PDO to prevent SQL injection.

## 🛠️ Local Setup Instructions

### 1. Database Configuration
1. Start the **Apache** and **MySQL** modules in your XAMPP Control Panel.
2. Open phpMyAdmin (`http://localhost/phpmyadmin`).
3. Import the provided `database.sql` file to create the `fullstack_login_db` database and `users` table.

### 2. Application Configuration
1. Clone this repository into your XAMPP `htdocs` directory (e.g., `C:/xampp/htdocs/fullstack-login`).
2. Navigate to the `config/` directory.
3. Rename the `db.example.php` file to `db.php`.
4. Open `db.php` and verify the default XAMPP credentials match your local setup:
   ```php
   $host = '127.0.0.1';
   $db   = 'fullstack_login_db';
   $user = 'root';
   $pass = ''; // Leave blank for default XAMPP