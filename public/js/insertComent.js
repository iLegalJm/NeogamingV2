window.addEventListener("DOMContentLoaded", () => {
  // ! METODO PARA AGREGAR COMENTARIO
  const url = "http://localhost:8080/";
  const formularioComent = document.querySelector("#form-coment");
  const idPost = document.querySelector("#form-id").value;
  const articleComents = document.querySelector("#article-coments");

  if (formularioComent) {
    formularioComent.addEventListener("submit", function (e) {
      e.preventDefault();
      insertComent();
      showComents();
    });
  }

  const insertComent = async () => {
    let formComentData = new FormData(formularioComent);

    try {
      const response = await fetch(url + "Coment/insert", {
        method: "POST",
        body: formComentData,
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

  // ! METODO PARA MOSTRAR LOS COMENTARIOS
  const searchComents = async () => {
    let searchData = new FormData();
    searchData.append("idPost", idPost);

    try {
      const response = await fetch(url + "Coment/getComentsJSON", {
        method: "post",
        body: searchData,
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

  console.log(idPost);
  const showComents = () => {
    searchComents().then((dataResults) => {
      console.log(dataResults);
      articleComents.innerHTML = "";
      if (typeof dataResults.data !== "undefined" && !dataResults.data) {
        const noComent = document.createElement("h2");
        noComent.innerText = "Comentario no encontrado";
        articleComents.appendChild(noComent);
      } else {
        for (const coment of dataResults) {
          const divComent = document.createElement("div");
          divComent.innerHTML = `
            <div class="container-profile">
              <h2>${coment.username}</h2>
              <img src="${url}public/img/fotos/${coment.userFoto}" width="50px" style="border-radius: 50%;">    
            </div>
            <p class="container-content" style="font-size: 20px;">${coment.texto}</p>
            `;
          articleComents.appendChild(divComent);
        }
      }
    });
  };

  showComents();
});
