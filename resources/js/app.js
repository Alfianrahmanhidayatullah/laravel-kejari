import "./bootstrap";

document.addEventListener("fullscreenchange", function () {
  const sidebar = document.querySelector(".sidebar"); // Ganti .sidebar dengan class atau ID sidebar Anda
  if (document.fullscreenElement) {
    // Saat masuk ke mode fullscreen
    sidebar.style.display = "none"; // Atau gunakan sidebar.classList.add('hidden') jika memakai Tailwind
  } else {
    // Saat keluar dari mode fullscreen
    sidebar.style.display = "block"; // Atau sidebar.classList.remove('hidden')
  }
});
