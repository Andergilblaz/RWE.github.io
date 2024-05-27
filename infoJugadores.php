<!DOCTYPE html>
<html style="overflow-y: hidden;">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resultados Waterpolo Español</title>
    <link rel="stylesheet" href="estilos.css">
    <script src="./Scripts/scripts.js"></script> <!-- Incluye el archivo JavaScript -->
    <link rel="icon" type="image/jpg" href="./Multimedia/Fotos/LogoWaterpolo.png" />
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
    }

    /*Script para que cargue el jugador con el id que sale en la URL de la pagina*/
    document.addEventListener('DOMContentLoaded', function () {
        // Obtener el fragmento de la URL (el ID del jugador)
        const jugadorId = window.location.hash.substring(1);

        // Mostrar solo la información del jugador correspondiente
        if (jugadorId) {
            // Ocultar todos los contenedores de información de los jugadores
            const contenedoresJugadores = document.querySelectorAll('[id^="infoJugador"]');
            contenedoresJugadores.forEach(function (contenedor) {
                contenedor.style.display = 'none';
            });

            // Mostrar el contenedor de información del jugador con el ID correspondiente
            const contenedorJugador = document.getElementById('infoJugador' + jugadorId);
            if (contenedorJugador) {
                contenedorJugador.style.display = 'block';
            }
        }
    });

</script>


<body>

    <div class="tablaMenu"> <!--tablaMenu-->
        <!-- Aqui se mostrara la tablaMenu -->
        <header id="tablaMenu"> </header>
    </div>

    <article> <!--CuadradoInfo-->
        <div class="cuadradoInfo"> <!-- Inicio del div del cuadrado -->

            <?php
            // Función para cargar el jugador desde el archivo XML
            function cargarJugador($xmlFile, $urlFoto)
            {
                // Verificar si el archivo XML existe
                if (file_exists($xmlFile)) {
                    $xml = simplexml_load_file($xmlFile);
                    if ($xml) {
                        foreach ($xml->temporadas->temporada->equipos->equipo->jugadores->jugador as $jugador) {
                            $foto = (string) $jugador->foto;
                            // Si la foto coincide con la URL de la foto buscada, retorna todo el nodo del jugador
                            if ($foto === $urlFoto) {
                                return $jugador;
                            }
                        }
                    } else {
                        echo "Error al cargar el archivo XML.";
                    }
                } else {
                    echo "El archivo XML de jugadores no existe.";
                }

                return null; // Retorna null si no se encontró el jugador
            }

            // Ruta al archivo XML de jugadores
            $xmlFileJugadores = './XML/temporadas.xml';

            // Obtener la URL de la foto desde la URL de la página
            $urlFoto = isset($_GET['jugador']) ? $_GET['jugador'] : null;

            // Inicializar la variable del jugador
            $jugador = null;

            // Si se encontró una URL de foto en la URL de la página, intentar cargar el jugador desde el archivo XML
            if ($urlFoto) {
                $jugador = cargarJugador($xmlFileJugadores, $urlFoto);
            }

            // Si se encontró un jugador, imprimir toda la información del jugador
            if ($jugador) {
                echo "<img src='Multimedia/Fotos/Chica.png' class='chica' width='300px' style='float: left;'>";
                echo "<img src='Multimedia/Fotos/Chico.png' class='chico' width='300px' style='float: right;''>";
                echo "<h2 style='text-align:center;'>" . $jugador->nombre . " " . $jugador->apellidos . "</h2>";

                echo "<div style='background-color: white; padding: 10px; width:55%; margin:0 auto; border-radius:12px;' >";
                echo "<img src='" . $jugador->foto . "' alt='Foto del jugador' width=215px; style='float:right; margin-right: 25px;'><br>";
                echo "<p><strong>Nombre y apellidos:</strong> " . $jugador->nombre . " " . $jugador->apellidos . "</p>";
                echo "<p><strong>Fecha de nacimiento:</strong> " . $jugador->fechaNacimiento . "</p>";
                echo "<p><strong>Nacionalidad:</strong> " . $jugador->nacionalidad . "</p>";
                echo "<p><strong>Posición:</strong> " . $jugador->posicion . "</p>";
                echo "<p><strong>Dorsal:</strong> " . $jugador->dorsal . "</p>";
                echo "</div> <br>";

            }
            ?>

        </div>
    </article><br><br><br><br> <!--Espacios para que haya hueco hasta el footer-->

    <div> <!--footer-->
        <!-- Aqui se mostrara el footer -->
        <footer id="footer"> </footer>
    </div>
</body>


</html>
