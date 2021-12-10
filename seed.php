<?php
use App\Config\Config;

require_once realpath("vendor/autoload.php");

$servername = Config::$host;
$username = Config::$user;
$password = Config::$password;
$dbname = Config::$database;

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// sql to create table
$sql = "INSERT INTO todo (id, task_name, task_status) VALUES
        (1, 'Learn SQL', 2),
        (2, 'Learn OOP', 2),
        (3, 'Learn Principle', 1),
        (4, 'Apply SOLID', 1),
        (5, 'Build something', 1)";

if ($conn->query($sql) === TRUE) {
    echo "Database seed done successfully";
} else {
    echo "Error creating table: " . $conn->error;
}

$conn->close();

