<?php
session_start();
include 'config.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$user_id = $_SESSION['user_id'];

$sql = "SELECT username, line_user_id FROM users WHERE id = $user_id";
$res = $conn->query($sql);
$user = $res->fetch_assoc();

$line_connected = !empty($user['line_user_id']);
?>
<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <style>
        html,body{
            margin:0;
            padding:0;
            overflow-x:hidden;
            font-family:"Sarabun", sans-serif;
        }
    </style>
</head>

<body>

    <?php require 'navbar.php'; ?>

    <div style="padding:20px;">
        <h2>สวัสดี <?= htmlspecialchars($user['username']) ?></h2>

        <p><a href="todos.php">ไปหน้ารายการ To-Do</a></p>

        <?php if ($line_connected): ?>
            <button disabled 
                style="background:#d6ffd6; padding:10px 15px; border:1px solid #2a8a2a; cursor:not-allowed;">
                ✓ เชื่อมต่อ LINE แล้ว
            </button>
        <?php else: ?>
            <a href="liff_connect.php">
                <button style="background:#4CAF50; color:white; padding:10px 15px; border:none; cursor:pointer;">
                    🔗 เชื่อมต่อกับ LINE
                </button>
            </a>
        <?php endif; ?>

        <br><br>
        <a href="logout.php">Logout</a>
    </div>

</body>
</html>
