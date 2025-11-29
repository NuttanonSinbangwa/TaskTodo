function connectLine() {
  document.getElementById("lineStatus").innerHTML =
    '<span class="greenText">LINE Connected</span>';
}

function openForm(selectId, mainCategory) {
  let category = document.getElementById(selectId).value;

  if (category === "") {
    alert("กรุณาเลือก Category");
    return;
  }

  document.getElementById("popupTitle").innerText = category;

  // จะเก็บฟอร์มย่อย
  let extra = "";

  // ===================== หมวดสุขภาพแพทย์ (10 ฟอร์ม) =====================
  switch (category) {
    case "นัดพบแพทย์":
      extra = `
                <label>สถานพยาบาล</label><input class="input" data-extra="สถานพยาบาล">
                <label>พบแพทย์เฉพาะทาง</label><input class="input" data-extra="พบแพทย์เฉพาะทาง">
            `;
      break;

    case "ตรวจฟัน":
      extra = `
                <label>คลินิกทันตกรรม</label><input class="input" data-extra="คลินิกทันตกรรม">
                <label>อาการ</label><input class="input" data-extra="อาการ">
            `;
      break;

    case "ตรวจสายตา":
      extra = `
                <label>สถานที่ตรวจสายตา</label><input class="input" data-extra="สถานที่ตรวจสายตา">
                <label>ปัญหาที่พบ</label><input class="input" data-extra="ปัญหาที่พบ">
            `;
      break;

    case "ตรวจสุขภาพประจำปี":
      extra = `
                <label>แพ็กเกจตรวจ</label><input class="input" data-extra="แพ็กเกจตรวจ">
            `;
      break;

    case "ฉีดวัคซีน":
      extra = `
                <label>วัคซีนที่ต้องฉีด</label><input class="input" data-extra="วัคซีนที่ต้องฉีด">
            `;
      break;

    case "รับผลตรวจ":
      extra = `
                <label>ชื่อผลตรวจ</label><input class="input" data-extra="ชื่อผลตรวจ">
            `;
      break;

    case "นัดกายภาพ":
      extra = `
                <label>อาการ</label><input class="input" data-extra="อาการ">
            `;
      break;

    case "นัดทำแผล":
      extra = `
                <label>ตำแหน่งแผล</label><input class="input" data-extra="ตำแหน่งแผล">
            `;
      break;

    case "เจาะเลือด":
      extra = `
                <label>ต้องงดน้ำ/อาหาร</label><input class="input" data-extra="ต้องงดน้ำ/อาหาร">
            `;
      break;

    case "ซื้อยา":
      extra = `
                <label>ชื่อยา</label><input class="input" data-extra="ชื่อยา">
                <label>จำนวน</label><input class="input" data-extra="จำนวน">
            `;
      break;
  }

  // ===================== หมวดชีวิตประจำวัน (10 ฟอร์ม) =====================
  // ===================== หมวดชีวิตประจำวัน =====================
  // ===================== หมวดชีวิตประจำวัน =====================
  switch (category) {
    case "เตรียมอาหาร":
      extra = `
            <label>เมนูที่ต้องการเตรียม</label><input class="input" data-extra="เมนูที่ต้องการเตรียม">
            <label>วัตถุดิบที่ต้องใช้</label><input class="input" data-extra="วัตถุดิบที่ต้องใช้">
        `;
      break;

    case "ซื้อของเข้าบ้าน":
      extra = `
            <label>รายการของที่ต้องซื้อ</label><input class="input" data-extra="รายการของที่ต้องซื้อ">
            <label>งบประมาณ (ถ้ามี)</label><input class="input" data-extra="งบประมาณ (ถ้ามี)">
        `;
      break;

    case "เช็คของหมด":
      extra = `
            <label>ของที่ต้องตรวจสอบ</label><input class="input" data-extra="ของที่ต้องตรวจสอบ">
            <label>จำนวนขั้นต่ำที่ควรมี</label><input class="input" data-extra="จำนวนขั้นต่ำที่ควรมี">
        `;
      break;

    case "ล้างจาน":
      extra = `
            <label>โซน/พื้นที่ที่ต้องล้าง</label><input class="input" data-extra="โซน/พื้นที่ที่ต้องล้าง">
        `;
      break;

    case "ทิ้งขยะ":
      extra = `
            <label>ประเภทขยะ</label>
            <select class="input" data-extra="ประเภทขยะ">
                <option>ขยะทั่วไป</option>
                <option>ขยะเปียก</option>
                <option>ขยะรีไซเคิล</option>
            </select>
        `;
      break;

    case "ซักผ้า":
      extra = `
            <label>ชนิดผ้า</label><input class="input" data-extra="ชนิดผ้า">
            <label>จำนวนรอบซัก</label><input class="input" data-extra="จำนวนรอบซัก">
        `;
      break;

    case "ตากผ้า":
      extra = `
            <label>สถานที่ตากผ้า</label><input class="input" data-extra="สถานที่ตากผ้า">
        `;
      break;

    case "เก็บผ้า":
      extra = `
            <label>จำนวนชุดที่ต้องเก็บ</label><input class="input" data-extra="จำนวนชุดที่ต้องเก็บ">
        `;
      break;

    case "รีดผ้า":
      extra = `
            <label>ชุด/เสื้อที่ต้องรีด</label><input class="input" data-extra="ชุด/เสื้อที่ต้องรีด">
        `;
      break;

    case "ดูแลต้นไม้":
      extra = `
            <label>ชื่อต้นไม้</label><input class="input" data-extra="ชื่อต้นไม้">
            <label>สิ่งที่ต้องทำ</label>
            <select class="input" data-extra="สิ่งที่ต้องทำ">
                <option>รดน้ำ</option>
                <option>ใส่ปุ๋ย</option>
                <option>ตัดแต่ง</option>
                <option>เปลี่ยนดิน</option>
            </select>
        `;
      break;

    case "ทำธุระ":
      extra = `
            <label>รายละเอียดธุระ</label>
            <input class="input" placeholder="เช่น ส่งของ, ไปตลาด, ติดต่อเอกสาร" data-extra="รายละเอียดธุระ">

            <label>สถานที่</label>
            <input class="input" placeholder="สถานที่ที่จะไป" data-extra="สถานที่"> 
        `;
      break;

    case "ชีวิตประจำวันอื่นๆ":
      extra = `
            <label>กิจกรรมที่ต้องทำ</label>
            <input class="input" placeholder="กรอกงานที่ต้องทำ" data-extra="กิจกรรมที่ต้องทำ">

            <label>รายละเอียดเพิ่มเติม</label>
            <input class="input" placeholder="ไม่กรอกก็ได้" data-extra="รายละเอียดเพิ่มเติม">
        `;
      break;
  }

  // ===================== หมวดสัตว์เลี้ยง (10 ฟอร์ม) =====================
  switch (category) {
    case "วัคซีนสัตว์":
      extra = `
                <label>ชื่อสัตว์เลี้ยง</label><input class="input" data-extra="ชื่อสัตว์เลี้ยง">
                <label>วัคซีน</label><input class="input" data-extra="วัคซีน">
            `;
      break;

    case "อาบน้ำสัตว์":
      extra = `
                <label>ร้าน/สถานที่</label><input class="input" data-extra="ร้าน/สถานที่">
            `;
      break;

    case "ตัดขนสัตว์":
      extra = `
                <label>ร้านตัดขน</label><input class="input" data-extra="ร้านตัดขน">
            `;
      break;

    case "ตรวจสุขภาพสัตว์":
      extra = `
                <label>โรงพยาบาลสัตว์</label><input class="input" data-extra="โรงพยาบาลสัตว์">
            `;
      break;

    case "ซื้ออาหารสัตว์":
      extra = `
                <label>อาหารที่ต้องซื้อ</label><input class="input" data-extra="อาหารที่ต้องซื้อ">
            `;
      break;

    case "ทำความสะอาดกรง":
      extra = `
                <label>ประเภทสัตว์</label><input class="input" data-extra="ประเภทสัตว์">
            `;
      break;

    case "พาเดิน":
      extra = `
                <label>สถานที่</label><input class="input" data-extra="สถานที่">
            `;
      break;

    case "เปลี่ยนทราย":
      extra = `
                <label>ชนิดทราย</label><input class="input" data-extra="ชนิดทราย">
            `;
      break;

    case "ให้ยาสัตว์":
      extra = `
                <label>ชื่อยา</label><input class="input" data-extra="ชื่อยา">
            `;
      break;

    case "นัดหมอสัตว์":
      extra = `
                <label>คลินิกสัตว์</label><input class="input" data-extra="คลินิกสัตว์">
            `;
      break;
  }

  // ===================== หมวดงานและการเรียน (10 ฟอร์ม) =====================
  switch (category) {
    case "ประชุม":
      extra = `
                <label>หัวข้อประชุม</label><input class="input" data-extra="หัวข้อประชุม">
                <label>ลิงก์ประชุม</label><input class="input" data-extra="ลิงก์ประชุม">
            `;
      break;

    case "รายงาน":
      extra = `
                <label>หัวข้อรายงาน</label><input class="input" data-extra="หัวข้อรายงาน">
            `;
      break;

    case "ส่งงาน":
      extra = `
                <label>ชื่องาน</label><input class="input" data-extra="ชื่องาน">
            `;
      break;

    case "เรียนออนไลน์":
      extra = `
                <label>วิชา</label><input class="input" data-extra="วิชา">
                <label>ลิงก์เรียน</label><input class="input" data-extra="ลิงก์เรียน">
            `;
      break;

    case "ทำสไลด์":
      extra = `
                <label>หัวข้อ</label><input class="input" data-extra="หัวข้อ">
            `;
      break;

    case "แบบฝึกหัด":
      extra = `
                <label>บทที่</label><input class="input" data-extra="บทที่">
            `;
      break;

    case "Presentation":
      extra = `
                <label>หัวข้อพรีเซนต์</label><input class="input" data-extra="หัวข้อพรีเซนต์">
            `;
      break;

    case "นัดคุยอาจารย์":
      extra = `
                <label>อาจารย์</label><input class="input" data-extra="อาจารย์">
            `;
      break;

    case "เตรียมเอกสาร":
      extra = `
                <label>รายการเอกสาร</label><input class="input" data-extra="รายการเอกสาร">
            `;
      break;

    case "ตารางเรียน":
      extra = `
                <label>ภาคเรียน</label><input class="input" data-extra="ภาคเรียน">
            `;
      break;
  }

  // ===================== หมวดบิล (10 ฟอร์ม) =====================

  // ===================== หมวดบิล (Bills) =====================
  switch (category) {
    case "ค่าไฟฟ้า":
      extra = `
            <label>รหัสผู้ใช้ไฟ / หมายเลขมิเตอร์</label>
            <input class="input" data-extra="รหัสผู้ใช้ไฟ / หมายเลขมิเตอร์">

            <label>จำนวนเงิน</label>
            <input type="number" class="input" placeholder="บาท" data-extra="จำนวนเงิน">
        `;
      break;

    case "ค่าน้ำประปา":
      extra = `
            <label>รหัสผู้ใช้น้ำ</label>
            <input class="input" data-extra="รหัสผู้ใช้น้ำ">

            <label>จำนวนเงิน</label>
            <input type="number" class="input" placeholder="บาท" data-extra="จำนวนเงิน">
        `;
      break;

    case "ค่าเน็ตบ้าน":
      extra = `
            <label>ผู้ให้บริการอินเทอร์เน็ต</label>
            <input class="input" placeholder="เช่น AIS, TRUE, 3BB" data-extra="ผู้ให้บริการอินเทอร์เน็ต">

            <label>จำนวนเงิน</label>
            <input type="number" class="input" placeholder="บาท" data-extra="จำนวนเงิน">
        `;
      break;

    case "ค่าโทรศัพท์":
      extra = `
            <label>เบอร์โทรศัพท์</label>
            <input class="input" data-extra="เบอร์โทรศัพท์">

            <label>จำนวนเงิน</label>
            <input type="number" class="input" placeholder="บาท" data-extra="จำนวนเงิน">
        `;
      break;

    case "ค่าเช่าบ้าน":
      extra = `
            <label>สถานที่เช่า</label>
            <input class="input" placeholder="ชื่อหอพัก / บ้านเช่า" data-extra="สถานที่เช่า">

            <label>ค่าเช่า</label>
            <input type="number" class="input" placeholder="บาท" data-extra="ค่าเช่า">
        `;
      break;

    case "ค่าส่วนกลาง":
      extra = `
            <label>ชื่อโครงการ</label>
            <input class="input" data-extra="ชื่อโครงการ">

            <label>จำนวนเงิน</label>
            <input type="number" class="input" placeholder="บาท" data-extra="จำนวนเงิน">
        `;
      break;
  }

  // ----------------------- ฟอร์มหลัก -----------------------
  document.getElementById("popupContent").innerHTML = `
    <input type="hidden" id="mainCategory" value="${mainCategory}">

    ${extra}

    <label>วันที่</label>
    <input type="date" class="input">

    <label>เวลา</label>
    <input type="time" class="input">

    <label>หมายเหตุ</label>
    <textarea class="input"></textarea>

    <div class="btn-row">
        <button class="btn-cancel" onclick="closePopup()">ยกเลิก</button>
        <button class="btn-save" onclick="saveForm()">บันทึก</button>
    </div>
  `;

  document.getElementById("popup").style.display = "flex";
}

/* function saveForm() {

    // ดึงค่าต่าง ๆ ใน popup
    let category = document.getElementById("popupTitle").innerText;
    let date = document.querySelector('input[type="date"]').value;
    let time = document.querySelector('input[type="time"]').value;
    let note = document.querySelector('textarea').value;

    // เก็บข้อมูลเป็น object
    let data = {
        category: category,
        date: date,
        time: time,
        note: note
    };

    // ดึงข้อมูลเก่าใน localStorage
    let allData = JSON.parse(localStorage.getItem("tasks")) || [];

    // เพิ่มข้อมูลใหม่
    allData.push(data);

    // เซฟกลับ localStorage
    localStorage.setItem("tasks", JSON.stringify(allData));

    alert("บันทึกสำเร็จ!");
    closePopup();

    // ไปหน้า overview.html
    window.location.href = "home.html";
}
*/
function saveForm() {

  // เก็บ input + select ที่เป็น extra ทั้งหมด
  let extraInputs = document.querySelectorAll('#popupContent [data-extra]');
  let extraValues = [];

  extraInputs.forEach(inp => {
    let label = inp.getAttribute("data-extra");
    let value = "";

    // ถ้าเป็น select
    if (inp.tagName === "SELECT") {
      value = inp.selectedOptions[0].text;
    }
    // ถ้าเป็น input ธรรมดา
    else {
      value = inp.value.trim();
    }

    extraValues.push(`${label}: ${value}`);
  });

  // รวมแบบสวย ง่าย
  let extraCombined = extraValues.join(" | ");

  let mainCategory = document.getElementById("mainCategory").value;
  let category = document.getElementById("popupTitle").innerText;

  let date = document.querySelector('input[type="date"]').value;
  let time = document.querySelector('input[type="time"]').value;
  let remark = document.querySelector("textarea").value;

  let formData = new FormData();
  formData.append("category", mainCategory);
  formData.append("title", category);
  formData.append("description", extraCombined);
  formData.append("remark", remark);
  formData.append("due_date", date);
  formData.append("due_time", time);
  formData.append("notify", 1);

  fetch("add_todo.php", {
    method: "POST",
    body: formData,
  })
    .then((r) => r.text())
    .then((res) => {
      console.log("PHP:", res);

      if (res.includes("OK")) {
        alert("บันทึกสำเร็จ");
        window.location.href = "form.php";
      } else {
        alert("เกิดข้อผิดพลาด: " + res);
      }
    })
    .catch((err) => {
      alert("Fetch Error: " + err);
    });
}



function closePopup() {
  document.getElementById("popup").style.display = "none";
}
