
const selectAll = document.getElementById("selectAll");
const checkboxes = document.querySelectorAll(".row-check");
const countText = document.querySelector(".count-text");

// นับจำนวนเลือก
function updateCount() {
    const count = document.querySelectorAll(".row-check:checked").length;
    countText.textContent = count + " items";
}

// เลือกทั้งหมด
selectAll.addEventListener("change", function() {
    checkboxes.forEach(ch => ch.checked = selectAll.checked);
    updateCount();
});

// เปลี่ยน sort
document.getElementById("sortSelect").addEventListener("change", function() {
    let sort = this.value;
    window.location.href = "?sort=" + sort;
});
