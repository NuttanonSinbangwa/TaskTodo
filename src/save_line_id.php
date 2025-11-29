<?php
session_start();
include "config.php";

$data = json_decode(file_get_contents("php://input"), true);

$line_user_id = $data["userId"];
$user_id = $_SESSION['user_id'];

$sql = "UPDATE users SET line_user_id='$line_user_id' WHERE id=$user_id";
$conn->query($sql);

echo json_encode(["status" => "ok"]);
?>
