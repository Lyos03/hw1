function updateDarkModeButton(isDark) {
    const darkModeButton = document.getElementById("DarkMode_button");
    if (!darkModeButton) return;
    
    darkModeButton.dataset.toggled = isDark ? "true" : "false";
    darkModeButton.textContent = isDark ? "ON" : "OFF";
    isDark ? darkModeButton.classList.add("toggled") : darkModeButton.classList.remove("toggled");
}

function initDarkModeButton() {
    const isDark = document.body.classList.contains("dark-mode_gray");
    updateDarkModeButton(isDark);
}

function setupDarkModeToggle() {
    const isDark = darkModeButton.dataset.toggled !== "true";
    applyDarkMode(isDark);
    updateDarkModeButton(isDark);
    
    fetch('update-dark-mode.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: `darkMode=${isDark}`
    });
}

const darkModeButton = document.getElementById("DarkMode_button");

initDarkModeButton();

if (darkModeButton) {
    darkModeButton.addEventListener("click", setupDarkModeToggle);
}