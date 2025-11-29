<?php
session_start();
include 'config.php';

$message = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE username='$username'";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        $user = $result->fetch_assoc();

        if (password_verify($password, $user['password'])) {

            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];

            header("Location: home2.php");
            exit;
        } else {
            $message = "รหัสผ่านผิด!";
        }
    } else {
        $message = "ไม่พบชื่อผู้ใช้นี้!";
    }
}
?>
<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="css/auth.css">

</head>
<body>

<div class="card">

    <h2>Login</h2>

    <?php if ($message): ?>
        <div class="error"><?= $message ?></div>
    <?php endif; ?>

    <form method="POST">

        <label>Username</label>
        <input type="text" name="username" required>

        <label>Password</label>
        <input type="password" name="password" required>

        <button type="submit" class="btn">Login</button>

        <div class="btn-row">
            <a href="register.php" class="btn-outline">Register</a>
        </div>

    </form>

</div>

</body>
</html>
