// window.addEventListener("DOMContentLoaded", () => {
// ! MODAL
// window.addEventListener("load", () => {
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

// ! METODO PARA MOSTRAR LOS GENEROS
const url = "http://localhost:8080/";

const showGeneros = () => {
  getGeneros().then((dataResults) => {
    console.log(dataResults);
    registros.innerHTML = "";

    for (const genero of dataResults) {
      registros.innerHTML += `
          <tr>
              <td id="txtId">${genero.id}</td>
              <td>${genero.nombre}</td>
              <td><button data-id="${genero.id}" class="btn btn-open"><img src="http://localhost:8080/public/icons/dashboard/edit.svg" alt="logo"/></button>
              <a href="${url}Admin/Genero/delete/${genero.id}"><img src="http://localhost:8080/public/icons/dashboard/trash.svg" alt="logo"/></a></td>
          </tr>
          `;
    }

    const openModalBtn = document.querySelectorAll(".btn-open");
    openModalBtn.forEach((boton) => {
      boton.addEventListener("click", () => {
        openModal();
        if (boton.innerText == "Agregar Genero") {
          btnInsert.innerText = "Agregar";
        } else {
          btnInsert.innerText = "Editar";

          formularioInsert.children[1].value = boton.dataset.id;
        }
      });
    });
  });
};

const getGeneros = async () => {
  try {
    const response = await fetch(url + "Genero/getGenerosJSON", {
      method: "post",
    });

    return response.json();
  } catch (error) {
    alert(
      `${"Hubo un error, la solicitud no se puede procesar en estos momentos. Razón: "}${
        error.message
      }`
    );
    console.log(error);
  }
};

showGeneros();

const btnInsertt = document.querySelector(".btn-submit");
const formularioInsert = document.querySelector("#form-modal");
const registros = document.querySelector("#body");

if (formularioInsert) {
  formularioInsert.addEventListener("submit", (e) => {
    e.preventDefault();
    if (btnInsertt.innerText == "Agregar") {
      console.log("Insertar");
      insertData();
      closeModal();
    } else if (btnInsertt.innerText == "Editar") {
      editData(formularioInsert.children[1].value);
      console.log(formularioInsert.children[1].value);
      closeModal();
    }
    showGeneros();
  });
}

// ! METODO PARA INSERTAR DATA
const insertData = async () => {
  let formInsertData = new FormData(formularioInsert);

  try {
    const response = await fetch(url + "Admin/Genero/insert", {
      method: "POST",
      body: formInsertData,
    })
      .then((res) => res.json())
      .then((data) => {
        console.log(data);
      });
  } catch (error) {
    alert(
      `${"Hubo un error, la solicitud no se puede procesar en estos momentos. Razón: "}${
        error.message
      }`
    );
    console.log(error);
  }
};

// ! METODO PARA EDITAR
const editData = async (id) => {
  let formInsertData = new FormData(formularioInsert);

  try {
    const response = await fetch(url + "Admin/Genero/edit/34", {
      method: "POST",
      body: formInsertData,
    })
      .then((res) => res.json())
      .then((data) => {
        console.log(data);
      });
  } catch (error) {
    alert(
      `${"Hubo un error, la solicitud no se puede procesar en estos momentos. Razón: "}${
        error.message
      }`
    );
    console.log(error);
  }
};
// });
