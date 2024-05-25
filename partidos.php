<?php
// Ruta del archivo XML
$xmlFile = './XML/temporadas.xml';

// Cargar el archivo XML
$xml = simplexml_load_file($xmlFile) or die("Error: No se puede cargar el archivo XML");

// Extraer las temporadas
$temporadas = [];
foreach ($xml->temporada as $temporada) {
    $id = (string) $temporada['id'];
    $texto = (string) $temporada;
    $temporadas[$id] = $texto;
}

// Obtener la temporada seleccionada o la última del XML por defecto
$temporada_id = isset($_GET['temporada']) ? $_GET['temporada'] : '2024';
$temporada_texto = isset($temporadas[$temporada_id]) ? $temporadas[$temporada_id] : 'Temporada no encontrada';
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Resultados Waterpolo Español</title>
    <link rel="stylesheet" href="estilos.css">
    <link rel="icon" type="image/jpg" href="Multimedia/Fotos/LogoWaterpolo.png" />
</head>

<body>
    <div class="tablaMenu">
        <header id="tablaMenu"></header>
    </div>

    <article>
        <div class="fotospartidos">
        <img src="Multimedia/Fotos/Chica.png" class="chica" width="300px" style="float: left; margin-top: 130px;">
        <img src="Multimedia/Fotos/Chico.png" class="chico" width="300px" style="float: right; margin-top: 120px;">
        </div>
        <div class="cuadradoInfo">
            <div class="dropdownNone" style="float:left;"> <!--Botón Temporadas-->
                <li class="dropdown"
                    style="list-style: none; border-radius: 12px; margin-top: 20px; margin-left: -130px; font-size: large;">
                    <div class="dropdown-content" style="margin-top: -569px; margin-right: 10px; text-align: center;"
                        width="10px">
                        <?php foreach ($temporadas as $id => $texto): ?>
                            <a href="./partidos.php?temporada=<?php echo $id; ?>"><?php echo $id; ?></a>
                        <?php endforeach; ?>

                    </div>
                    <button id="botonTemporada" class="dropbtn"
                        style="font-size: large; border-radius: 5px;"><?php echo $temporada_texto; ?>↓</button>
                </li>
            </div>

            <div class="dropdownNone" style="float:right; margin-right:-150px"> <!--Botón Jornadas-->
                <li class="dropdown"
                    style="list-style: none; border-radius: 12px; margin-top: 20px; margin-left: -130px; font-size: large; ">
                    <div class="dropdown-content" style="margin-top: -569px; margin-right: 10px; text-align: center;"
                        width="10px">
                        <div class="button-row">
                            <button class="botonJornadas" onclick="smoothScroll(0)">1</button>
                        </div>
                        <div class="button-row">
                            <button class="botonJornadas" onclick="smoothScroll(400)">2</button>
                        </div>
                        <div class="button-row">
                            <button class="botonJornadas" onclick="smoothScroll(800)">3</button>
                        </div>
                        <div class="button-row">
                            <button class="botonJornadas" onclick="smoothScroll(1100)">4</button>
                        </div>
                        <div class="button-row">
                            <button class="botonJornadas" onclick="smoothScroll(1500)">5</button>
                        </div>
                        <div class="button-row">
                            <button class="botonJornadas" onclick="smoothScroll(1900)">6</button>
                        </div>
                        <div class="button-row">
                            <button class="botonJornadas" onclick="smoothScroll(2200)">7</button>
                        </div>
                        <div class="button-row">
                            <button class="botonJornadas" onclick="smoothScroll(2600)">8</button>
                        </div>
                        <div class="button-row">
                            <button class="botonJornadas" onclick="smoothScroll(3000)">9</button>
                        </div>
                        <div class="button-row">
                            <button class="botonJornadas" onclick="smoothScroll(3600)">10</button>
                        </div>

                        <style>
                            /*Estilos en este documento para evitar errores*/
                            .botonJornadas {
                                background-color: #324679;
                                color: white;
                                width: 100%;
                                cursor: pointer;
                                border: none;
                                font-size: large;
                                border-radius: 5px;
                            }

                            .botonJornadas:hover {
                                background-color: white;
                                color: #324679;
                                border: 1px solid #324679;
                            }
                        </style>
                        <script>
                            function smoothScroll(offset) {
                                window.scrollBy({
                                    top: offset,
                                    behavior: 'smooth'
                                });
                            }
                        </script>
                    </div>
                    <button id="botonTemporada" class="dropbtn"
                        style="font-size: large; border-radius: 5px;">Jornada↓</button>
                </li>
            </div>

            <br><br><br>
            <div id="tabla-container" class="contenedorGeneralPartidos">
                <!-- Aquí se generaran los partidos -->
            </div>
            <br><br>
        </div>
        <br><br><br>
    </article>

    <div>
        <footer id="footer"></footer>
    </div>

    <script src="Scripts/scripts.js"></script>
    <script src="Scripts/partidos.js"></script>
    <script>
        window.onload = function () {
            cargarTablaMenu();
            cargarFooter();
            cargarResultadosURL();
        };

        function cargarResultadosURL() {
            var urlParams = new URLSearchParams(window.location.search);
            var temporadaParam = urlParams.get('temporada');
            if (temporadaParam) {
                cargarResultadosTemporada(temporadaParam);
                document.getElementById('botonTemporada').textContent = temporadaParam + '↓';
            } else {
                // Cargar resultados por defecto si no se especifican parámetros de temporada y jornada
                cargarResultadosTemporada();
            }
        }
    </script>
</body>

</html>