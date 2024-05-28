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
        cargarPP1();
        cargarPP2();
        cargarFooter();
        cargarNoticias();

        // Detectar la escala de la pantalla y ajustar el zoom para la correcta visualización
        var scale = window.devicePixelRatio * 100;
        var zoomLevel = 1.0;

        if (scale === 100) {
            zoomLevel = 1.25;
        } else if (scale === 125) {
            zoomLevel = 1.0;
        }

        document.body.style.zoom = zoomLevel;

        // Detectar si el navegador es Firefox
        if (navigator.userAgent.indexOf('Firefox') > -1) {
            // Cambiar la propiedad 'position' del texto a 'static'
            var textoScroll = document.getElementById('textoScroll');
            if (textoScroll) {
                textoScroll.style.position = 'static';
            }
            var txtFirefox = document.getElementById('txtFirefox');
            if (txtFirefox) {
                txtFirefox.style.display = 'block';
            }
        } else {
            var textoScroll = document.getElementById('textoScroll');
            if (textoScroll) {
                textoScroll.style.position = 'static';
            }
            var txtFirefox = document.getElementById('txtFirefox');
            if (txtFirefox) {
                txtFirefox.style.display = 'none';
            }
        }
    }
</script>



<body>

    <div class="tablaMenu"> <!--tablaMenu-->
        <!-- Aqui se mostrara la tablaMenu -->
        <div class="admin">
            <!-- Aquí se mostrara la ventana login -->
        </div>
        <header id="tablaMenu"> </header>
    </div>

    <article> <!--CuadradoInfo-->
        <img src="Multimedia/Fotos/Chica.png" class="chica" width="300px" style="float: left; margin-top: 130px;">
        <img src="Multimedia/Fotos/Chico.png" class="chico" width="300px" style="float: right; margin-top: 100px;">
        <div class="cuadradoInfo" style="height: <?php echo (isset($_SERVER['HTTP_USER_AGENT']) && strpos($_SERVER['HTTP_USER_AGENT'], 'Mobile') !== false) ? '3700px' : '2350px'; ?>"> <!-- Inicio del div del cuadrado -->


            <div id="textoScroll"> <!--textoScroll-->
                <section>
                    <div class="textoScrollResponsiveNO">
                        <h1 class="scrollh1">
                            <span style="height: 35px; align-items: center;">Bienvenid@ a la web oficial de los </span>
                            <span style="height: 200px;;">Resultados Waterpolo
                                <br>
                                Español
                                <br>
                                <button class="btnScroll" id="btnScroll"
                                    style="margin-left: -50px; margin-top: 20px;"><img
                                        src="Multimedia/Fotos/arrow-1455_256.gif" width="100px"></button>
                            </span>
                        </h1>
                    </div>

                    <!--Texto para firefox-->

                    <div style="margin-top:-900px" id="txtFirefox"> 
                        <h1 class="scrollh1Firefox">
                            <p><span style="height: 35px; align-items: center; font-size:25px">Bienvenid@ a la web
                                    oficial de los
                                </span></p>
                            <span style="height: 200px;color: black; font-size: 70px;">Resultados Waterpolo
                                <br>
                                Español
                                <br>
                                <button class="btnScroll" id="btnScroll" style="margin-left: -50px;"><img
                                        src="Multimedia/Fotos/arrow-1455_256.gif" width="100px"></button>
                            </span>
                        </h1>
                    </div>

                    <div class="textoScrollResponsiveSI">

                        <h1 class="h1ScrollResponsive">Resultados del waterpolo español</h1>

                    </div>
                </section>

                <div class="ppc"> <!--proximosPartidos-->

                    <div style="margin-left: 2%; margin-bottom: -25px;">
                        <article class="ppcResponsive">

                            <h2> Próximos Partidos </h2>
                            <hr>

                            <div id="proximoPartido1">
                                <!-- Aqui iran los proximos partidos -->
                            </div>

                        </article>
                    </div>

                    <style>
                        /* Estilo para pantallas de tamaño normal */
                        #tablaClasificacion {
                            margin-left: 40px;
                            margin-top: 77px;
                        }
                    
                        /* Estilo para pantallas de tamaño móvil (menos de 600px de ancho) */
                        @media screen and (max-width: 600px) {
                            #tablaClasificacion {
                                margin-left: 5px;
                            }
                           
                        }

                    </style>
                    
                    <!-- El texto de Clasificación esta en el doc tablaClasificacion por motivos de estilos -->
                    <div id="tablaClasificacion"> <!--tablaClasificación-->
                        <!-- Aqui se mostrara la clasificación -->
                    </div>


                </div>




            </div>

            <!-- Noticias destacadas -->
            <section>
                <h3 class="scrollh3" style="font-style: underline;">Noticias Destacadas</h3>
                <hr>
                <div id="noticias" class="noticias" style="display: flex; flex-direction: column; align-items: center;"></div>
                    <!-- Aqui iran las noticias -->
                </div>
            </section> <br>

        </div> <!-- Fin del div del cuadrado -->
    </article>
    <br><br><br><br> <!--Espacios para que haya hueco hasta el footer-->
    <div> <!--footer-->
        <!-- Aqui se mostrara el footer -->
        <footer id="footer"> </footer>
    </div>
</body>


<script>
    // Función para obtener el parámetro de la URL
    function obtenerParametroURL(nombre) {
        const urlParams = new URLSearchParams(window.location.search);
        return urlParams.get(nombre);
    }

    // Obtenemos el usuario de la URL
    const usuario = obtenerParametroURL('admin');

    // Si se encontró un usuario en la URL, lo guardamos en sessionStorage
    if (usuario) {
        sessionStorage.setItem('usuario', usuario);
        console.log('Usuario guardado en sessionStorage:', usuario);
    }
</script>



</html>