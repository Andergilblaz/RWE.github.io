<?php
    $temporada = isset($_GET['temporada']) ? $_GET['temporada'] : '2024';
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
        <img src="Multimedia/Fotos/Chica.png" class="chica" width="300px" style="float: left; margin-top: 130px;">
        <img src="Multimedia/Fotos/Chico.png" class="chico" width="300px" style="float: right; margin-top: 120px;">
        <div class="cuadradoInfo">
            <div class="dropdownNone" style="float:left;">
                <li class="dropdown"
                    style="list-style: none; border-radius: 12px; margin-top: 20px; margin-left: -130px; font-size: large;">
                    <div class="dropdown-content"
                        style="margin-top: -569px; margin-right: 10px; text-align: center;" width="10px">
                        <a href="./partidos.php?temporada=2023">2023</a>
                        <a href="./partidos.php?temporada=2024">2024</a>
                    </div>
                    <button id="botonTemporada" class="dropbtn"
                        style=" font-size: large; border-radius: 5px;"><?php echo $temporada; ?>↓</button>
                </li>
            </div>

            <br><br><br>
            <div id="tabla-container" class="contenedorGeneralPartidos"></div>
            <br><br>
        </div>
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