<?php
session_start();

// Database configuration
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'portfolio_db');

// Site configuration
define('SITE_NAME', 'My Portfolio');
define('SITE_URL', 'http://localhost/portfolio-system/');

// Create connection
$conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Set charset
$conn->set_charset("utf8mb4");

// Error reporting for development (disable in production)
error_reporting(E_ALL);
ini_set('display_errors', 1);
?>