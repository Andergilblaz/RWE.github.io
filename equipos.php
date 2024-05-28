<!DOCTYPE html>
<html lang="es">

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
    // Detectar la escala de la pantalla y ajustar el zoom para la correcta visualización
    var scale = window.devicePixelRatio * 100;
    var zoomLevel = 1.0;

    if (scale === 100) {
      zoomLevel = 1.25;
    } else if (scale === 125) {
      zoomLevel = 1.0;
    }

    document.body.style.zoom = zoomLevel;
  };
</script>

<body>
  <div class="tablaMenu">
    <header id="tablaMenu"> </header>
  </div>

  <article class="cuadradoInfo">
    <?php
    // Inicia la sesión
    session_start();

    // Función para cargar los datos del equipo y sus jugadores desde el archivo XML
    function cargarEquipo($urlEscudo)
    {
      $xmlFile = './XML/temporadas.xml';

      // Verificar si el archivo XML existe
      if (file_exists($xmlFile)) {
        $xml = simplexml_load_file($xmlFile);
        if ($xml && isset($xml->temporadas)) {
          foreach ($xml->temporadas->temporada->equipos->equipo as $equipo) {
            $escudo = (string) $equipo->escudo;
            if ($escudo === $urlEscudo) {
              // Retorna los datos del equipo y sus jugadores
              return $equipo;
            }
          }
        } else {
          echo "Error al cargar el archivo XML.";
        }
      } else {
        echo "El archivo XML de equipos no existe.";
      }

      return null; // Retorna null si no se encontró el equipo
    }

    // Obtener la URL del escudo del equipo desde la URL de la página
    $urlEscudo = $_GET['escudo'];

    // Cargar los datos del equipo y sus jugadores
    $equipo = cargarEquipo($urlEscudo);

    // Si se encontró un equipo, imprimir toda la información del equipo
    if ($equipo) {
      echo "<h2 style='text-align:center;'>" . htmlspecialchars($equipo->nombreEquipo) . "</h2><br>";
      echo "<img src='" . htmlspecialchars($equipo->escudo) . "' alt='Escudo del equipo' style='width: 100px; margin: 0 auto; display: block; margin-top:-25px;'><br>";
      echo "<h2 style='margin-bottom:-10px; margin-top:-10px; text-decoration:underline; margin-left: 65px;'>Jugadores</h2><br>";

      // Poner la foto y el nombre de cada jugador en un cuadrado contenedor
      echo "<div style='background-color: white; display: flex; flex-wrap: wrap; justify-content: center; border-radius:12px; overflow-x: auto; width: 90%; margin: 0 auto;'>"; // Added width and margin properties
      foreach ($equipo->jugadores->jugador as $jugador) {
      echo "<div style='margin: 15px;'>";
      echo "<a href='infoJugadores.php?jugador=" . urlencode($jugador->foto) . "'><img src='" . htmlspecialchars($jugador->foto) . "' alt='Foto del jugador' style='width: 100px;'></a><br>";
      echo "<p style='text-align:center; margin-top:-1px; margin-bottom: -15px;'>" . htmlspecialchars($jugador->nombre) . "</p> <br>";
      echo "</div>";
      }
      echo "</div>";
      echo "<br> <br>";
    } else {
      echo "<p>Equipo no encontrado.</p>";
    }
    ?>
  </article>

  <div>
    <footer id="footer"> </footer>
  </div>
</body>

</html>
