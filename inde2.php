<?php
$uri = $_SERVER['REQUEST_URI'];
echo $uri;
?>

<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm" crossorigin="anonymous" />
  <link rel="stylesheet" href="css/style.css">
  <title>NeoGaming 🧬🕹</title>
</head>

<body>
  <header class="header">
    <h1>Neo<span class="gaming">Gaming</span></h1>
    <nav class="nav">
      <ul>
        <li class="header-option selected"><a class="nav-item" href="#">Inicio</a></li>
        <li class="header-option"><a class="nav-item" href="#nosotros">Nosotros</a></li>
        <li class="header-option"><a class="nav-item" href="#contacto">Contacto</a></li>
        <li class="header-option"><a class="nav-item" target="_blank" href="https://brandt322.github.io/NeoGaming/">Github</a></li>
      </ul>
    </nav>
  </header>
  <section class="filters">
    <div class="filters_search">
      <form>
        <label for="buscar">Buscar videojuego:</label>
        <input type="text" class="buscar" id="buscar" name="buscar" />
      </form>
    </div>
    <div class="form-container">
      <form class="filters-form">
        <div class="selects-container">
          <div class="select-container">
            <label for="mes">Filtrar por mes:</label>
            <select class="select" id="mes" name="mes">
              <option value="">Todos</option>
              <option value="01">Enero</option>
              <option value="02">Febrero</option>
              <option value="03">Marzo</option>
              <option value="04">Abril</option>
              <!-- Continuar con el resto de los meses -->
            </select>
          </div>
          <div class="select-container">
            <label for="genero">Filtrar por género:</label>
            <select class="select" id="genero" name="genero">
              <option value="">Todos</option>
              <option value="accion">Acción</option>
              <option value="aventura">Aventura</option>
              <option value="deportes">Deportes</option>
              <option value="estrategia">Estrategia</option>
              <!-- Continuar con el resto de los géneros -->
            </select>
          </div>
          <div class="select-container">
            <label for="popularidad">Filtrar por popularidad:</label>
            <select class="select" id="popularidad" name="popularidad">
              <option value="">Todos</option>
              <option value="baja">Baja</option>
              <option value="media">Media</option>
              <option value="alta">Alta</option>
            </select>
          </div>
        </div>
      </form>
    </div>
  </section>
  <main>
    <!-- crear componentes reutilizables -->
    <section class="tarjetas">
      <article class="tarjeta">
        <a href="./Components/VideoGameInfo/residentEvil.html">
          <img src="assets/re4.png" alt="re4" width="520px" height="320px" />
          <h2>Resident Evil 4</h2>
          <p class="fecha">Fecha de lanzamiento: 23 de Marzo del 2023</p>
          <p class="descripcion">Revive la pesadilla que revolucionó el género del survival horror.</p>
        </a>
      </article>
      <article class="tarjeta">
        <a href="./Components/VideoGameInfo/deadSpace.html">
          <img src="assets/dead-space-remake.png" alt="re4" width="520px" height="320px" />
          <h2>Dead Space Remake</h2>
          <p class="fecha">Fecha de lanzamiento: 27 de enero del 2023</p>
          <p class="descripcion">Sumergete en terror y acción de nueva generación</p>
        </a>
      </article>
      <article class="tarjeta">
        <a href="./Components/VideoGameInfo/residentEvil.html">
          <img src="assets/re4.png" alt="re4" width="520px" height="320px" />
          <h2>Resident Evil 4</h2>
          <p class="fecha">Fecha de lanzamiento: 23 de Marzo del 2023</p>
          <p class="descripcion">Revive la pesadilla que revolucionó el género del survival horror.</p>
        </a>
      </article>
      <article class="tarjeta">
        <a href="./Components/VideoGameInfo/deadSpace.html">
          <img src="assets/dead-space-remake.png" alt="re4" width="520px" height="320px" />
          <h2>Dead Space Remake</h2>
          <p class="fecha">Fecha de lanzamiento: 27 de enero del 2023</p>
          <p class="descripcion">Sumergete en terror y acción de nueva generación</p>
        </a>
      </article>
      <article class="tarjeta">
        <a href="./Components/VideoGameInfo/residentEvil.html">
          <img src="assets/re4.png" alt="re4" width="520px" height="320px" />
          <h2>Resident Evil 4</h2>
          <p class="fecha">Fecha de lanzamiento: 23 de Marzo del 2023</p>
          <p class="descripcion">Revive la pesadilla que revolucionó el género del survival horror.</p>
        </a>
      </article>
      <article class="tarjeta">
        <a href="./Components/VideoGameInfo/deadSpace.html">
          <img src="assets/dead-space-remake.png" alt="re4" width="520px" height="320px" />
          <h2>Dead Space Remake</h2>
          <p class="fecha">Fecha de lanzamiento: 27 de enero del 2023</p>
          <p class="descripcion">Sumergete en terror y acción de nueva generación</p>
        </a>
      </article>
      <article class="tarjeta">
        <a href="./Components/VideoGameInfo/residentEvil.html">
          <img src="assets/re4.png" alt="re4" width="520px" height="320px" />
          <h2>Resident Evil 4</h2>
          <p class="fecha">Fecha de lanzamiento: 23 de Marzo del 2023</p>
          <p class="descripcion">Revive la pesadilla que revolucionó el género del survival horror.</p>
        </a>
      </article>
      <article class="tarjeta">
        <a href="./Components/VideoGameInfo/deadSpace.html">
          <img src="assets/dead-space-remake.png" alt="re4" width="520px" height="320px" />
          <h2>Dead Space Remake</h2>
          <p class="fecha">Fecha de lanzamiento: 27 de enero del 2023</p>
          <p class="descripcion">Sumergete en terror y acción de nueva generación</p>
        </a>
      </article>
      <article class="tarjeta">
        <a href="./Components/VideoGameInfo/residentEvil.html">
          <img src="assets/re4.png" alt="re4" width="520px" height="320px" />
          <h2>Resident Evil 4</h2>
          <p class="fecha">Fecha de lanzamiento: 23 de Marzo del 2023</p>
          <p class="descripcion">Revive la pesadilla que revolucionó el género del survival horror.</p>
        </a>
      </article>
      <!-- Continuar con el resto de las tarjetas -->
    </section>
    <section id="nosotros">
      <h2>Sobre <span>nosotros</span></h2>
      <p>Bienvenido a nuestro sitio web, donde nos apasiona la creación de contenido relacionado con los videojuegos.
        Nos hemos dado cuenta de que puede ser difícil encontrar una lista completa de todos los videojuegos lanzados en
        un año determinado, por lo que hemos creado este sitio web para hacer precisamente eso: proporcionar una lista
        completa de todos los videojuegos estrenados en el año 2023. <br> Nuestro equipo está compuesto por entusiastas
        de los videojuegos con experiencia en la creación de contenido informativo y entretenido relacionado con los
        videojuegos. Nos esforzamos por proporcionar información precisa y actualizada sobre todos los videojuegos que
        se lanzan en el año 2023. <br> Además, nos enorgullece presentar nuestro sitio web que en las proximas semanas
        contara con un diseño atractivo y moderno, utilizando tecnologías como HTML, CSS, JavaScript, y React para crear
        una experiencia de usuario fluida e interactiva. También utilizamos frameworks como Bootstrap, Tailwind o
        Mateiral UI para ayudarnos en el diseño y la estructuración de nuestro sitio web. <br> Si tienes alguna pregunta
        o comentario, no dudes en ponerte en contacto con nosotros. ¡Esperamos que disfrutes explorando nuestro sitio
        web y encontrando nuevos videojuegos para jugar en el año 2023! </p>
    </section>
    <section id="contacto">
      <div class="contacto_mensaje">
        <h2>Contacto</h2>
        <p>Si tiene alguna pregunta o comentario sobre nuestro sitio web, no dude en ponerse en contacto con nosotros.
          Puede enviarnos un correo electrónico o seguirnos en nuestras redes sociales para estar al tanto de las
          últimas noticias y actualizaciones.</p>
      </div>
      <div class="formulario">
        <form>
          <label for="nombre">Nombre:</label>
          <input type="text" id="nombre" name="nombre" required>
          <br>
          <br>
          <label for="correo">Correo electrónico:</label>
          <input type="email" id="correo" name="correo" required>
          <br>
          <br>
          <label for="mensaje">Mensaje:</label>
          <textarea id="mensaje" name="mensaje" rows="5" required></textarea>
          <br>
          <br>
          <button type="submit" reset>Enviar mensaje</button> <!-- evitar reset -->
        </form>
      </div>
      <div class="redes-sociales">
        <h3>Síguenos en nuestras redes sociales:</h3>
        <ul>
          <li><a href="#"><i class="fab fa-facebook-f"></i> Facebook</a></li>
          <li><a href="#"><i class="fab fa-youtube"></i> Youtube</a></li>
          <li><a href="#"><i class="fab fa-instagram"></i> Instagram</a></li>
        </ul>
      </div>
    </section>
  </main>
  <script src="scripts/app.js"></script>
</body>

</html>