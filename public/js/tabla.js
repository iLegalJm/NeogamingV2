// ! METODO PARA MOSTRAR LOS GENEROS DE MANERA ASYNCRONA
let registros = document.querySelector("#body");
async function getGeneros() {
  try {
    // registros.innerHTML = '';
    let resp = await fetch(
      "http://localhost:8080/Admin/Genero/getGenerosJSON"
    )
      .then((json) => json.json())
      .then((res) => res);

    resp.forEach((element) => {
      registros.innerHTML += `
        <tr>
            <td>${element.id}</td>
            <td>${element.nombre}</td>
            <td><a href="http://localhost:8080/Admin/Genero/edit/${element.id}">Editar</a></td>
        </tr>
        `;
    });
  } catch (error) {
    console.log("Ocurrio un error " + error);
  }
}

getGeneros();
