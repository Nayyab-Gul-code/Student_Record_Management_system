-- ============================================
-- Student Record Management System
-- Database Setup Script
-- ============================================

-- Step 1: Create the database
CREATE DATABASE IF NOT EXISTS student_db;

-- Step 2: Select the database
USE student_db;

-- Step 3: Create the students table
CREATE TABLE IF NOT EXISTS students (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    department VARCHAR(100) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Step 4: Insert sample data (optional)
INSERT INTO students (name, email, department) VALUES
('Ali Hassan', 'ali.hassan@example.com', 'Computer Science'),
('Sara Khan', 'sara.khan@example.com', 'Software Engineering'),
('Ahmed Raza', 'ahmed.raza@example.com', 'Information Technology');
