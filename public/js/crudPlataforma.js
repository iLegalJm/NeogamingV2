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
  
  const formularioInsert = document.querySelector("#form-modal");
  const registros = document.querySelector("#body");
  
  const url = "http://localhost:8080/";
  // ! METODO PARA MOSTRAR LOS GENEROS
  const showPlataformas = () => {
    getPlataformas().then((dataResults) => {
      console.log(dataResults);
      registros.innerHTML = "";
  
      for (const plataforma of dataResults) {
        registros.innerHTML += `
          <tr>
              <td id="txtId">${plataforma.id}</td>
              <td>${plataforma.nombre}</td>
              <td><button data-id="${plataforma.id}" class="btn btn-open"><img src="${url}public/icons/dashboard/edit.svg" alt="logo"/></a></button>
              <a href="${url}Admin/Plataforma/delete/${plataforma.id}"><img src="${url}public/icons/dashboard/trash.svg" alt="logo"/></a></td>
          </tr>
          `;
      }
  
      const openModalBtn = document.querySelectorAll(".btn-open");
      openModalBtn.forEach((boton) => {
        boton.addEventListener("click", () => {
          openModal();
          if (boton.innerText == "Agregar Plataforma") {
            btnInsert.innerText = "Agregar";
          } else {
            btnInsert.innerText = "Editar";
            formularioInsert.children[1].value = boton.dataset.id;
          }
        });
      });
    });
  };
  
  const getPlataformas = async () => {
    try {
      const response = await fetch(url + "Admin/Plataforma/getPlataformasJSON", {
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
  
  showPlataformas();
  
  const btnInsertt = document.querySelector(".btn-submit");
  if (formularioInsert) {
    formularioInsert.addEventListener("submit", (e) => {
      e.preventDefault();
      if (btnInsertt.innerText == "Agregar") {
        insertData();
        closeModal();
      } else if (btnInsertt.innerText == "Editar") {
        editData(formularioInsert.children[1].value);
        console.log(formularioInsert.children[1].value);
        closeModal();
      }
      showPlataformas();
    });
  }
  // ! METODO PARA INSERTAR DATA
  const insertData = async () => {
    let formInsertData = new FormData(formularioInsert);
  
    try {
      const response = await fetch(url + "Admin/Plataforma/insert", {
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
  
  const editData = async (id) => {
    let formInsertData = new FormData(formularioInsert);
  
    try {
      const response = await fetch(url + "Admin/Plataforma/edit/34", {
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
  