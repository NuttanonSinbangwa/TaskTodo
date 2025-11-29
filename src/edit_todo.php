<?php
session_start();
include 'config.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$id = $_GET['id'];

$sql = "SELECT * FROM todos WHERE id = $id AND user_id = ".$_SESSION['user_id'];
$result = $conn->query($sql);
$todo = $result->fetch_assoc();

if (!$todo) {
    die("ไม่พบรายการนี้");
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'];
    $desc = $_POST['description'];
    $due = $_POST['due_date'];
    $completed = isset($_POST['is_completed']) ? 1 : 0;

    $sql = "UPDATE todos
            SET title='$title', description='$desc', due_date='$due', is_completed=$completed
            WHERE id=$id";

    if ($conn->query($sql)) {
        header("Location: todos.php");
        exit;
    }
}
?>

<h2>แก้ไขงาน</h2>

<form method="POST">
    ชื่องาน:<br>
    <input type="text" name="title" value="<?= $todo['title'] ?>" required><br><br>

    รายละเอียด:<br>
    <textarea name="description"><?= $todo['description'] ?></textarea><br><br>

    กำหนดเวลา:<br>
    <input type="datetime-local" name="due_date" value="<?= str_replace(' ', 'T', $todo['due_date']) ?>"><br><br>

    ทำสำเร็จหรือยัง?
    <input type="checkbox" name="is_completed" <?= $todo['is_completed'] ? 'checked' : '' ?>><br><br>

    <button type="submit">บันทึก</button>
</form>

<a href="todos.php">กลับ</a>
