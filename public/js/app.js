// const headerOptions = document.querySelectorAll(".header-option");

//   headerOptions.forEach((option) => {
//     option.addEventListener("click", function () {
//       // Elimina la clase "selected" de todas las opciones
//       headerOptions.forEach((opt) => opt.classList.remove("selected"));

//       // Agrega la clase "selected" a la opción seleccionada
//       this.classList.add("selected");
//     });
//   });

// const header = document.querySelector(".header");
// const gaming = document.querySelector(".gaming");

//   window.addEventListener("scroll", function () {
//     if (window.scrollY > 0) {
//       header.style.backgroundColor = "#c4983a";
//       gaming.style.color = "#1d1546"

//     } else {
//       header.style.backgroundColor = "#151136";
//       gaming.style.color = "#c4983a"
//     }
//   });

const headerOptions = document.querySelectorAll(".header-option");

headerOptions.forEach((option) => {
  option.addEventListener("click", function () {
    // Elimina la clase "selected" de todas las opciones
    headerOptions.forEach((opt) => opt.classList.remove("selected"));

    // Agrega la clase "selected" a la opción seleccionada
    this.classList.add("selected");
  });
});

const header = document.querySelector(".header");
const gaming = document.querySelector(".gaming");

function updateHeaderColors(isScrolled) {
  header.style.backgroundColor = isScrolled ? "#c4983a" : "#151136";
  gaming.style.color = isScrolled ? "#1d1546" : "#c4983a";

  if (isScrolled) {
    header.classList.add("scrolled");
  } else {
    header.classList.remove("scrolled");
  }
}

window.addEventListener("scroll", function () {
  const isScrolled = window.scrollY > 0;
  updateHeaderColors(isScrolled);
});