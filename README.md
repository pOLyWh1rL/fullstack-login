# Full Stack Login System (React + PHP MVC)

A fully decoupled web application demonstrating the Model-View-Controller (MVC) architecture. 

## 🚀 Tech Stack
* **Frontend (View):** React.js (Vite), Bootstrap 5, React Router
* **Backend (Controller):** PHP (REST & SOAP APIs)
* **Database (Model):** MySQL (PDO Prepared Statements)
* **Server:** XAMPP (Apache)

## 🌟 Features
* User Registration (with password hashing)
* Login Authentication (localStorage session management)
* Protected Dashboard Route
* Dynamic User List fetched via REST API
* Native SOAP API implementation

## 🛠️ Setup Instructions

### 1. Database Setup
1. Start Apache and MySQL in XAMPP.
2. Open `http://localhost/phpmyadmin`.
3. Create a database named `fullstack_login_db` or import the provided `database.sql` file.

### 2. Backend Setup
1. Place the project folder in your XAMPP `htdocs` directory (`C:/xampp/htdocs/fullstack-login`).
2. Ensure `config/db.php` has the correct database credentials.

### 3. Frontend Setup
1. Open a terminal and navigate to the `client` folder.
2. Run `npm install` to install dependencies.
3. Run `npm run dev` to start the Vite development server.
4. Open the provided localhost link (usually `http://localhost:5173`).