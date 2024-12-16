document.addEventListener("fullscreenchange", function () {
  const sidebar = document.getElementById("sidebar-wrapper");
  if (document.fullscreenElement) {
    sidebar.style.display = "none"; // Hide sidebar in fullscreen
  } else {
    sidebar.style.display = "block"; // Show sidebar when exiting fullscreen
  }
});
