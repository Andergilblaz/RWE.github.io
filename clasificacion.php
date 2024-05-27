<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resultados Waterpolo Español</title>
    <link rel="stylesheet" href="estilos.css">
    <script src="Scripts/scripts.js"></script>
    <link rel="icon" type="image/jpg" href="Multimedia/Fotos/LogoWaterpolo.png" />
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
    <style>
        .team-logo {
            width: 75px;
            height: 75px;
        }
    </style>
</head>

<body>
    <div class="tablaMenu">
        <header id="tablaMenu"></header>
    </div>
    <article>
        <img src="Multimedia/Fotos/Chica.png" class="chica" width="300px" style="float: left; margin-top: 130px;" />
        <img src="Multimedia/Fotos/Chico.png" class="chico" width="300px" style="float: right; margin-top: 120px;" />
        <div class="cuadradoInfo">
            <div class="dropdownNone" style="float:left;">
                <form id="temporadaForm" action="clasificacion.php" method="get">
                    <select id="temporada" name="temporada"
                        style="font-size: large; border-radius: 5px; margin-top: 20px;margin-right: 25px; background-color:#324679; color: white">
                        <?php
                        // Cargar el XML
                        $xml = simplexml_load_file('./XML/temporadas.xml');

                        if ($xml === false) {
                            die('Error al cargar el archivo XML.');
                        }

                        // Generar opciones para cada temporada
                        foreach ($xml->temporadas->temporada as $t) {
                            $tempId = (string) $t['id'];
                            $selected = isset($_GET['temporada']) && $_GET['temporada'] === $tempId ? 'selected' : '';
                            echo '<option value="' . $tempId . '" ' . $selected . '>' . $tempId . '</option>';
                        }
                        ?>
                    </select>
                </form>
            </div>

            <script>
                //  Obtener el elemento select
                var selectTemporada = document.getElementById("temporada");

                // Escuchar el evento change del select
                selectTemporada.addEventListener("change", function () {
                    // Enviar el formulario automáticamente al cambiar la opción
                    document.getElementById("temporadaForm").submit();
                });
            </script>

            <div style="text-align: center;" id="tablaClasificacion">
                <?php
                // Obtener la temporada seleccionada
                $temporada = isset($_GET['temporada']) ? $_GET['temporada'] : (string) $xml->temporadas->temporada[0]['id'];

                // Inicializar arrays para los equipos y sus estadísticas
                $equipos = [];

                foreach ($xml->temporadas->temporada as $t) {
                    if ((string) $t['id'] === $temporada) {
                        // Inicializar los equipos
                        foreach ($t->equipos->equipo as $equipo) {
                            $nombre = (string) $equipo->nombreEquipo;
                            $equipos[$nombre] = [
                                'nombre' => $nombre,
                                'escudo' => (string) $equipo->escudo,
                                'puntos' => 0,
                                'ganados' => 0,
                                'perdidos' => 0,
                                'empatados' => 0,
                                'partidos' => 0,
                                'golesFavor' => 0,
                                'golesContra' => 0,
                            ];
                        }

                        // Procesar los partidos
                        foreach ($t->jornadas->jornada as $jornada) {
                            foreach ($jornada->partidos->partido as $partido) {
                                $equipoLocal = (string) $partido->equipoLocal;
                                $equipoVisitante = (string) $partido->equipoVisitante;
                                $golesLocal = (int) $partido->goleslocal;
                                $golesVisitante = (int) $partido->golesvisitante;

                                // Actualizar estadísticas para el equipo local
                                $equipos[$equipoLocal]['partidos']++;
                                $equipos[$equipoLocal]['golesFavor'] += $golesLocal;
                                $equipos[$equipoLocal]['golesContra'] += $golesVisitante;

                                // Actualizar estadísticas para el equipo visitante
                                $equipos[$equipoVisitante]['partidos']++;
                                $equipos[$equipoVisitante]['golesFavor'] += $golesVisitante;
                                $equipos[$equipoVisitante]['golesContra'] += $golesLocal;

                                if ($golesLocal > $golesVisitante) {
                                    // Equipo local gana
                                    $equipos[$equipoLocal]['puntos'] += 3;
                                    $equipos[$equipoLocal]['ganados']++;
                                    $equipos[$equipoVisitante]['perdidos']++;
                                } elseif ($golesLocal < $golesVisitante) {
                                    // Equipo visitante gana
                                    $equipos[$equipoVisitante]['puntos'] += 3;
                                    $equipos[$equipoVisitante]['ganados']++;
                                    $equipos[$equipoLocal]['perdidos']++;
                                } else {
                                    // Empate
                                    $equipos[$equipoLocal]['puntos'] += 1;
                                    $equipos[$equipoVisitante]['puntos'] += 1;
                                    $equipos[$equipoLocal]['empatados']++;
                                    $equipos[$equipoVisitante]['empatados']++;
                                }
                            }
                        }
                        break;
                    }
                }

                // Ordenar equipos por puntos, luego por diferencia de goles (opcional)
                usort($equipos, function ($a, $b) {
                    if ($a['puntos'] === $b['puntos']) {
                        $diffA = $a['golesFavor'] - $a['golesContra'];
                        $diffB = $b['golesFavor'] - $b['golesContra'];
                        return $diffB - $diffA;
                    }
                    return $b['puntos'] - $a['puntos'];
                });

                // Generar tabla HTML
                echo '<table style="background-color: white;border-radius:12px; margin-top:10px">';
                echo '<tr>';
                echo '<th style="background-color: lightgray; border-radius: 12px 0 0 0;">Posición</th>';
                echo '<th style="background-color: lightgray;">Equipo</th>';
                echo '<th style="background-color: lightgray;">Escudo</th>';
                echo '<th style="background-color: lightgray;">Puntos</th>';
                echo '<th style="background-color: lightgray;">Ganados</th>';
                echo '<th style="background-color: lightgray;">Perdidos</th>';
                echo '<th style="background-color: lightgray;">Empatados</th>';
                echo '<th style="background-color: lightgray;">Partidos</th>';
                echo '<th style="background-color: lightgray;">Goles a Favor</th>';
                echo '<th style="background-color: lightgray; border-radius: 0 12px 0 0;">Goles en Contra</th>';
                echo '</tr>';
                $posicion = 1;
                foreach ($equipos as $equipo) {
                    echo '<tr>';
                    echo '<td>' . $posicion++ . '</td>';
                    echo '<td>' . htmlspecialchars($equipo['nombre']) . '</td>';
                    echo '<td><img src="' . htmlspecialchars($equipo['escudo']) . '" alt="' . htmlspecialchars($equipo['nombre']) . '" class="team-logo"></td>';
                    echo '<td>' . $equipo['puntos'] . '</td>';
                    echo '<td>' . $equipo['ganados'] . '</td>';
                    echo '<td>' . $equipo['perdidos'] . '</td>';
                    echo '<td>' . $equipo['empatados'] . '</td>';
                    echo '<td>' . $equipo['partidos'] . '</td>';
                    echo '<td>' . $equipo['golesFavor'] . '</td>';
                    echo '<td>' . $equipo['golesContra'] . '</td>';
                    echo '</tr>';
                }
                echo '</table>';
                echo '<br>';
                echo '<br>';
                ?>
            </div>
        </div>
    </article> <br><br><br><br>
    <div>
        <footer id="footer"></footer>
    </div>
</body>

</html>