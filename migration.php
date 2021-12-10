<?php
use App\Config\Config;

require_once realpath("vendor/autoload.php");

$servername = Config::$host;
$username = Config::$user;
$password = Config::$password;
$dbname = Config::$database;

// Create DB
$conn1 = new mysqli($servername, $username, $password);
// Check connection
if ($conn1->connect_error) {
  die("Connection failed: " . $conn1->connect_error);
}

// Create database
$sql = "CREATE DATABASE $dbname";
if ($conn1->query($sql) === TRUE) {
  echo "Database created successfully \n";
} else {
  echo "Error creating database: " . $conn1->error;
}

$conn1->close();



// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// sql to create table
$sql = "CREATE TABLE todo (
    id int(2) NOT NULL,
    task_name varchar(30) NOT NULL,
    task_status int(2) NOT NULL COMMENT 'active=1 , completed=2'
  ) ENGINE=InnoDB DEFAULT CHARSET=utf8";


$sql2 = "ALTER TABLE todo
ADD PRIMARY KEY (id)";

$sql3 = "ALTER TABLE todo MODIFY id int(11) NOT NULL AUTO_INCREMENT";

if ($conn->query($sql) === TRUE && $conn->query($sql2) === TRUE && $conn->query($sql3) === TRUE) {
    echo "Migration done successfully";
} else {
    echo "Error creating table: " . $conn->error;
}

$conn->close();

