<?php
$host = "db";       // ชื่อ service ของ MySQL ใน docker-compose
$user = "root";
$pass = "root123";
$dbname = "todo_app";

$conn = new mysqli($host, $user, $pass, $dbname);

if ($conn->connect_error) {
    die("Database connection failed: " . $conn->connect_error);
}
?>
