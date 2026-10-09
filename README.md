# LearnHub — Online Learning Platform

LearnHub is a web-based learning platform designed to manage online courses and users. It provides an organized environment where users can access learning resources while administrators manage courses and user accounts.

This project is developed as part of an academic web development project.

## Table of Contents

* [Overview](#overview)
* [Features](#features)
* [Technologies Used](#technologies-used)
* [Project Structure](#project-structure)
* [Requirements](#requirements)
* [Installation and Setup](#installation-and-setup)
* [Database Configuration](#database-configuration)
* [Running the Application](#running-the-application)
* [User Roles](#user-roles)
* [Application Workflow](#application-workflow)
* [Security](#security)
* [Future Improvements](#future-improvements)
* [Contributors](#contributors)
* [License](#license)

## Overview

LearnHub aims to provide a simple and accessible platform for online education.

The application separates its frontend, backend, database configuration, controllers, models, and authentication middleware to encourage a structured and maintainable codebase.

The platform focuses on course organization, user authentication, and administrative operations.

## Features

### Authentication and User Management

* User registration.
* User login and logout.
* Password confirmation during registration.
* Session-based authentication.
* Role-based access control.
* User search by name.
* User account deletion by an administrator.

### Course Management

* Create a course.
* Add modules to a course.
* Define the order of modules.
* Add lessons to modules.
* Organize learning content hierarchically.

### Administration Dashboard

* Dedicated administrator interface.
* Course and learning content management.
* User search and account management.
* Access to administrative actions.

### Application Architecture

* Separation of frontend and backend.
* MVC-inspired organization.
* PDO for database communication.
* Reusable PHP models and controllers.

## Technologies Used

| Technology | Purpose                       |
| ---------- | ----------------------------- |
| PHP        | Server-side logic             |
| MySQL      | Relational database           |
| PDO        | Database access               |
| HTML5      | Page structure                |
| CSS3       | Styling and responsive design |
| JavaScript | Client-side interactions      |
| Git        | Version control               |
| GitHub     | Source code hosting           |

## Project Structure

The project follows a frontend/backend organization.

```text
exercice_liantsoa/
│
├── frontend/
│   ├── index.php
│   ├── login.php
│   ├── singup.php
│   ├── admin.php
│   │
│   ├── css/
│   │   └── style.css
│   │
│   └── js/
│       └── script.js
│
├── backend/
│   ├── config/
│   │   └── database.php
│   │
│   ├── controllers/
│   │   ├── users.controllers.php
│   │   └── cours.controllers.php
│   │
│   ├── model/
│   │   └── user.php
│   │
│   └── middleware/
│       └── auth.php
│
├── README.md
└── .gitignore
```

*Note: The structure above is illustrative. Adjust filenames and directories to match the actual contents of your repository.*

## Requirements

Before installing LearnHub, make sure you have the following software installed:

* PHP 8.0 or a compatible version.
* MySQL or MariaDB.
* A web browser.
* Git.
* A local PHP development server or Apache with PHP support.

You can check your installed versions with:

```bash
php -v
mysql --version
git --version
```

## Installation and Setup

### 1. Clone the Repository

Clone the project from GitHub:

```bash
git clone <YOUR_GITHUB_REPOSITORY_URL>
```

Navigate to the project directory:

```bash
cd exercice_liantsoa
```

Replace `<YOUR_GITHUB_REPOSITORY_URL>` with the actual URL of your GitHub repository.

### 2. Create the Database

Open the MySQL command line:

```bash
mysql -u root -p
```

Create the database:

```sql
CREATE DATABASE platforme_formation
CHARACTER SET utf8mb4
COLLATE utf8mb4_unicode_ci;
```

Select the database:

```sql
USE platforme_formation;
```

Create the required tables according to your application's database schema.

The main entities include:

* `users`
* `cours`
* `inscription`
* `progression`

The exact columns, primary keys, foreign keys, and relationships must match the SQL queries used by the application.

If the repository includes a database export, import it instead of manually recreating the tables.

For example:

```bash
mysql -u root -p platforme_formation < database.sql
```

Replace `database.sql` with the actual path to your SQL file.

### 3. Configure the Database Connection

Open:

```text
backend/config/database.php
```

Configure the PDO connection using your local database credentials.

Example:

```php
<?php

$host = "localhost";
$dbname = "platforme_formation";
$username = "your_database_user";
$password = "your_database_password";

try {
    $pdo = new PDO(
        "mysql:host=$host;dbname=$dbname;charset=utf8mb4",
        $username,
        $password
    );

    $pdo->setAttribute(
        PDO::ATTR_ERRMODE,
        PDO::ERRMODE_EXCEPTION
    );

    $pdo->setAttribute(
        PDO::ATTR_DEFAULT_FETCH_MODE,
        PDO::FETCH_ASSOC
    );

} catch (PDOException $e) {
    error_log($e->getMessage());
    exit("Database connection failed.");
}
```

Replace the example credentials with your own local configuration.

**Security note:** Never commit real database passwords, API keys, or other secrets to a public repository.

### 4. Verify PHP Extensions

Make sure the PDO MySQL extension is enabled.

On Ubuntu, you can install the relevant package with:

```bash
sudo apt update
sudo apt install php php-mysql
```

If you use Apache, you can also install:

```bash
sudo apt install apache2 libapache2-mod-php
```

Restart Apache after installing or changing its configuration:

```bash
sudo systemctl restart apache2
```

### 5. Run the Application

For local development, navigate to the directory containing the PHP entry point and start the PHP development server.

If `index.php` is located inside `frontend/`, run:

```bash
php -S localhost:8000 -t frontend
```

Then open the following address in your browser:

http://localhost:8000/

The application must have a working database connection and the required database tables before database-dependent features can operate correctly.

## User Roles

LearnHub uses a role-based approach to distinguish users.

| Role      | Intended responsibility                                                        |
| --------- | ------------------------------------------------------------------------------ |
| `STUDENT` | Access learning content and student features                                   |
| `TEACHER` | Manage or contribute to learning content, depending on implemented permissions |
| `ADMIN`   | Manage users, courses, and administrative operations                           |

The available actions depend on the permissions implemented in the backend.

## Application Workflow

### User Registration

1. The user opens the registration page.
2. The user enters a name, email address, and password.
3. The application validates the submitted information.
4. The backend creates the account if validation succeeds.

### User Login

1. The user submits their email address and password.
2. The backend verifies the credentials.
3. The application initializes the authenticated session.
4. The user is redirected according to their role.

### Course Creation

1. An authorized administrator opens the dashboard.
2. The administrator enters the course title.
3. The administrator provides the module title and order.
4. The administrator enters a lesson title.
5. The backend stores the corresponding learning content.

### User Administration

1. The administrator searches for a user.
2. The application displays matching user information.
3. The administrator can initiate account deletion when necessary.

## Security

Security is an important part of a web application that manages user accounts.

The project should follow these practices:

* Store passwords using PHP's `password_hash()` function.
* Verify passwords using `password_verify()`.
* Use PDO prepared statements for database queries.
* Escape user-generated content before displaying it in HTML.
* Protect restricted pages with server-side authentication and authorization checks.
* Start and configure sessions securely.
* Validate all input on the server, even when HTML validation is used.
* Use POST requests for operations that modify data.
* Add CSRF protection for sensitive operations.
* Prevent unauthorized users from deleting accounts or modifying courses.
* Keep database credentials outside version control.

Client-side confirmation dialogs improve usability but do not replace backend security checks.

## Future Improvements

Possible improvements for future versions include:

* Student dashboard.
* Teacher dashboard.
* Course enrollment and registration.
* Lesson progress tracking.
* Course search and filtering.
* Improved form validation and error messages.
* Password reset functionality.
* Course editing and deletion.
* Responsive interface improvements.
* Course images and descriptions.
* Automated tests.
* Deployment to a production web server.

These are potential extensions and should not be considered implemented unless they are available in the current codebase.

## Contributors

Developed as an academic web development project.

Add the names and GitHub profiles of the project contributors here.

## License

No license has been specified yet.

If you intend to make this project available for reuse, choose an appropriate license and add a `LICENSE` file to the repository.

```
```
