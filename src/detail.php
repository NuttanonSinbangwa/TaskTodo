<?php
session_start();
include 'config.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$id = $_GET['id'] ?? 0;
$user_id = $_SESSION['user_id'];

$sql = "SELECT * FROM todos WHERE id=$id AND user_id=$user_id LIMIT 1";
$res = $conn->query($sql);
$data = $res->fetch_assoc();

if (!$data) {
    echo "ไม่พบข้อมูล";
    exit;
}
?>

<!DOCTYPE html>
<html lang="th">

<head>
    <meta charset="UTF-8">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Athiti:wght@200;300;400;500;600;700&family=Bai+Jamjuree:ital,wght@0,200;0,300;0,400;0,500;0,600;0,700;1,200;1,300;1,400;1,500;1,600;1,700&family=IBM+Plex+Sans+Thai:wght@100;200;300;400;500;600;700&family=Mitr:wght@200;300;400;500;600;700&family=Montserrat:ital,wght@0,100..900;1,100..900&family=Raleway:ital@0;1&family=Sarabun:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800&display=swap"
        rel="stylesheet">

    <title>รายละเอียดงาน</title>
        <link rel="stylesheet" href="../css/home.css">

    <link rel="stylesheet" href="../css/detail.css">

</head>

<body>

    <?php include 'navbar2.php'; ?>

    <div class="detail-wrapper">

        <div class="detail-title">รายละเอียดงาน</div>
        <div class="detail-line"></div>

        <div class="detail-item">
            <strong>หมวด:</strong> <?= htmlspecialchars($data['category']) ?>
        </div>

        <div class="detail-item">
            <strong>ประเภท:</strong> <?= htmlspecialchars($data['title']) ?>
        </div>

        <div class="detail-item">
            <strong>รายละเอียด:</strong>
            <?= nl2br(htmlspecialchars($data['description'])) ?>
        </div>

        <div class="detail-item">
            <strong>หมายเหตุ:</strong>
            <?= nl2br(htmlspecialchars($data['remark'])) ?>
        </div>

        <div class="detail-item">
            <strong>วันแจ้งเตือน:</strong> <?= htmlspecialchars($data['due_date']) ?>
        </div>

        <div class="detail-item">
            <strong>เวลา:</strong> <?= htmlspecialchars($data['due_time']) ?>
        </div>

        <div class="detail-item">
            <strong>แจ้งเตือน:</strong>
            <?php if ($data['notify'] == '0'): ?>
                <span class="badge-approved">Approved</span>
            <?php else: ?>
                <span class="badge-pending">Pending</span>
            <?php endif; ?>
        </div>

        <a href="form.php" class="back-btn">← กลับ</a>

    </div>


</body>

</html>