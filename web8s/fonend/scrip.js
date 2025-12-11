 /* MENU cấp 1 */
function toggleMenu(id, arrowId){
    let menu = document.getElementById(id);
    let arrow = document.getElementById(arrowId);

    let isOpen = menu.style.display === "block";

    document.querySelectorAll(".submenu, .nested").forEach(m => m.style.display = "none");
    document.querySelectorAll(".arrow").forEach(a => a.classList.remove("open"));

    if(!isOpen){
        menu.style.display = "block";
        arrow.classList.add("open");
    }
}

/* MENU cấp 2 */
function toggleNested(e, id, arrowId){
    e.stopPropagation();

    let menu = document.getElementById(id);
    let arrow = document.getElementById(arrowId);

    let isOpen = menu.style.display === "block";

    document.querySelectorAll(".nested").forEach(m => m.style.display = "none");
    document.querySelectorAll(".arrow").forEach(a => a.classList.remove("open"));

    if(!isOpen){
        menu.style.display = "block";
        arrow.classList.add("open");
    }
}

/* SEARCH MENU */
function searchMenu(){
    let keyword = document.getElementById("searchInput").value.toLowerCase();
    let items = document.querySelectorAll("nav ul li");

    items.forEach(li=>{
        li.style.display = li.innerText.toLowerCase().includes(keyword) ? "block" : "none";
    });
}

/* QUỐC GIA KHÁC */
function toggleQuocGiaKhac(){
    document.getElementById("quoc_gia_khac_box").style.display =
        (document.getElementById("quoc_gia").value === "Khác") ? "block" : "none";
}

/* SLIDER */
const slider = document.querySelector(".slider");
const images = document.querySelectorAll(".slider img");

let index = 0;

/* Nút NEXT */
document.querySelector(".next").onclick = () => {
    index++;
    if (index >= images.length) index = 0;
    updateSlider();
};

/* Nút PREVIOUS */
document.querySelector(".prev").onclick = () => {
    index--;
    if (index < 0) index = images.length - 1;
    updateSlider();
};

/* Hàm đổi slide */
function updateSlider() {
    slider.style.transform = `translateX(-${index * 100}%)`;
}

/* TỰ CHUYỂN SLIDE */
setInterval(() => {
    index++;
    if (index >= images.length) index = 0;
    updateSlider();
}, 4000); // 4 giây đổi ảnh

/* SCROLL ĐẾN FORM */
document.querySelectorAll('a[href="#dangky"]').forEach(btn => {
    btn.addEventListener("click", (e) => {
        e.preventDefault();
        document.getElementById("dangky").scrollIntoView({ behavior: "smooth" });
    });
});