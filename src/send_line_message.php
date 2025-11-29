<?php

function sendLineMessage($lineUserId, $messageText) {
    // 🔥 ใส่ Channel Access Token ของ Messaging API ตรงนี้
    $accessToken = "+ai0QfKzCDiX2OGMNTr8J6Dc7VD74zuxE/h9Rzt32NzdhLj+MmNwI4aRPo7EVBIVpRTcMfT3X3BjaFQ21MdWuUirkYt8zhBNltrCepmEbdSPVw0Y6/jJFzA13xEwRLRGGkHMVpr7L0WlY8iQVYYc4wdB04t89/1O/w1cDnyilFU=";  // VERY IMPORTANT!

    $data = [
        "to" => $lineUserId,
        "messages" => [
            [
                "type" => "text",
                "text" => $messageText
            ]
        ]
    ];

    $ch = curl_init("https://api.line.me/v2/bot/message/push");
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        "Content-Type: application/json",
        "Authorization: Bearer {$accessToken}"
    ]);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    $result = curl_exec($ch);
    curl_close($ch);

    return $result; // คืนค่าผลลัพธ์ (เผื่อ debug)
}

?>
