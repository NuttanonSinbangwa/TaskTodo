<?php
session_start();
include 'config.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$user_id = $_SESSION['user_id'];

// ดึงข้อมูลทั้งหมด
$sql = "SELECT * FROM todos WHERE user_id=$user_id ORDER BY due_date ASC, due_time ASC";
$result = $conn->query($sql);

$category_name = "หมวดสุขภาพและยา"; // เปลี่ยนตามหมวดจริงจากฐานข้อมูล
$date_today = date("d/m/Y");
?>

<!DOCTYPE html>
<html lang="th">

<head>
    <meta charset="UTF-8">
    <title>Form Collection</title>

    <link rel="stylesheet" href="../css/home.css">
    <link rel="stylesheet" href="../css/overview.css">
    <script src="../script/overview.js" defer></script>
    <script src="../script/edit.js" defer></script>


    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Athiti:wght@200;300;400;500;600;700&family=Bai+Jamjuree:ital,wght@0,200;0,300;0,400;0,500;0,600;0,700;1,200;1,300;1,400;1,500;1,600;1,700&family=IBM+Plex+Sans+Thai:wght@100;200;300;400;500;600;700&family=Mitr:wght@200;300;400;500;600;700&family=Montserrat:ital,wght@0,100..900;1,100..900&family=Raleway:ital@0;1&family=Sarabun:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800&display=swap"
        rel="stylesheet">


</head>

<body>

    <?php include 'navbar2.php'; ?>


    <div class="task-table">

        <!-- ⭐ วางส่วนนี้ตรงนี้ ⭐ -->
        <div class="table-top">

            <!-- Search + Filter -->
            <div class="filter-box">
                <input type="text" id="search" placeholder="ค้นหา..." onkeyup="filterTable()">

                <select id="filterStatus" onchange="filterTable()">
                    <option value="">สถานะทั้งหมด</option>
                    <option value="done">สำเร็จ</option>
                    <option value="wait">ยังไม่ทำ</option>
                </select>

                <select id="filterCat" onchange="filterTable()">
                    <option value="">หมวดทั้งหมด</option>
                    <option value="หมวดสุขภาพแพทย์">หมวดสุขภาพแพทย์</option>
                    <option value="หมวดชีวิตประจำวัน">หมวดชีวิตประจำวัน</option>
                    <option value="หมวดสัตว์เลี้ยง">หมวดสัตว์เลี้ยง</option>
                    <option value="หมวดงานและการเรียน">หมวดงานและการเรียน</option>
                    <option value="หมวดบิล">หมวดบิล</option>
                </select>

                <select id="sort" onchange="filterTable()">
                    <option value="date">เรียงตามวัน</option>
                    <option value="title">เรียงตามหมวด</option>
                    <option value="created_desc">สร้างล่าสุด</option>
                    <option value="created_asc">สร้างเก่าสุด</option>

                </select>
            </div>

        </div>

        <!-- ⭐ จบ table-top ⭐ -->



        <div class="table-header"></div>

        <table>
            <thead>
                <tr>
                    <th>หมวด</th>
                    <th>ประเภท</th>
                    <th>ราบละเอียด</th>
                    <th>วันแจ้งเตือน</th>
                    <th>เวลา</th>
                    <th>หมายเหตุ</th>
                    <th>แจ้งเตือน</th>
                </tr>
            </thead>

            <tbody>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <tr onclick="openDetailPopup(<?= $row['id'] ?>)" class="row-click todo-row"
                        data-title="<?= strtolower($row['title']) ?>"
                        data-status="<?= $row['notify'] == 0 ? 'done' : 'wait' ?>"
                        data-cat="<?= strtolower($row['title']) ?>"
                        data-created="<?= $row['created_at'] ?>">


                        <td>
                            <div class="task-title">
                                <span class="dot"></span>
                                <strong><?= htmlspecialchars(string: $row['title']) ?></strong>
                            </div>
                        </td>

                        <td><?= htmlspecialchars(string: $row['category']) ?></td>
                        <td><?= htmlspecialchars(string: $row['description']) ?></td>



                        <td><?= htmlspecialchars(string: $row['due_date']) ?></td>
                        <td><?= htmlspecialchars(string: $row['due_time']) ?></td>
                        <td><?= htmlspecialchars(string: $row['remark']) ?></td>

                        <td>
                            <?php if (htmlspecialchars(string: $row['notify']) == '0'): ?>
                                <span class="status approved">● Approved</span>
                            <?php else: ?>
                                <span class="status pending">● Pending</span>
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>

    </div>
    <!-- POPUP DETAIL -->
    <div id="detailPopup" class="popup" style="display:none;">
        <div class="popup-box" style="max-width:500px;">
            <span class="close" onclick="closeDetail()">×</span>

            <h2 style="text-align:center;">รายละเอียดงาน</h2>

            <div id="detailContent"></div>

            <div class="btn-row">
                <button class="btn-cancel" onclick="closeDetail()">ปิด</button>
                <button class="btn-save" id="editBtn" onclick="enableEdit()">แก้ไข</button>
                <button class="btn-save" id="saveEditBtn" style="display:none;" onclick="saveEdit()">บันทึก</button>
            </div>
        </div>
    </div>

    <!--
    <script>
        document.addEventListener("DOMContentLoaded", () => {
            document.querySelectorAll(".click-row").forEach(row => {
                row.style.cursor = "pointer";
                row.addEventListener("click", () => {
                    let id = row.getAttribute("data-id");
                    window.location.href = "detail.php?id=" + id;
                });
            });
        });
    </script>
    -->
</body>

</html>