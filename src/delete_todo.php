<?php
session_start();
include 'config.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$id = $_GET['id'];

$sql = "DELETE FROM todos WHERE id = $id AND user_id = ".$_SESSION['user_id'];

$conn->query($sql);

header("Location: todos.php");
exit;
