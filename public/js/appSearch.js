// ! CON ESTO EL CODIGO SE EJECUTARA CUANDO EL CONTENIDO ESTE CARGADO
window.addEventListener("DOMContentLoaded", () => {
  const articleContainer = document.querySelector("#article-results");

  // ! CAPTURANDO LOS BUSCADORES
  const search = document.querySelector("#buscar");
  const searchMes = document.querySelector("#buscarMes");
  const searchGenero = document.querySelector("#buscarGenero");
  // const resultContainer = doc
  let searchByTitulo = "";
  let searchByMes = "";
  let searchByGenero = "";

  if (search || searchMes || searchGenero) {
    // ! EVENTO QUE SE EJECUTARA CUANDO EL VALOR DE INPUT CAMBIE
    search.addEventListener("input", (event) => {
      // ! EVENT, CAPTURA EL EVENTO
      // ! TARGET, REFERENCIA AL ELEMENTO QUE ESTA DISPARANDO EL EVENTO
      searchByTitulo = event.target.value;
      searchByMes = searchMes.value;
      showResults();
    });

    searchMes.addEventListener("input", (event) => {
      searchByMes = event.target.value;
      searchByTitulo = search.value;
      showResults();
    });

    searchGenero.addEventListener("input", (event) => {
      searchByGenero = event.target.value;
      searchByTitulo = search.value;
      searchByMes = searchMes.value;
      showResults();
    });
  }

  // ! PETICION AL SERVIDOR  CON FETCH e.e
  // * FUNCION ASINCRONA
  const searchData = async () => {
    // * CREO MI FORM DATA, Y CON APPEND LE AGREGO ALGO ASI COMO UN INPUT CON EL NAME(PARAMETRO 1) Y SU VALUE(PARAMETRO 2)
    let searchData = new FormData();
    searchData.append("searchByTitulo", searchByTitulo);
    searchData.append("searchByMes", searchByMes);
    searchData.append("searchByGenero", searchByGenero);

    try {
      // ! LA PETICION
      // * COMO MI EXPRESION AWAIT PAUSO LA EJECUCION DE MI FUNCION ASYNC HASTA QUE LA PROMESA TENGA UNA RESPUESTA
      const response = await fetch("http://localhost:8080/Post/getPostsJSON", {
        method: "POST",
        body: searchData,
      });

      // ! RETORNO LA RESPUESTA CONVERTIDO A JS
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

  // ! HORA DE MOSTRAR LOS DATOS
  const showResults = () => {
    // * COMO ME DEVUELVE UNA PROMESA LA FUNCION SEARCH DATA ACCEDO A ELLA CON THEN
    searchData().then((dataResults) => {
      articleContainer.innerHTML = "";
      if (typeof dataResults.data !== "undefined" && !dataResults.data) {
        console.log(dataResults.data);
      } else {
        for (const post of dataResults) {
          const articlePost = document.createElement("article");
          articlePost.className = "tarjeta";
          const enlacePost = document.createElement("a");
          enlacePost.href =
            "http://192.168.18.4:8080/Post/show/" + `${post.id}`;
          enlacePost.innerHTML = `
                    <img
                        src="http://localhost:8080/public/img/posts/${post.foto}"
                        alt="re4"
                        width="520px"
                        height="320px"
                    />
                    <h2>${post.titulo}</h2>
                    <p class="fecha"> Fecha de lanzamiento: ${post.lanzamiento}</p>
                    <p class="descripcion"> ${post.descripcion}</p>
                    `;

          articlePost.appendChild(enlacePost);
          articleContainer.appendChild(articlePost);
        }

        // console.log(dataResults);
      }
    });
  };

  showResults();
});
