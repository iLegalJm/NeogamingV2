document.addEventListener("DOMContentLoaded", (event) => {
  //! cookies

  // ? TODAS LAS COOCKIES SE GUARDAN SEPARADAS POR ;
  const cookies = document.cookie.split(";");
  let cookie = null;

  cookies.forEach((item) => {
    if (item.indexOf("items") > -1) {
      cookie = item;
    }
  });

  if (cookie != null) {
    const count = cookie.split("=")[1];
    console.log(count);
    document.querySelector(".btn-carrito").innerHTML = `(${count}) Carrito`;
  }
});

const url = "http://localhost:8080/";
const btnCarrito = document.querySelector(".btn-carrito");
btnCarrito.addEventListener("click", (event) => {
  console.log("click");
  const carritoContainer = document.querySelector("#carrito-container");

  console.log(carritoContainer);
  if (carritoContainer.style.display == "") {
    carritoContainer.style.display = "block";
    actualizarCarritoUi();
  } else if (carritoContainer.style.display == "none") {
    carritoContainer.style.display = "block";
  } else {
    carritoContainer.style.display = "none";
  }
});

function actualizarCarritoUi() {
  fetch(url + "api/carrito/api-carrito.php?action=mostrar")
    .then((response) => response.json())
    .then((data) => {
      console.log(data);
      let tablaCont = document.querySelector("#tabla");
      let precioTotal = "";
      let html = "";

      data.items.forEach((element) => {
        html += `
          <div class='fila'>
            <div class='imagen'>
              <img src='${url}public/img/productos/${element.foto}' width='100'>
            </div>

            <div class='info'>
              <input type='hidden' value='${element.id}'/>
              <div class='nombre'>${element.nombre}</div>
              <div>${element.cantidad} items de ${element.precio}</div>
              <div class='botones'><button class='btn-remove'>Quitar 1 del carrito</button></div>
            </div>
          </div>
        `;
      });

      precioTotal = `<p>Total: S/.${data.info.total}</p>`;
      tablaCont.innerHTML = precioTotal + html;

      document.cookie = `items=${data.info.count}`;
      document.cookie = `total=${data.info.total}`;

      btnCarrito.innerHTML = `(${data.info.count}) Carrito`;

      document.querySelectorAll(".btn-remove").forEach((boton) => {
        boton.addEventListener("click", (e) => {
          const id = boton.parentElement.parentElement.children[0].value;
          removeItemFromCarrito(id);
        });
      });
    });
}

const botones = document.querySelectorAll(".btn-add");

botones.forEach((boton) => {
  const id = boton.parentElement.parentElement.children[0].children[0].value;
  boton.addEventListener("click", (e) => {
    console.log(id);
    addItemToCarrito(id);
  });
});

function removeItemFromCarrito(id) {
  let urlR = url + "api/carrito/api-carrito.php?action=remove&id=" + id;
  fetch(urlR)
    .then((res) => res.json())
    .then((data) => {
      actualizarCarritoUi();
    });
}

function addItemToCarrito(id) {
  let urlA = url + "api/carrito/api-carrito.php?action=add&id=" + id;
  fetch(urlA)
    .then((res) => res.json())
    .then((data) => {
      actualizarCarritoUi();
    });
}
