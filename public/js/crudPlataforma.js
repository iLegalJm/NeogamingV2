window.addEventListener("DOMContentLoaded", () => {
  const formularioInsert = document.querySelector("#form-modal");
  const registros = document.querySelector("#body");

  if (formularioInsert) {
    formularioInsert.addEventListener("submit", (e) => {
      e.preventDefault();
      insertData();
      showPlataformas();
    });
  }

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
            <td><a href="http://localhost:8080/Admin/Plataforma/edit/${plataforma.id}"><img src="http://localhost:8080/public/icons/dashboard/edit.svg" alt="logo"/></a>
            <a href="http://localhost:8080/Admin/Plataforma/delete/${plataforma.id}"><img src="http://localhost:8080/public/icons/dashboard/trash.svg" alt="logo"/></a></td>
        </tr>
        `;
      }
    });
  };

  const getPlataformas = async () => {
    try {
      const response = await fetch(
        "http://localhost:8080/Admin/Plataforma/getPlataformasJSON",
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

  showPlataformas();

  // ! METODO PARA INSERTAR DATA
  const insertData = async () => {
    let formInsertData = new FormData(formularioInsert);

    try {
      const response = await fetch(
        "http://localhost:8080/Admin/Plataforma/insert",
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
