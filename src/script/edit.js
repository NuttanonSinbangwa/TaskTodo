function openDetailPopup(id) {
  fetch("get_todo_detail.php?id=" + id)
    .then((r) => r.json())
    .then((data) => {
      let html = `
    <input type="hidden" id="edit_id" value="${data.id}">

    <div class="form-grid">
        <div>
            <label>หมวด</label>
            <input id="edit_category" value="${data.category}" disabled>
        </div>

        <div>
            <label>ประเภท</label>
            <input id="edit_title" value="${data.title}" disabled>
        </div>
    </div>

    <div class="form-block">
        <label>รายละเอียด</label>
        <textarea id="edit_description" disabled>${data.description}</textarea>
    </div>

    <div class="form-block">
        <label>หมายเหตุ</label>
        <textarea id="edit_remark" disabled>${data.remark}</textarea>
    </div>

    <div class="form-grid">
        <div>
            <label>วันแจ้งเตือน</label>
            <input type="date" id="edit_date" value="${data.due_date}" disabled>
        </div>

        <div>
            <label>เวลา</label>
            <input type="time" id="edit_time" value="${data.due_time}" disabled>
        </div>
    </div>

    <div class="form-block">
        <label>แจ้งเตือน</label>
        <input class="no-edit" value="${
          data.notify == 0 ? "Approved" : "Pending"
        }" disabled>
    </div>
`;

      document.getElementById("detailContent").innerHTML = html;
      document.getElementById("detailPopup").style.display = "flex";
    });
}

function closeDetail() {
  document.getElementById("detailPopup").style.display = "none";
}

function enableEdit() {
  document
    .querySelectorAll(
      "#detailContent input:not(.no-edit), #detailContent textarea:not(.no-edit)"
    )
    .forEach((e) => (e.disabled = false));

  document.getElementById("editBtn").style.display = "none";
  document.getElementById("saveEditBtn").style.display = "block";
}

function saveEdit() {
  let formData = new FormData();
  formData.append("id", document.getElementById("edit_id").value);
  formData.append("category", document.getElementById("edit_category").value);
  formData.append("title", document.getElementById("edit_title").value);
  formData.append(
    "description",
    document.getElementById("edit_description").value
  );
  formData.append("remark", document.getElementById("edit_remark").value);
  formData.append("due_date", document.getElementById("edit_date").value);
  formData.append("due_time", document.getElementById("edit_time").value);

  fetch("update_todo.php", {
    method: "POST",
    body: formData,
  })
    .then((r) => r.text())
    .then((res) => {
      alert("บันทึกสำเร็จ!");
      location.reload();
    });
}
function filterTable() {
  let search = document.getElementById("search").value.toLowerCase();
  let filterStatus = document.getElementById("filterStatus").value;
  let filterCat = document.getElementById("filterCat").value.toLowerCase();
  let rows = document.querySelectorAll(".todo-row");

  rows.forEach((row) => {
    let title = row.dataset.title.toLowerCase();
    let status = row.dataset.status;
    let cat = row.dataset.cat.toLowerCase();
    let desc = row.querySelector("td:nth-child(3)").innerText.toLowerCase();
    let date = row.querySelector("td:nth-child(4)").innerText.toLowerCase();
    let time = row.querySelector("td:nth-child(5)").innerText.toLowerCase();
    let remark = row.querySelector("td:nth-child(6)").innerText.toLowerCase();

    let textMatch =
      title.includes(search) ||
      cat.includes(search) ||
      desc.includes(search) ||
      remark.includes(search) ||
      date.includes(search) ||
      time.includes(search);

    let show = true;

    // ถ้ามี search แต่ไม่มี match เลย → hide
    if (search && !textMatch) show = false;

    if (filterStatus && status !== filterStatus) show = false;

    if (filterCat && !title.includes(filterCat)) show = false;

    row.style.display = show ? "" : "none";

    // -------------------
    // ⭐ ส่วนจัดเรียง (SORT)
    // -------------------
    let sort = document.getElementById("sort").value;
    let rowArray = Array.from(rows);

    // เรียงตามวัน (อันที่มีอยู่แล้ว)
    if (sort === "date") {
      rowArray.sort((a, b) =>
        a.children[3].innerText.localeCompare(b.children[3].innerText)
      );
    }

    // เรียงตามชื่อ (อันที่มีอยู่แล้ว)
    if (sort === "title") {
      rowArray.sort((a, b) => a.dataset.title.localeCompare(b.dataset.title));
    }

    // ⭐ เรียงตามหมวด (ใหม่!)
    if (sort === "category") {
      rowArray.sort((a, b) => a.dataset.cat.localeCompare(b.dataset.cat));
    }

    // เรียงจากใหม่สุด → เก่าสุด
    if (sort === "created_desc") {
      rowArray.sort(
        (a, b) => new Date(b.dataset.created) - new Date(a.dataset.created)
      );
    }

    // เรียงจากเก่าสุด → ใหม่สุด
    if (sort === "created_asc") {
      rowArray.sort(
        (a, b) => new Date(a.dataset.created) - new Date(b.dataset.created)
      );
    }

    // เอาผลลัพธ์กลับเข้า <tbody>
    let tbody = document.querySelector("tbody");
    rowArray.forEach((r) => tbody.appendChild(r));
  });
}
