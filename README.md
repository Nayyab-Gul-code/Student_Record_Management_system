# Student Record Management System (SRMS)

A simple and user-friendly **Student Record Management System** developed using PHP and MySQL. This project helps educational institutes manage student information digitally through basic CRUD (Create, Read, Update, Delete) operations.

## Project Overview

The Student Record Management System is designed to replace manual student record-keeping with a simple digital solution. It allows administrative staff to efficiently manage student information, reduce paperwork, and organize records in a MySQL database.

## Objectives

- Reduce manual paperwork and record-keeping errors.
- Store student information in a structured database.
- Make student records easy to access and manage.
- Provide a simple and readable user interface.
- Perform CRUD operations efficiently.

## Technologies Used

| Technology | Purpose |
|---|---|
| PHP | Server-side scripting and CRUD operations |
| MySQL | Database management |
| HTML | Structure of web pages |
| CSS | Styling and interface design |
| JavaScript | Delete confirmation dialog |
| XAMPP | Local development server |
| phpMyAdmin | Database management |

## Features

- **Add Student:** Insert new student records into the database.
- **View Students:** Display all registered students in a table.
- **Edit Student:** Update existing student information.
- **Delete Student:** Remove student records from the database.
- **Input Validation:** Check required fields and email format.
- **Department Selection:** Select a department using a dropdown menu.
- **Success and Error Messages:** Display operation feedback.
- **Delete Confirmation:** Prevent accidental record deletion.
- **User-Friendly Interface:** Simple and readable design.

## Project Structure

```text
Student-Record-Management-System/
│
├── database.sql
├── config.php
├── index.php
├── add_student.php
├── edit_student.php
└── README.md
```

## Database Structure

**Database Name:** `student_db`

**Table Name:** `students`

| Column | Data Type | Description |
|---|---|---|
| id | INT | Primary Key (Auto Increment) |
| name | VARCHAR(100) | Student Name |
| email | VARCHAR(100) | Student Email (Unique) |
| department | VARCHAR(100) | Student Department |
| created_at | TIMESTAMP | Record Creation Date |

## Installation and Setup

Follow these steps to run the project locally.

### 1. Install XAMPP

Download and install XAMPP from:

https://www.apachefriends.org/

Start the following services:
- Apache
- MySQL

### 2. Clone the Repository

Open your terminal and execute:

```bash
git clone https://github.com/Nayyab-Gul-code/Student_Record_Management_system.git
```

### 3. Move Project to XAMPP

Copy the project folder into:

```text
C:\xampp\htdocs\
```

Your project path should be:

```text
C:\xampp\htdocs\Student-Record-Management-System\
```

### 4. Create the Database

1. Open phpMyAdmin:
   http://localhost/phpmyadmin
2. Click on the SQL tab.
3. Open the `database.sql` file.
4. Copy and paste its SQL commands.
5. Click Go to create the database and table.

### 5. Configure Database Connection

Open `config.php` and verify your database credentials:

```php
<?php
$host = "localhost";
$user = "root";
$password = "";
$database = "student_db";

$conn = mysqli_connect($host, $user, $password, $database);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>
```

### 6. Run the Project

Open your browser and visit:

```text
http://localhost/Student-Record-Management-System/index.php
```

The Student Record Management System should now be running.

## How to Use

1. Open the main page to view all student records.
2. Click **Add New Student** to register a student.
3. Enter the student's name, email, and department.
4. Click **Edit** to update an existing record.
5. Click **Delete** to remove a student record after confirmation.

## CRUD Operations

| Operation | Description | PHP File |
|---|---|---|
| Create | Add new student records | add_student.php |
| Read | Display student records | index.php |
| Update | Modify existing records | edit_student.php |
| Delete | Remove student records | index.php |

## Future Improvements

- Admin login and authentication.
- Student search functionality.
- Pagination for large records.
- Student profile management.
- Export student records to PDF or Excel.

## Project Type

Academic / Learning Project

