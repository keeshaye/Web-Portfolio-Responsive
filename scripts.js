// FORM VALIDATION
function validateForm() {
    let name = document.getElementById("name")?.value.trim();
    let email = document.getElementById("email")?.value.trim();
    let message = document.getElementById("message")?.value.trim();

    if (!name || !email || !message) {
        alert("Merci de remplir tous les champs !");
        return false;
    }

    alert("Message envoyé !");
    return true;
}

// Back to Top
const backToTopBtn = document.getElementById("backToTop");

// le bouton n’apparaît que quand l’utilisateur a fait défiler la page de 300 pixels ou plus
window.addEventListener("scroll", () => {   
    if (window.scrollY > 300) {
        backToTopBtn.style.display = "block";
    } else {
        backToTopBtn.style.display = "none";
    }
});

backToTopBtn.addEventListener("click", () => {      // remonte tout en haut de la page
    window.scrollTo({ top: 0, behavior: "smooth" });    // défilement progressif et fluide, pas instantané
});


// DARK MODE SYSTEM

document.addEventListener("DOMContentLoaded", () => {
    const themeToggleBtn = document.getElementById("themeToggle");
    const body = document.body;

    // Charger le thème sauvegardé
    if (localStorage.getItem("theme") === "dark") {
        body.classList.add("dark-mode");
        if (themeToggleBtn) themeToggleBtn.textContent = "☀️";
    }

    // Basculer entre dark et light
    if (themeToggleBtn) {
        themeToggleBtn.addEventListener("click", () => {
            body.classList.toggle("dark-mode");

            if (body.classList.contains("dark-mode")) {
                localStorage.setItem("theme", "dark");
                themeToggleBtn.textContent = "☀️";
            } else {
                localStorage.setItem("theme", "light");
                themeToggleBtn.textContent = "🌙";
            }
        });
    }
});
