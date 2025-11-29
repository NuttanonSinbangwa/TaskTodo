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

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="css/style.css">
    </head>

</head>

<body>

    <?php require 'navbar.php'; ?>

    <div class="home-container">

        <h1 class="title">Home</h1>
        <p class="subtitle">เลือกฟอร์มเพื่อตรวจข้อมูล แล้วรับการแจ้งเตือนผ่าน LINE</p>

        <div class="line-card">

            <h2 class="line-title">เชื่อมต่อ LINE</h2>
            <p class="line-desc">
                เชื่อมบัญชี LINE Bot เพื่อให้ระบบส่งการแจ้งเตือนอัตโนมัติจากทุกฟอร์มที่คุณเลือก
            </p>

            <div class="line-actions">
                <a href="https://line.me/R/ti/p/@YOUR_BOT_ID" class="btn-outline">
                    เพิ่มเพื่อน LINE Bot
                </a>

                <?php if ($line_connected): ?>
                    <button class="btn-disabled" disabled>✓ เชื่อมต่อแล้ว</button>
                <?php else: ?>
                    <a href="liff_connect.php" class="btn-liff">
                        Login with LINE (LIFF)
                    </a>
                <?php endif; ?>
            </div>

            <p class="line-status">
                สถานะ:
                <?php if ($line_connected): ?>
                    <span class="status-ok">เชื่อมต่อแล้ว</span>
                <?php else: ?>
                    <span class="status-no">ยังไม่ได้เชื่อม</span>
                <?php endif; ?>
            </p>

        </div>

        <h2 class="form-section-title">รายการฟอร์มแจ้งเตือน</h2>

        <div class="form-grid">

            <!-- 1 -->
            <div class="form-card">
                <h3>นัดหมายแพทย์</h3>
                <p class="small">ตรวจสุขภาพ / นัดหมายแพทย์</p>
                <div class="form-card-footer">
                    <span>รายการ: 0</span>
                    <a href="form_medical.php" class="form-btn">เปิดแบบฟอร์ม</a>
                </div>
            </div>

            <!-- 2 -->
            <div class="form-card">
                <h3>กินยา</h3>
                <p class="small">แจ้งเตือนการรับประทานยา / ตั้งเวลา</p>
                <div class="form-card-footer">
                    <span>รายการ: 0</span>
                    <a href="form_medicine.php" class="form-btn">เปิดแบบฟอร์ม</a>
                </div>
            </div>

            <!-- 3 -->
            <div class="form-card">
                <h3>งาน</h3>
                <p class="small">รายการงาน / สิ่งที่ต้องดำเนินการ</p>
                <div class="form-card-footer">
                    <span>รายการ: 0</span>
                    <a href="form_work.php" class="form-btn">เปิดแบบฟอร์ม</a>
                </div>
            </div>

            <!-- 4 -->
            <div class="form-card">
                <h3>สินค้าใกล้หมดอายุ</h3>
                <p class="small">แจ้งเตือนวันหมดอายุ / ตรวจสอบสินค้า</p>
                <div class="form-card-footer">
                    <span>รายการ: 0</span>
                    <a href="form_expire.php" class="form-btn">เปิดแบบฟอร์ม</a>
                </div>
            </div>

            <!-- 5 -->
            <div class="form-card">
                <h3>บิล / ค่าจ่าย</h3>
                <p class="small">บิลรายเดือน / ค่าใช้จ่ายที่ต้องจ่าย</p>
                <div class="form-card-footer">
                    <span>รายการ: 0</span>
                    <a href="form_bill.php" class="form-btn">เปิดแบบฟอร์ม</a>
                </div>
            </div>

            <!-- 6 -->
            <div class="form-card">
                <h3>ทริป & เที่ยว</h3>
                <p class="small">แผนการเดินทาง / กิจกรรมท่องเที่ยว</p>
                <div class="form-card-footer">
                    <span>รายการ: 0</span>
                    <a href="form_trip.php" class="form-btn">เปิดแบบฟอร์ม</a>
                </div>
            </div>

            <!-- 7 -->
            <div class="form-card">
                <h3>กิจวัตรประจำวัน</h3>
                <p class="small">รายการกิจวัตรและสิ่งที่ต้องปฏิบัติประจำวัน</p>
                <div class="form-card-footer">
                    <span>รายการ: 0</span>
                    <a href="form_daily.php" class="form-btn">เปิดแบบฟอร์ม</a>
                </div>
            </div>

            <!-- 8 -->
            <div class="form-card">
                <h3>นัดหมายภายนอก</h3>
                <p class="small">นัดหมาย / ธุระสำคัญ</p>
                <div class="form-card-footer">
                    <span>รายการ: 0</span>
                    <a href="form_external.php" class="form-btn">เปิดแบบฟอร์ม</a>
                </div>
            </div>

        </div>


    </div>


</body>

</html>