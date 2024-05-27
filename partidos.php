<?php
// Cargar el archivo XML
$xml = simplexml_load_file('./XML/temporadas.xml');

// Verificar si el archivo XML se cargó correctamente
if ($xml === false) {
    echo "Error al cargar el archivo XML.";
    exit;
}

// Inicializar el array de temporadas
$temporadas = [];

// Iterar sobre todas las temporadas en el archivo XML
foreach ($xml->temporadas->temporada as $temporada) {
    // Obtener el id de la temporada
    $id = (string) $temporada['id'];

    // Agregar la temporada al array de temporadas
    $temporadas[$id] = $id;
}

// Obtener el id de la temporada seleccionada
$temporada_id = isset($_GET['temporada']) ? $_GET['temporada'] : null;
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Resultados Waterpolo Español</title>
    <link rel="stylesheet" href="estilos.css">
    <link rel="icon" type="image/jpg" href="Multimedia/Fotos/LogoWaterpolo.png" />
    <script src="Scripts/scripts.js"></script>
    <script src="Scripts/partidos.js"></script>
</head>


<script>
    window.onload = function () {
        cargarTablaMenu();
        cargarFooter();
        cargarResultadosURL();
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

    function cargarResultadosURL() {
        var urlParams = new URLSearchParams(window.location.search);
        var temporadaParam = urlParams.get('temporada');
        if (temporadaParam) {
            cargarResultadosTemporada(temporadaParam);
            document.querySelector('select[name="temporada"]').value = temporadaParam;
        } else {
            // Cargar resultados por defecto si no se especifican parámetros de temporada y jornada
            cargarResultadosTemporada();
        }
    }

    function smoothScroll(offset) {
        window.scrollBy({
            top: offset,
            behavior: 'smooth'
        });
    }
</script>

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
            <form action="./partidos.php" method="GET"> <!-- Formulario para seleccionar la temporada -->
                <div class="dropdownNone" style="float:left; margin-top: 25px;margin-left:-75px;">
                    <!--Selector de Temporadas-->
                    <select name="temporada" class="dropbtn" onchange="this.form.submit()"
                        style="font-size:20px;border-radius:5px;">
                        <?php foreach ($temporadas as $id => $nombre): ?>
                            <option value="<?php echo $id; ?>" <?php if ($id == $temporada_id)
                                   echo 'selected'; ?>>
                                <?php echo $nombre; ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </form>
            <div class="dropdownNone" style="position: sticky; margin-top: 25px; float:right; margin-right:-100px;">
                <!--Botón Jornadas-->
                <select name="jornada" class="dropbtn" onchange="smoothScroll(this.value)" style="border-radius:5px;">
                    <option value="0">Jornada 1</option>
                    <option value="400">Jornada 2</option>
                    <option value="800">Jornada 3</option>
                    <option value="1100">Jornada 4</option>
                    <option value="1500">Jornada 5</option>
                    <option value="1900">Jornada 6</option>
                    <option value="2200">Jornada 7</option>
                    <option value="2600">Jornada 8</option>
                    <option value="3000">Jornada 9</option>
                    <option value="3600">Jornada 10</option>
                </select>
            </div>

            <br><br><br>
            <div id="tabla-container" class="contenedorGeneralPartidos" style="margin-top:-50px">
                <!-- Aquí se generaran los partidos -->
            </div>
            <br><br>
        </div>
        <br><br><br>
    </article>

    <div>
        <footer id="footer"></footer>
    </div>


<style>
    /* Add CSS styles for responsive layout */
    @media only screen and (max-width: 600px) {
        /* Styles for screens smaller than 600px */
        .fotospartidos {
            display: flex;
            flex-direction: column;
            align-items: center;
        }
        .chica,
        .chico {
            float: none;
            margin-top: 0;
            width: 150px; /* Adjust the width of the logos */
        }
        .cuadradoInfo {
            margin-top: 20px;
        }
        .dropdownNone {
            float: none;
            margin: 0 auto;
        }
        .contenedorGeneralPartidos {
            margin-top: 0;
        }
    }
</style>

</html>