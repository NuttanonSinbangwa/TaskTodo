<?php
include "config.php";

$id = $_GET['id'];
$sql = $conn->query("SELECT * FROM todos WHERE id=$id");
$data = $sql->fetch_assoc();

echo json_encode($data);
?>
