const toggler = document.getElementById("toggler");
const sidebar = document.getElementById("sidebar");
const section2 = document.getElementById("section2");
const footer = document.getElementById("footer");

toggler.addEventListener("click", () => {
  sidebar.classList.toggle("show");
  section2.classList.toggle("show");
  toggler.classList.toggle("show");
  footer.classList.toggle("show");
});
//

// Ambil elemen button, popup, dan overlay
const tambahBtn = document.querySelector(".tambah");
const kurangBtn = document.querySelector(".kurang");
const closeBtn = document.getElementById("closeBtn");
const popupForm = document.getElementById("popupForm");
const popupForm2 = document.getElementById("popupForm2");
const overlay = document.getElementById("overlay");
const overlay2 = document.getElementById("overlay2");

// Event listener untuk tombol "tambah"
tambahBtn.addEventListener("click", function () {
  // Tampilkan popup dan overlay
  popupForm.style.display = "block";
  overlay.style.display = "block";
});
// Event listener untuk tombol "kurang"
kurangBtn.addEventListener("click", function () {
  // Tampilkan popup dan overlay
  popupForm2.style.display = "block";
  overlay2.style.display = "block";
});

// Event listener untuk tombol "tutup"
closeBtn.addEventListener("click", function () {
  // Sembunyikan popup dan overlay
  popupForm.style.display = "none";
  overlay.style.display = "none";
});

// Jika overlay ditekan, sembunyikan pop-up juga
overlay.addEventListener("click", function () {
  popupForm.style.display = "none";
  overlay.style.display = "none";
});
overlay2.addEventListener("click", function () {
  popupForm2.style.display = "none";
  overlay2.style.display = "none";
});
//
//
//
//

const popup = document.querySelector(".popup-form");
const popup2 = document.querySelector(".popup-form2");
const button = document.querySelector(".tambah");
const button2 = document.querySelector(".kurang");

button.addEventListener("click", () => {
  popup.classList.add("show");
});
button2.addEventListener("click", () => {
  popup2.classList.add("show");
});
//
//
//
//
//

document.addEventListener("DOMContentLoaded", function () {
  var vImgButton = document.getElementById("v-img");
  var logoutDiv = document.getElementById("logout");

  vImgButton.addEventListener("click", function () {
    if (logoutDiv.style.display === "block") {
      logoutDiv.style.display = "none"; // Sembunyikan logout jika sudah tampil
    } else {
      logoutDiv.style.display = "block"; // Tampilkan logout jika belum tampil
    }
  });
});
