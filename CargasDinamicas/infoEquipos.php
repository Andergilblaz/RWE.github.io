<script src="Scripts/scripts.js"></script>

<div id="seleccionarEquipo">
    <div id="seleccionador">
        <h1 style="margin-top: -100px;">Seleccione un Equipo</h1>
        <section class="imagenes">
            <?php
            // Incluye el archivo XML
            $xml = simplexml_load_file('./XML/temporadas.xml');

            // Verifica si se pudo cargar correctamente el XML
            if ($xml) {
                // Tu código para procesar el XML aquí
            } else {
                echo "Error al cargar el archivo XML";
            }

            // Coloca aquí el código para cargar y parsear el archivo XML
            $temporada = $_GET['temporada'] ?? ''; // Obtener el parámetro de temporada de la URL
            
            // Supongamos que tienes el objeto $xml con los datos del XML
            $i = 1;
            foreach ($xml->equipo as $equipo) {
                if ($equipo->temporada == $temporada) {
                    echo '<img id="e' . $i . '" src="' . $equipo->escudo . '" onclick="mostrarInfoEquipo()">';
                    $i++;
                }
            }
            ?>
        </section>

        <div class="contenedorForm"> <!--Formulario para buscar jugador por nombre-->
            <h1>Buscar Jugador por Nombre</h1>
            <hr>
            <br>
            <form id="formBuscar" action="./PHP/buscarJugador.php" method="post" class="formBuscador">
                <label for="nombre">Ingrese nombre y apellido:</label><br>
                <input type="text" id="nombre" name="nombre"><br>
                <input type="submit" value="Buscar"><br><br>
            </form>
        </div>
    </div>
</div>


<div id="infoBoadilla" class="infoEquipo"> <!--Toda la info de boadilla-->



    <div>
        <button class="btnAtras" onclick="volverSeleccionarEquipo()">←</button>
        <div style="text-align: center; margin-top: -60px;">

            <img src="Multimedia/Fotos/Escudo Equipos/cdn-boadilla.png" width="100px" style="margin-top: 25px; ">
            <h2>CDN Boadilla</h2>
        </div>
    </div>



    <div class="tablaInfoJugadores"> <!--Info Jugadores-->
        <h3>Jugadores</h3>
        <hr>

        <div style="display: flex;">
            <div class="cuadradoJugadores"> <!--Jugador 1-->
                <button onclick="cargarInfoJugador(1)" style="cursor: pointer; background-color: white; border: none;">
                    <img src="Multimedia/Fotos/Jugadores/Boadilla/RogerTahull.jpg" width="125px">
                </button>
                <p style="text-align: center;">Roger Tahull</p>
            </div>


            <div class="cuadradoJugadores"> <!--Jugador 2-->
                <button onclick="cargarInfoJugador(2)" style="cursor: pointer; background-color: white; border: none;">
                    <img src="Multimedia/Fotos/Jugadores/Boadilla/GuzmanQuispe.jpg" width="125px">
                    <p style="text-align: center;">Guzman Quispe</p>
                </button>
            </div>

            <div class="cuadradoJugadores"> <!--Jugador 3-->
                <button onclick="cargarInfoJugador(3)" style="cursor: pointer; background-color: white; border: none;">
                    <img src="Multimedia/Fotos/Jugadores/Boadilla/MarcLarumbe.jpg" width="125px">
                    <p style="text-align: center;">Marc Larumbe</p>
                </button>
            </div>

            <div class="cuadradoJugadores"> <!--Jugador 4-->
                <button onclick="cargarInfoJugador(4)" style="cursor: pointer; background-color: white; border: none;">
                    <img src="Multimedia/Fotos/Jugadores/Boadilla/FelipePerrone.jpg" width="125px">
                    <p style="text-align: center;">Felipe Perrone</p>
                </button>
            </div>

            <div class="cuadradoJugadores"> <!--Jugador 5-->
                <button onclick="cargarInfoJugador5(5)" style="cursor: pointer; background-color: white; border: none;">
                    <img src="Multimedia/Fotos/Jugadores/Boadilla/LuisSanchez.png" width="125px">
                    <p style="text-align: center;">Luis Sanchez</p>
                </button>
            </div>

            <div class="cuadradoJugadores"> <!--Jugador 6-->
                <button onclick="cargarInfoJugador(6)" style="cursor: pointer; background-color: white; border: none;">
                    <img src="Multimedia/Fotos/Jugadores/Boadilla/DanielLópez.jpg" width="125px">
                    <p style="text-align: center;">Daniel Lopez</p>
                </button>
            </div>

            <div class="cuadradoJugadores"> <!--Jugador 7-->
                <button onclick="cargarInfoJugador(7)" style="cursor: pointer; background-color: white; border: none;">
                    <img src="Multimedia/Fotos/Jugadores/Boadilla/MathewOrtega.jpg" width="125px">
                    <p style="text-align: center;">Mathew Ortega</p>
                </button>
            </div>

            <div class="cuadradoJugadores"> <!--Jugador 8-->
                <button onclick="cargarInfoJugador(8)" style="cursor: pointer; background-color: white; border: none;">
                    <img src="Multimedia/Fotos/Jugadores/Boadilla/CarlosFernandez.jpg" width="125px">
                    <p style="text-align: center;">Carlos Fernandez</p>
                </button>
            </div>

            <div class="cuadradoJugadores"> <!--Jugador 9-->
                <button onclick="cargarInfoJugador(9)" style="cursor: pointer; background-color: white; border: none;">
                    <img src="Multimedia/Fotos/Jugadores/Boadilla/MigueldeToro.jpg" width="125px">
                    <p style="text-align: center;">Miguel de Toro</p>
                </button>
            </div>

            <div class="cuadradoJugadores"> <!--Jugador 10-->
                <button onclick="cargarInfoJugador(10)" style="cursor: pointer; background-color: white; border: none;">
                    <img src="Multimedia/Fotos/Jugadores/Boadilla/FranFernández.jpg" width="125px">
                    <p style="text-align: center;">Fran Fernandez</p>
                </button>
            </div>
        </div>

    </div>


    <div class="tablaInfo"> <!--Info piscina -->

        <h3>Piscina</h3>
        <hr>

        <div class="fotoPiscina" style="padding-right:25px;"> <!--Foto Piscina-->

            <img src="Multimedia/Fotos/Piscinas/PiscinaBoadilla.jpg" width="450px" style="margin-bottom: 20px;">
            <div style="text-align: left; margin-left: 20px;">
                <p style="font-size: larger;"> <strong> Centro Deportivo M86 </strong></p>
                <p> Dimensiones: 50m x 25m </p>
                <p>Dirección: José Mtnez De Velasco, 3 - Madrid</p>
            </div>
        </div>

    </div>

    <div class="tablaInfo"> <!--Info Localidad -->

        <h3>Localidad</h3>
        <hr>

        <div class="fotoPiscina" style="padding-right:25px;"> <!--Foto Piscina-->

            <img src="Multimedia/Fotos/Ciudades/BoadillaDelMonte.jpg
                " width="450px" style="margin-bottom: 20px;">
            <div style="text-align: left; margin-left: 20px;">
                <p style="font-size: larger;"> <strong> Boadilla del Monte </strong></p>
                <p> Población: 52.626 (2018)</p>
                <p> Código postal: 28660</p>
                <p> Gentilicio: boadillano, -a​; boadillense</p>
                <p> País: España</p>
                <p> Superficie: 47,20 km²</p>
            </div>
        </div>

    </div>




</div>