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
    <title>Form Collection</title>

    <link rel="stylesheet" href="../css/home.css">
    <script src="../script/home.js" defer></script>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Athiti:wght@200;300;400;500;600;700&family=Bai+Jamjuree:ital,wght@0,200;0,300;0,400;0,500;0,600;0,700;1,200;1,300;1,400;1,500;1,600;1,700&family=IBM+Plex+Sans+Thai:wght@100;200;300;400;500;600;700&family=Mitr:wght@200;300;400;500;600;700&family=Montserrat:ital,wght@0,100..900;1,100..900&family=Raleway:ital@0;1&family=Sarabun:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800&display=swap"
        rel="stylesheet">


</head>

<body>

    <?php include 'navbar2.php'; ?>

    <h1>C O N N E C T&nbsp;&nbsp;&nbsp;L I N E</h1>
    <p class="subtitle">เพิ่มความสะดวกให้ทุกวัน
        รับแจ้งเตือนทุกอย่างผ่าน LINE อัตโนมัติ
        คลิก “CONNECT LINE” และเพิ่มบอทเพื่อเริ่มใช้งาน</p>
    <p class="status">
        สถานะ:
        <span id="lineStatus" class="<?php echo $line_connected ? 'greennobg' : 'red'; ?>">
            <?php echo $line_connected ? 'LINE Connected' : 'LINE Not Connected'; ?>
        </span>
    </p>


    <div class="btn-area">

        <!-- ปุ่มเพิ่มเพื่อน LINE Bot -->
        <a href="https://line.me/R/ti/p/@600wseum" class="btn green" target="_blank" rel="noopener">
            ADD LINE BOT
        </a>


        <!-- ปุ่มสถานะเชื่อมต่อ -->
        <?php if ($line_connected): ?>
            <button class="btn white" disabled>
                ✓ Connected
            </button>
        <?php else: ?>
            <a href="liff_connect.php" class="btn white">
                CONNECT LINE
            </a>
        <?php endif; ?>

    </div>



    






</body>

</html>