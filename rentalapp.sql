CREATE DATABASE IF NOT EXISTS rentalapp;
USE rentalapp;

CREATE TABLE IF NOT EXISTS customers (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100),
    address VARCHAR(255),
    email VARCHAR(100) UNIQUE,
    phone VARCHAR(20)
);

CREATE TABLE IF NOT EXISTS cars (
    id INT AUTO_INCREMENT PRIMARY KEY,
    brand VARCHAR(50),
    model VARCHAR(50),
    plate_number VARCHAR(20) UNIQUE,
    rate DECIMAL(10,2),
    is_available BOOLEAN DEFAULT 1
);

CREATE TABLE IF NOT EXISTS rentals (
    id INT AUTO_INCREMENT PRIMARY KEY,
    customer_id INT,
    car_id INT,
    date_borrowed DATE,
    expected_return_date DATE,
    actual_return_date DATE,
    total_cost DECIMAL(10,2),
    status ENUM('active', 'returned', 'overdue'),
    FOREIGN KEY (customer_id) REFERENCES customers(id),
    FOREIGN KEY (car_id) REFERENCES cars(id)
); 