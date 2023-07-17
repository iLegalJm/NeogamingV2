// window.addEventListener("DOMContentLoaded", () => {
// ! METODO PARA MOSTRAR LOS GENEROS

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
            <a href="http://localhost:8080/Admin/Genero/delete/${genero.id}"><img src="http://localhost:8080/public/icons/dashboard/trash.svg" alt="logo"/></a></td>
        </tr>
        `;
    }
  });
};

const getGeneros = async () => {
  try {
    const response = await fetch(
      "http://localhost:8080/Genero/getGenerosJSON",
      {
        method: "post",
      }
    );

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

console.log("Aquio crud");
const btnInsertt = document.querySelector(".btn-submit");
const formularioInsert = document.querySelector("#form-modal");
const registros = document.querySelector("#body");

if (formularioInsert) {
  formularioInsert.addEventListener("submit", (e) => {
    e.preventDefault();
    if (btnInsertt.innerText == "Agregar") {
      console.log("Insertar");
      closeModal();
    } else if (btnInsertt.innerText == "Editar") {
      console.log("Editar");
      closeModal();
    }
    showGeneros();
  });
}

// ! METODO PARA INSERTAR DATA
const insertData = async () => {
  let formInsertData = new FormData(formularioInsert);

  try {
    const response = await fetch("http://localhost:8080/Admin/Genero/insert", {
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

// });
