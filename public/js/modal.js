// window.addEventListener("load", () => {
console.log("aquimodal");
const modal = document.querySelector(".modal");
const overlay = document.querySelector(".overlay");
// const openModalBtn = document.querySelectorAll(".btn-open");
const closeModalBtn = document.querySelector(".btn-close");
const btnInsert = document.querySelector(".btn-submit");

// close modal function
const closeModal = function () {
  modal.classList.add("hidden");
  overlay.classList.add("hidden");
};

// close the modal when the close button and overlay is clicked
closeModalBtn.addEventListener("click", closeModal);
overlay.addEventListener("click", closeModal);

// close modal when the Esc key is pressed
document.addEventListener("keydown", function (e) {
  if (e.key === "Escape" && !modal.classList.contains("hidden")) {
    closeModal();
  }
});

// // * CLOSE MODAL AFTER INSERT
// btnInsert.addEventListener("click", closeModal);

// open modal function
const openModal = function () {
  modal.classList.remove("hidden");
  overlay.classList.remove("hidden");
};

const clicke = function (evento) {
  console.log("texto: ", this.dataset.id);
};
// open modal event

setTimeout(() => {
  console.log("Cargado");
  const openModalBtn = document.querySelectorAll(".btn-open");
  openModalBtn.forEach((boton) => {
    boton.addEventListener("click", () => {
      openModal();
      if (boton.innerText == "Agregar Genero") {
        btnInsert.innerText = "Agregar";
      } else {
        console.log("Texto:", boton.dataset.id);
        btnInsert.innerText = "Editar";
      }
    });
  });
}, 800);

// });
