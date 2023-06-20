window.addEventListener("DOMContentLoaded", () => {
  const formularioInsert = document.querySelector("#form-modal");
  const registros = document.querySelector("#body");

  if (formularioInsert) {
    formularioInsert.addEventListener("submit", (e) => {
      e.preventDefault();
      insertData();
      showGeneros();
    });
  }

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
            <td><a href="http://localhost:8080/Admin/Genero/edit/${genero.id}">Editar</a>
            <a href="http://localhost:8080/Admin/Genero/delete/${genero.id}">Eliminar</a></td>
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

  // ! METODO PARA INSERTAR DATA
  const insertData = async () => {
    let formInsertData = new FormData(formularioInsert);

    try {
      const response = await fetch(
        "http://localhost:8080/Admin/Genero/insert",
        {
          method: "POST",
          body: formInsertData,
        }
      )
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
});
