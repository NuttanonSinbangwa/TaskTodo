<?php
include 'config.php';

$success = false;
$message = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $username = $_POST['username'];
    $password_raw = $_POST['password'];
    $password_confirm = $_POST['confirm_password'];

    // 1) ตรวจสอบว่ารหัสผ่านทั้งสองตรงกันไหม
    if ($password_raw !== $password_confirm) {
        $message = "รหัสผ่านทั้งสองช่องไม่ตรงกัน!";
    } else {

        $password = password_hash($password_raw, PASSWORD_DEFAULT);

        // 2) ตรวจซ้ำ username
        $check = $conn->query("SELECT * FROM users WHERE username = '$username'");

        if ($check->num_rows > 0) {
            $message = "มีชื่อผู้ใช้นี้อยู่แล้ว!";
        } else {
            // 3) สมัครสมาชิก
            $sql = "INSERT INTO users (username, password) VALUES ('$username', '$password')";
            if ($conn->query($sql)) {
                $success = true;
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="th">

<head>
    <meta charset="UTF-8">
    <title>Register</title>
    <link rel="stylesheet" href="css/auth.css">
</head>

<body>

<?php if ($success): ?>

    <div class="success-box">
        <h2>สมัครสมาชิกสำเร็จ!</h2>
        <p>บัญชีของคุณถูกสร้างแล้ว 🎉</p>
        <a href="login.php" class="btn btn-green">ไปหน้า Login</a>
    </div>

<?php else: ?>

    <div class="card">
        <h2>Register</h2>

        <?php if ($message): ?>
            <div class="error"><?= $message ?></div>
        <?php endif; ?>

        <form method="POST">
            
            <label>Username</label>
            <input type="text" name="username" required>

            <label>Password</label>
            <input type="password" name="password" required>

            <label>Confirm Password</label>
            <input type="password" name="confirm_password" required>

            <div class="btn-row">
                <button type="submit" class="btn">Register</button>
                <a href="login.php" class="btn">Back To Login</a>
            </div>

        </form>
    </div>

<?php endif; ?>

</body>
</html>
