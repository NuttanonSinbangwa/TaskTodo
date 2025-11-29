<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>Connect LINE</title>
  <script src="https://static.line-scdn.net/liff/edge/2/sdk.js"></script>
</head>
<body>
<h2>กำลังเชื่อม LINE...</h2>

<script>
const liffId = "2008540347-3VOYME48";

async function main() {

    await liff.init({ liffId });

    // ถ้ามี session เดิม → logout แค่ครั้งเดียว
    if (liff.isLoggedIn() && !sessionStorage.getItem("liff_reset_done")) {
        liff.logout();
        sessionStorage.setItem("liff_reset_done", "1");
        location.reload();
        return;
    }

    // ถ้ายังไม่ login → login
    if (!liff.isLoggedIn()) {
        liff.login();
        return;
    }

    // ==== login แล้ว ====

    const profile = await liff.getProfile();

    await fetch("save_line_id.php", {
        method: "POST",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify({
            userId: profile.userId
        })
    });

    // ล้าง flag
    sessionStorage.removeItem("liff_reset_done");

    // Redirect ไปหน้า index.php
    try { liff.closeWindow(); } catch(e) {}
    window.location.href = "home2.php";
}

main();
</script>

</body>
</html>
