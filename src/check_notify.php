<?php
include "config.php";
include "send_line_message.php";
date_default_timezone_set('Asia/Bangkok');

// เวลาปัจจุบัน
$nowDate = date('Y-m-d');
$nowTime = date('H:i');

// ค้นหางานที่ถึงเวลาในช่วง 1 นาที
$sql = "SELECT t.*, u.line_user_id 
        FROM todos t
        JOIN users u ON u.id = t.user_id
        WHERE t.notify = 1
AND t.due_date = CURDATE()
AND t.due_time <= DATE_FORMAT(NOW(), '%H:%i')

";

$result = $conn->query($sql);

// วนส่งทีละงาน
while ($task = $result->fetch_assoc()) {

    $lineUserId = $task['line_user_id'];

    $msg = "⏰ ถึงเวลางานของคุณแล้ว!\n\n"
         . "งาน: {$task['title']}\n"
         . "รายละเอียด: {$task['description']}\n"
         . "เวลา: {$task['due_date']} {$task['due_time']}";

    sendLineMessage($lineUserId, $msg);

    // ป้องกันไม่ให้ส่งซ้ำ
    $conn->query("UPDATE todos SET notify = 0 WHERE id = {$task['id']}");
}

echo "Checked at " . date("H:i:s");
?>
