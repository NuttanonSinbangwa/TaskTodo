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

    <div id="popup" class="popup">
        <div class="popup-box">
            <span class="close" onclick="closePopup()">×</span>
            <h2 id="popupTitle"></h2>
            <div id="popupContent"></div>
        </div>
    </div>

    <div class="card-container">

        <!-- หมวดสุขภาพ -->
        <div class="card">
            <img src="../img/doctor.jpg">
            <h3>หมวดสุขภาพแพทย์</h3>

            <select id="med">
                <option value="">เลือก Category</option>
                <option value="นัดพบแพทย์">นัดพบแพทย์</option>
                <option value="ตรวจฟัน">ตรวจฟัน</option>
                <option value="ตรวจสายตา">ตรวจสายตา</option>
                <option value="ตรวจสุขภาพประจำปี">ตรวจสุขภาพประจำปี</option>
                <option value="ฉีดวัคซีน">ฉีดวัคซีน</option>
                <option value="รับผลตรวจ">รับผลตรวจ</option>
                <option value="นัดกายภาพ">นัดกายภาพ</option>
                <option value="นัดทำแผล">นัดทำแผล</option>
                <option value="เจาะเลือด">เจาะเลือด</option>
                <option value="ซื้อยา">ซื้อยา</option>
            </select>

            <button class="open-btn" onclick="openForm('med', 'หมวดสุขภาพแพทย์')">OPEN</button>
        </div>

        <!-- หมวดชีวิต -->
        <div class="card">
            <img src="../img/routine.jpg">
            <h3>หมวดชีวิตประจำวัน</h3>

            <select id="life">
                <option value="">เลือก Category</option>
                <option value="เตรียมอาหาร">เตรียมอาหาร</option>
                <option value="ซื้อของเข้าบ้าน">ซื้อของเข้าบ้าน</option>
                <option value="เช็คของหมด">เช็คของหมด</option>
                <option value="ล้างจาน">ล้างจาน / ทำความสะอาดจาน</option>
                <option value="ทิ้งขยะ">ทิ้งขยะ</option>
                <option value="ซักผ้า">ซักผ้า</option>
                <option value="ตากผ้า">ตากผ้า</option>
                <option value="เก็บผ้า">เก็บผ้า</option>
                <option value="รีดผ้า">รีดผ้า</option>
                <option value="ดูแลต้นไม้">ดูแลต้นไม้</option>
                <option value="ทำธุระ">ออกไปทำธุระ</option>
                <option value="ชีวิตประจำวันอื่นๆ">อื่น ๆ ในชีวิตประจำวัน</option>



            </select>
            <button class="open-btn" onclick="openForm('life', 'หมวดชีวิตประจำวัน')">OPEN</button>
        </div>

        <!-- หมวดสัตว์ -->
        <div class="card">
            <img src="../img/pet.jpg">
            <h3>หมวดสัตว์เลี้ยง</h3>

            <select id="pet">
                <option value="">เลือก Category</option>
                <option value="วัคซีนสัตว์">วัคซีนสัตว์</option>
                <option value="อาบน้ำสัตว์">อาบน้ำสัตว์</option>
                <option value="ตัดขนสัตว์">ตัดขนสัตว์</option>
                <option value="ตรวจสุขภาพสัตว์">ตรวจสุขภาพสัตว์</option>
                <option value="ซื้ออาหารสัตว์">ซื้ออาหารสัตว์</option>
                <option value="ทำความสะอาดกรง">ทำความสะอาดกรง</option>
                <option value="พาเดิน">พาเดิน</option>
                <option value="เปลี่ยนทราย">เปลี่ยนทราย</option>
                <option value="ให้ยาสัตว์">ให้ยาสัตว์</option>
                <option value="นัดหมอสัตว์">นัดหมอสัตว์</option>
            </select>

            <button class="open-btn" onclick="openForm('pet', 'หมวดสัตว์เลี้ยง')">OPEN</button>
        </div>

        <!-- หมวดงาน -->
        <div class="card">
            <img src="../img/work.jpg">
            <h3>หมวดงานและการเรียน</h3>

            <select id="work">
                <option value="">เลือก Category</option>
                <option value="ประชุม">ประชุม</option>
                <option value="รายงาน">รายงาน</option>
                <option value="ส่งงาน">ส่งงาน</option>
                <option value="เรียนออนไลน์">เรียนออนไลน์</option>
                <option value="ทำสไลด์">ทำสไลด์</option>
                <option value="แบบฝึกหัด">แบบฝึกหัด</option>
                <option value="Presentation">Presentation</option>
                <option value="นัดคุยอาจารย์">นัดคุยอาจารย์</option>
                <option value="เตรียมเอกสาร">เตรียมเอกสาร</option>
                <option value="ตารางเรียน">ตารางเรียน</option>
            </select>

            <button class="open-btn" onclick="openForm('work', 'หมวดงานและการเรียน')">OPEN</button>
        </div>

        <!-- บิล -->
        <div class="card">
            <img src="../img/bill.jpg">
            <h3>หมวดบิล</h3>

            <select id="bill">
                <option value="">เลือก Category</option>
                <option value="ค่าไฟฟ้า">ค่าไฟฟ้า</option>
                <option value="ค่าน้ำประปา">ค่าน้ำประปา</option>
                <option value="ค่าเน็ตบ้าน">ค่าเน็ตบ้าน</option>
                <option value="ค่าโทรศัพท์">ค่าโทรศัพท์</option>
                <option value="ค่าเช่าบ้าน">ค่าเช่าบ้าน</option>
                <option value="ค่าส่วนกลาง">ค่าส่วนกลาง</option>

            </select>

            <button class="open-btn" onclick="openForm('bill', 'หมวดบิล')">OPEN</button>
        </div>


    </div>



    <!-- POPUP -->
    <!-- POPUP -->
    <div id="popup" class="popup">
        <div class="popup-box">
            <span class="close" onclick="closePopup()">&times;</span>

            <h2 id="popupTitle">หัวข้อ</h2>

            <div id="popupContent"></div>
        </div>
    </div>






</body>

</html>