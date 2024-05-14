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

  <!--------------------------------------CARGA INFO EQUIPO--------------------------------->

    <?php
    // Inicia la sesión
    session_start();

    // Función para cargar el equipo desde el archivo XML
    function cargarEquipo($xmlFile, $urlEscudo)
    {
      // Verificar si el archivo XML existe
      if (file_exists($xmlFile)) {
        $xml = simplexml_load_file($xmlFile);
        if ($xml) {
          foreach ($xml->temporada->equipos->equipo as $equipo) {
            $escudo = (string) $equipo->escudo;
            // Si el escudo coincide con la URL del escudo buscado, retorna todo el nodo del equipo
            if ($escudo === $urlEscudo) {
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

    // Ruta al archivo XML de equipos
    $xmlFileEquipos = './XML/temporadas.xml';

    // Obtener la URL del escudo desde la URL de la página
    $urlEscudo = isset($_GET['entity-value']) ? $_GET['entity-value'] : null;

    // Inicializar la variable del equipo
    $equipo = null;

    // Si se encontró una URL de escudo en la URL de la página, intentar cargar el equipo desde el archivo XML
    if ($urlEscudo) {
      $equipo = cargarEquipo($xmlFileEquipos, $urlEscudo);
    }

    // Si se encontró un equipo, imprimir toda la información del equipo
    if ($equipo) {
      
      echo "<h2 style='text-align:center;'> " . $equipo->nombreEquipo . "</h2><br>";
      echo "<img src='" . $equipo->escudo . "' alt='Escudo del equipo' style='width: 75px; margin: 0 auto; display: block; margin-top:-25px;'><br>";
        // Imprimir la foto y el nombre de cada jugador

        echo "<div style='background-color: white; display: flex; border-radius:12px; overflow-x: auto;'>";
        foreach ($equipo->jugadores->jugador as $jugador) {
          echo "<div style='margin: 15px;'>";
          echo "<img src='" . $jugador->foto . "' alt='Foto del jugador' style='width: 100px;'><br>";
          echo "<p style='text-align:center; margin-top:-1px; margin-bottom: -15px;'>" . $jugador->nombre . "</p> <br>";
          echo "</div>";
        }
        echo "</div>";
      
      echo "<div style='background-color: white; padding: 10px; width: 77%; margin-top: 20px; justify-content:center; margin-left: auto; margin-right: auto; border-radius:12px'>"; 
      echo "<h2 style='text-align:center'>Información de la ciudad</h2>";
      echo "Ciudad: " . $equipo->ciudad . "<br>";
      echo "Habitantes: " . $equipo->habitantes . "<br>";
      echo "</div>";
      echo "<br>";
    
    }
    ?>

    </div> <!-- Fin del div del cuadrado -->
  </article>

  <br><br><br><br> <!--Espacios para que haya hueco hasta el footer-->
  <div> <!--footer-->
    <!-- Aqui se mostrara el footer -->
    <footer id="footer"> </footer>
  </div>
</body>

</html>