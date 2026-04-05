<?php
$conn = new mysqli("localhost", "root", "", "bus-ticketing");
if ($conn->connect_error) die("Connection failed: " . $conn->connect_error);

// Create users table
$conn->query("CREATE TABLE IF NOT EXISTS `users` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `name` varchar(100) NOT NULL,
    `email` varchar(100) NOT NULL,
    `password` varchar(255) NOT NULL,
    `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (`id`),
    UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4");

// Create buses table
$conn->query("CREATE TABLE IF NOT EXISTS `buses` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `name` varchar(100) NOT NULL,
    `from_city` varchar(100) NOT NULL,
    `to_city` varchar(100) NOT NULL,
    `departure` varchar(10) NOT NULL,
    `arrival` varchar(10) NOT NULL,
    `seats` int(11) NOT NULL DEFAULT 40,
    `price` int(11) NOT NULL,
    `type` enum('AC','Non-AC') NOT NULL DEFAULT 'AC',
    PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4");

// Create bookings table
$conn->query("CREATE TABLE IF NOT EXISTS `bookings` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `user_id` int(11) NOT NULL,
    `bus_id` int(11) NOT NULL,
    `travel_date` date NOT NULL,
    `seats_booked` int(11) NOT NULL DEFAULT 1,
    `total_price` int(11) NOT NULL,
    `status` enum('Confirmed','Cancelled') NOT NULL DEFAULT 'Confirmed',
    `booked_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4");

// Seed buses if empty
$result = $conn->query("SELECT COUNT(*) as total FROM buses");
if ($result->fetch_assoc()['total'] == 0) {
    $conn->query("INSERT INTO buses (name, from_city, to_city, departure, arrival, seats, price, type) VALUES
        ('Himalayan Express', 'Kathmandu', 'Pokhara',    '06:00 AM', '12:00 PM', 40, 800,  'AC'),
        ('Mountain Star',     'Kathmandu', 'Pokhara',    '08:30 AM', '02:30 PM', 40, 700,  'Non-AC'),
        ('Everest Deluxe',    'Kathmandu', 'Biratnagar', '05:00 PM', '05:00 AM', 35, 1500, 'AC'),
        ('Eastern Travel',    'Kathmandu', 'Ilam',       '04:00 PM', '06:00 AM', 32, 1400, 'Non-AC'),
        ('Lumbini Night Bus', 'Kathmandu', 'Butwal',     '07:00 PM', '05:00 AM', 38, 1100, 'AC'),
        ('Safari Tourist',    'Kathmandu', 'Chitwan',    '09:00 AM', '02:00 PM', 30, 900,  'AC')
    ");
}
?>