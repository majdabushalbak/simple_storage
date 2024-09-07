const tabsBox = document.querySelector(".tabs-box");
const arrowIcon = document.querySelectorAll(".icon i");
let isDragging = false;

const handelIcons = () => {
    let scrollVal = Math.round(tabsBox.scrollLeft);
    let maxVal = tabsBox.scrollWidth - tabsBox.clientWidth;

    arrowIcon[0].parentElement.style.display =
        scrollVal + maxVal !== 0 ? "flex" : "none";
    arrowIcon[1].parentElement.style.display =
        scrollVal !== 0 ? "flex" : "none";
};
handelIcons();

arrowIcon.forEach((icon) => {
    icon.addEventListener("click", () => {
        tabsBox.scrollLeft += icon.id === "right" ? +350 : -350;
        setTimeout(() => handelIcons(), 50);
    });
});

const dragging = (e) => {
    if (!isDragging) return;
    tabsBox.classList.add("dragging");
    tabsBox.scrollLeft -= e.movementX;
    handelIcons();
};
const dragStop = () => {
    isDragging = false;
    tabsBox.classList.remove("dragging");
};

tabsBox.addEventListener("mousemove", dragging);
tabsBox.addEventListener("mousedown", () => (isDragging = true));
document.addEventListener("mouseup", dragStop);
