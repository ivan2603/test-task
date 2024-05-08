<?php
define('CLI', dirname(__DIR__));
$paramsPath = CLI.'/./config/db_params.php';
$params = include ($paramsPath);

$conn = new mysqli($params['host'], $params['user'], $params['password']);
if ($conn->connect_error) {
    die("Помилка підключення до бази даних: " . $conn->connect_error);
}

$sqlCreateDatabase = "CREATE DATABASE IF NOT EXISTS " . $params['dbname'];

if ($conn->query($sqlCreateDatabase) === TRUE) {
    echo "Database successfully created or already exists";
} else {
    echo "Error creating database: " . $conn->error;
}

$conn->select_db($params['dbname']);


$sqlCreateTableUsers = "CREATE TABLE IF NOT EXISTS users (
        id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        login VARCHAR(30) DEFAULT NULL,
        firstname VARCHAR(30) DEFAULT NULL,
        lastname VARCHAR(30) DEFAULT NULL,
        email VARCHAR(100) UNIQUE DEFAULT NULL,
        password VARCHAR(225) DEFAULT NULL,
        role SMALLINT DEFAULT NULL 
    )";

$sqlCreateTableVehicles = "CREATE TABLE IF NOT EXISTS vehicles (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    vehicle_type VARCHAR(255),
    INDEX id_index (id)
)";

if ($conn->query($sqlCreateTableUsers) === true) {
    echo " Table 'users' was successfully created or already exists";
} else {
    echo "Error creating table: " . $conn->error;
}
if ($conn->query($sqlCreateTableVehicles) === true) {
    echo " Table 'vehicles' was successfully created or already exists";
} else {
    echo "Error creating table: " . $conn->error;
}
$conn->close();
