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
?>
<?php require 'navbar.php'; ?>

<!DOCTYPE html>
<html lang="th">
<head>
<meta charset="UTF-8">
<link rel="stylesheet" href="css/style.css">
<title>To-Do List</title>

<style>
/* (CSS จากด้านบนที่ให้ไว้) */
/* ---------- Table Pink Theme ---------- */

        .todo-table {
            width: 100%;
            border-collapse: collapse;
            background: var(--card);
            box-shadow: var(--shadow);
            border-radius: var(--radius);
            overflow: hidden;
            margin-top: 20px;
        }

        .todo-table th {
            background: #ffe3ef;
            color: var(--accent);
            text-align: left;
            padding: 14px;
            font-size: 14px;
        }

        .todo-table td {
            padding: 14px;
            border-top: 1px solid #ffeef4;
            font-size: 15px;
        }

        /* Hover effect */
        .todo-table tr:hover {
            background: #fff7fc;
        }

        /* Buttons */
        .btn-primary {
            background: linear-gradient(90deg, var(--accent), var(--accent-2));
            color: #fff;
        }

        .btn-outline {
            border: 1px solid var(--accent);
            color: var(--accent);
        }

        .btn-small {
            padding: 6px 12px;
            border-radius: 8px;
            font-size: 13px;
            text-decoration: none;
            display: inline-block;
        }

        /* Badges */
        .badge {
            padding: 6px 10px;
            border-radius: 8px;
            font-size: 13px;
            display: inline-block;
        }

        .badge-success {
            background: #e7ffe7;
            color: var(--success);
        }

        .badge-wait {
            background: #fff4d6;
            color: #b88600;
        }

        .badge-alert {
            background: #ffe1e7;
            color: #c0142f;
        }

        .badge-ok {
            background: #e3ffef;
            color: #0c8a3f;
        }

        .header-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .title {
            margin: 0;
        }

        /* row hover clickable */
        .todo-row {
            cursor: pointer;
        }

        .todo-row:hover {
            background: #fff3fb !important;
        }

        /* Checkbox */
        .todo-check {
            transform: scale(1.2);
            cursor: pointer;
        }

        /* Category colors */
        .cat-medical {
            background: #e0ffe4;
            color: #1a7f32;
            padding: 6px 10px;
            border-radius: 8px;
        }

        .cat-medicine {
            background: #f4e9ff;
            color: #6b3bbd;
            padding: 6px 10px;
            border-radius: 8px;
        }

        .cat-work {
            background: #ffe9d6;
            color: #b45a00;
            padding: 6px 10px;
            border-radius: 8px;
        }

        .cat-bill {
            background: #e2f1ff;
            color: #0064c4;
            padding: 6px 10px;
            border-radius: 8px;
        }

        .cat-trip {
            background: #d9fff3;
            color: #008a6e;
            padding: 6px 10px;
            border-radius: 8px;
        }

        /* Search + Filter row */
        .filter-box {
            display: flex;
            gap: 12px;
            margin: 20px 0;
            flex-wrap: wrap;
        }

        .filter-box input,
        .filter-box select {
            padding: 10px 12px;
            border: 1px solid #ddd;
            border-radius: 8px;
            font-size: 15px;
        }
</style>

<script>
// ----------------------------------------
// Update status (checkbox) แบบสดๆ
// ----------------------------------------
function updateStatus(id) {
    let isChecked = document.getElementById("check_" + id).checked ? 1 : 0;

    fetch("update_status.php", {
        method:"POST",
        headers:{ "Content-Type":"application/x-www-form-urlencoded" },
        body: "id=" + id + "&value=" + isChecked
    })
    .then(r => r.text())
    .then(t => console.log("Updated:", t));
}

// ----------------------------------------
// คลิกแถวเข้า edit
// ----------------------------------------
function goEdit(id) {
    window.location.href = "edit_todo.php?id=" + id;
}
</script>

</head>
<body>

<div class="container">

    <h1 class="title">รายการงานของคุณ</h1>

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
            <option value="medical">แพทย์</option>
            <option value="medicine">ยา</option>
            <option value="work">งาน</option>
            <option value="bill">บิล</option>
            <option value="trip">ทริป</option>
        </select>

        <select id="sort" onchange="filterTable()">
            <option value="date">เรียงตามวัน</option>
            <option value="title">เรียงตามชื่อ</option>
        </select>
    </div>

    <table class="todo-table" id="todoTable">
        <tr>
            <th>หมวด</th>
            <th>ประเภท</th>
            <th>รายละเอียด</th>
            <th>วันแจ้งเตือน</th>
            <th>เวลา</th>
            <th>หมายเหตุ</th>
            <th>แจ้งเตือน</th>
            <th>จัดการ</th>
        </tr>

        <?php while($row = $result->fetch_assoc()): ?>

        <?php
            // สีหมวดงาน
            $catClass = "";
            $catText = $row['category'];

            if ($catText == "medical") $catClass = "cat-medical";
            if ($catText == "medicine") $catClass = "cat-medicine";
            if ($catText == "work") $catClass = "cat-work";
            if ($catText == "bill") $catClass = "cat-bill";
            if ($catText == "trip") $catClass = "cat-trip";
        ?>

        <tr class="todo-row"
            data-title="<?= strtolower($row['title']) ?>"
            data-status="<?= $row['is_completed'] ? 'done':'wait' ?>"
            data-cat="<?= $row['category'] ?>">

            <td><?= htmlspecialchars(string: $row['title']) ?></td>

            <td><?= htmlspecialchars(string: $row['description']) ?></td>


            <td><span class="<?= $catClass ?>"><?= $catText ?></span></td>

            <td><?= $row['due_date'] ?></td>
            <td><?= $row['due_time'] ?></td>

            <td>
                <?php if ($row['notify'] == 1): ?>
                    <span class="badge-alert">ยังไม่แจ้ง</span>
                <?php else: ?>
                    <span class="badge-ok">แจ้งแล้ว</span>
                <?php endif; ?>
            </td>

            <td onclick="event.stopPropagation();">
                <a href="edit_todo.php?id=<?= $row['id'] ?>" class="btn-small btn-outline">แก้ไข</a>
                <a href="delete_todo.php?id=<?= $row['id'] ?>" 
                   class="btn-small btn-outline" 
                   style="color:#c0142f;border-color:#c0142f;"
                   onclick="return confirm('ลบงานนี้ไหม?')">ลบ</a>
            </td>

        </tr>

        <?php endwhile; ?>

    </table>

</div>

<script>
// ----------------------------------------
// SEARCH + FILTER + SORT
// ----------------------------------------
function filterTable() {
    let search = document.getElementById("search").value.toLowerCase();
    let filterStatus = document.getElementById("filterStatus").value;
    let filterCat = document.getElementById("filterCat").value;
    let sort = document.getElementById("sort").value;

    let rows = [...document.querySelectorAll("#todoTable tr.todo-row")];

    rows.forEach(r => {
        let title = r.dataset.title;
        let status = r.dataset.status;
        let cat = r.dataset.cat;

        let show = true;

        if (search && !title.includes(search)) show = false;
        if (filterStatus && status !== filterStatus) show = false;
        if (filterCat && cat !== filterCat) show = false;

        r.style.display = show ? "" : "none";
    });

    // SORT
    if (sort === "title") {
        rows.sort((a,b)=> a.dataset.title.localeCompare(b.dataset.title));
    }

    if (sort === "date") {
        rows.sort((a,b)=> 
            a.children[3].innerText.localeCompare(b.children[3].innerText)
        );
    }

    rows.forEach(r => document.querySelector("#todoTable").appendChild(r));
}
</script>

</body>
</html>
