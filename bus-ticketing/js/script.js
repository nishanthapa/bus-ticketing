// Load saved theme
window.onload = function () {
    let theme = localStorage.getItem("theme");

    if (theme === "dark") {
        document.body.classList.add("dark");
        document.getElementById("themeBtn").innerText = "☀️";
    }
};

// Toggle function
function toggleTheme() {
    let body = document.body;
    let btn = document.getElementById("themeBtn");

    body.classList.toggle("dark");

    if (body.classList.contains("dark")) {
        localStorage.setItem("theme", "dark");
        btn.innerText = "☀️"; // show sun
    } else {
        localStorage.setItem("theme", "light");
        btn.innerText = "🌙"; // show moon
    }
}