document.addEventListener("DOMContentLoaded", function () {
  // Animasi bar dengan meningkatkan lebar secara bertahap
  let progressBar = document.querySelector('.progress-bar');
  let width = 1;
  let interval = setInterval(function () {
    if (width >= 300) {
      clearInterval(interval);
      document.querySelector('.preloader').style.opacity = 0; // Mengurangkan opacity setelah progress bar penuh
      setTimeout(function () {
        document.querySelector('.preloader').style.display = 'none';
      }, 1000); // Sesuaikan delay sesuai kebutuhan
    } else {
      width++;
      progressBar.style.width = width + '%';
    }
  }, 10);
});
