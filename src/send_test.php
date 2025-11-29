<?php
session_start();
include "config.php";

// ดึง userId ของตัวเองจาก DB
$user_id = $_SESSION['user_id'];
$query = $conn->query("SELECT line_user_id FROM users WHERE id = $user_id");
$data = $query->fetch_assoc();
$line_user_id = $data['line_user_id'];

// Messaging API Access Token
$access_token = "+ai0QfKzCDiX2OGMNTr8J6Dc7VD74zuxE/h9Rzt32NzdhLj+MmNwI4aRPo7EVBIVpRTcMfT3X3BjaFQ21MdWuUirkYt8zhBNltrCepmEbdSPVw0Y6/jJFzA13xEwRLRGGkHMVpr7L0WlY8iQVYYc4wdB04t89/1O/w1cDnyilFU=";  // VERY IMPORTANT!

// เตรียมข้อความ
$message = [
    "to" => $line_user_id,
    "messages" => [
        ["type" => "text", "text" => "ทดสอบแจ้ง รักใบเตย 💖"]
    ]
];


// ส่งออกไป
$ch = curl_init("https://api.line.me/v2/bot/message/push");
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($message));
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    "Content-Type: application/json",
    "Authorization: Bearer $access_token"
]);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

$response = curl_exec($ch);
curl_close($ch);

echo "ส่งข้อความแล้ว! ผลลัพธ์จาก LINE: <br>";
echo "<pre>$response</pre>";
?>
