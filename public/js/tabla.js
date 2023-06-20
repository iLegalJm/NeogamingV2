const btnNewGenero = document.querySelector("#btn-new-genero");

btnNewGenero.addEventListener("click", async (e) => {
  const background = document.createElement("div");
  const panel = document.createElement("div");
  const titlebar = document.createElement("div");
  const closeButton = document.createElement("div");
  const closeButtonText = document.createElement("div");
  const ajaxcontent = document.createElement("div");

  background.appendChild(panel);
  panel.appendChild(titlebar);
  panel.appendChild(ajaxcontent);
  titlebar.appendChild(closeButton);
  closeButton.appendChild(closeButtonText);
  closeButtonText.appendChild(document.createTextNode("close"));
  document.querySelector("#main-container").appendChild(background);

  closeButton.addEventListener("click", (e) => {
    background.remove();
  });

  const html = await getContent();
  ajaxcontent.innerHTML += html;
});

async function getContent() {
  const html = await fetch("http://localhost:8080/Admin/Genero/create").then(
    (res) => res.text()
  );
  return html;
}

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
