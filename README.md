# Personal Website with Contact Management
A simple personal website with a contact form that stores submissions in a MySQL database. Users can submit their name and age, and the website displays all submissions with the ability to activate/deactivate each contact.

## project-folder/
├── index.html          # Main website page
├── db_config.php       # Database connection configuration
├── get_contacts.php    # Fetches contacts from database (JSON API)
├── submit_contact.php  # Handles form submissions
├── toggle_status.php   # Updates contact status (JSON API)
└── simple_test.php     # Basic PHP test file

## Setup Instructions
### 1. Database Setup
Create a MySQL database and table in localhost  phpMyAdmin:
sql-- Create database
CREATE DATABASE info;

-- Use the database
USE info;

-- Create contacts table
CREATE TABLE contacts (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    age INT NOT NULL,
    status TINYINT(1) DEFAULT 0,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

### 2. Database Configuration
Edit db_config.php to match your database settings:
php$servername = "localhost";    # Your MySQL server
$username = "root";           # Your MySQL username
$password = "";               # Your MySQL password
$database = 'info';           # Your database name

### 3. Web Server Setup
Using XAMPP:
Download and install XAMPP
Start Apache and MySQL services
Copy all project files to htdocs folder
Access via http://localhost/your-project-folder/

### 4. Testing

Open http://localhost/your-project-folder/simple_test.php
You should see "Hello from PHP!" if PHP is working
Open http://localhost/your-project-folder/ to view the main website
