<?php
// Database credentials
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "bus-ticketing";

// Connect to MySQL server
$conn = new mysqli("localhost", "root", "", "bus-ticketing"); 

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Create database if it doesn't exist
$sql = "CREATE DATABASE IF NOT EXISTS `$dbname`";
$conn->query($sql);

// Select the database
$conn->select_db($dbname);

// Create users table if it doesn't exist
$table_sql = "CREATE TABLE IF NOT EXISTS `users` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `name` varchar(100) NOT NULL,
    `email` varchar(100) NOT NULL,
    `password` varchar(255) NOT NULL,
    `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (`id`),
    UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4";

$conn->query($table_sql);
?>
