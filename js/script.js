const przycisk = document.querySelector(".menu-toggle");
const menu = document.querySelector(".menu");

function ustawMenu(otwarte) {
  menu.classList.toggle("menu--open", otwarte);
  przycisk.setAttribute("aria-expanded", otwarte);
  document.body.classList.toggle("menu-open", otwarte); // blokada przewijania
}

// Kliknięcie przycisku: otwórz albo zamknij
przycisk.addEventListener("click", function () {
  ustawMenu(!menu.classList.contains("menu--open"));
});

// Kliknięcie linku w menu: zamknij menu i przewiń do sekcji
menu.addEventListener("click", function (event) {
  if (event.target.closest("a")) {
    ustawMenu(false);
  }
});
