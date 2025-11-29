<?php
session_start();
include 'config.php';
date_default_timezone_set('Asia/Bangkok');

if (!isset($_SESSION['user_id'])) {
    echo "NO_LOGIN";
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $user_id = $_SESSION['user_id'];
    $category = $_POST['category'] ?? '';
    $title = $_POST['title'] ?? '';
    $desc = $_POST['description'] ?? '';
    $due_date = $_POST['due_date'] ?? '';
    $due_time = $_POST['due_time'] ?? '';
    $remark = $_POST['remark'] ?? '';
    $notify = isset($_POST['notify']) ? 1 : 0;

    $sql = "INSERT INTO todos (user_id, category,title , description, due_date, due_time, remark,notify)
                        VALUES ('$user_id', '$title', '$category', '$desc', '$due_date', '$due_time', '$remark','$notify')";
    

    if ($conn->query($sql)) {
        echo "OK";
    } else {
        echo "SQL_ERROR: " . $conn->error . " | SQL=" . $sql;
    }
}
