<?php
include 'config.php';
session_start();

$id = $_POST['id'];
$val = $_POST['value'];

$sql = "UPDATE todos SET is_completed = $val WHERE id = $id AND user_id = ".$_SESSION['user_id'];
$conn->query($sql);

echo "OK";
?>
