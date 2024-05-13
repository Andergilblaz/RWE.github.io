<?php $temporada = isset($_GET['temporada']) ? $_GET['temporada'] : '2024'; ?>  

<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Resultados Waterpolo Español</title>
  <link rel="stylesheet" href="estilos.css">
  <script src="Scripts/scripts.js"></script> <!-- Incluye el archivo JavaScript -->
  <link rel="icon" type="image/jpg" href="Multimedia/Fotos/LogoWaterpolo.png" />
</head>

<script>
  window.onload = function () {
    cargarTablaMenu();
    cargarFooter();
    cargarSeleccionarEquipo();
  };
</script>

<body>
  <img src="Multimedia/Fotos/Chica.png" id="chica" class="chica" width="300" style="float: left; margin-top: 130px;">
  <img src="Multimedia/Fotos/Chico.png" id="chico" class="chico" width="300px" style="float: right; margin-top: 120px;">
  <div class="tablaMenu"> <!--tablaMenu-->
    <!-- Aqui se mostrara la tablaMenu -->
    <header id="tablaMenu"> </header>
  </div>

  <article class="cuadradoInfo"> <!--CuadradoInfo-->

    <!--Botón para el cambio de temporada-->

    <div class="dropdownNone" style="float:left;">
      <li class="dropdown"
        style="list-style: none; border-radius: 12px; margin-top: 20px; margin-left: -130px; font-size: large;">
        <div class="dropdown-content" style="margin-top: -569px; margin-right: 10px; text-align: center;" width="10px">
          <a href="./equipos.php?temporada=2023">2023</a>
          <a href="./equipos.php?temporada=2024">2024</a>
        </div>
        <button id="botonTemporada" class="dropbtn" style=" font-size: large; border-radius: 5px;"><?php echo $temporada; ?>↓</button>
      </li>
    </div>

    <div id="seleccionarEquipo">
      <!-- Aqui se mostrara el contenido -->
    </div>

    <div id="infoEquipo">
      <!-- Aqui se mostrara la info del equipo seleccionado -->
    </div>

    <div id="infoJugadores">
      <!-- Aqui se mostrara la info del equipo seleccionado -->
    </div>

    </div> <!-- Fin del div del cuadrado -->
  </article>

  <br><br><br><br> <!--Espacios para que haya hueco hasta el footer-->
  <div> <!--footer-->
    <!-- Aqui se mostrara el footer -->
    <footer id="footer"> </footer>
  </div>
</body>

</html>