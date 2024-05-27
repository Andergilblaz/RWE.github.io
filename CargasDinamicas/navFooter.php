<?php 
session_start(); // Inicia la sesión 
$fotoPerfil = "./Multimedia/Fotos/Usuarios/LogoWaterpoloAdmin.png"; 

?>

  <head>
    <script src="Scripts/scripts.js"></script> <!-- Incluye el archivo JavaScript -->
  </head>
  <div id="tablaMenu"> <!--TablaMenu-->
    <header>


      <ul class="tablaMenu" style="color: white;">

        <li><a href="./index.php"><img src="Multimedia/Fotos/LogoWaterpolo.png" width="70px"></a></li>
        <li class="button"><a href="./index.php">Inicio</a></li>
        <li class="button"><a href="./partidos.php?temporada=2024">Temporadas</a></li>
        <li class="button"><a href="./clasificacion.php?temporada=2024">Clasificación</a></li>
        <li class="button"><a href="./noticias.html">Noticias</a></li>
        <li class="button"><a href="./resumenes.html">Resúmenes</a></li>
        <li class="button"><a href="./contacto.html">Contacto Web</a></li>


        <!-- Si no has iniciado sesión -->
        <div class="menuUsuario" id="menuUsuario">
          <button class="menuUsuario-boton" style="vertical-align: center;"><img id="imagenPerfil"
              src="./Multimedia/Fotos/Usuarios/sinImagen.jpg" width="40px"
              style="border-radius: 50%; margin-top: 5px;"></button>
          <div class="menuUsuario-contenido" style="margin-top: -10px;">
            <img src="./Multimedia/Fotos/Usuarios/sinImagen.jpg" alt="Imagen usuario hover" width="75px">
            <p style="color: black; text-align: center; font-size: larger;">¡Bienvenido! </p>
            <p style="color: rgb(56, 56, 56); text-align: center; margin-top: -15px;">Por favor, Inicia sesión</p>
            <a href="./inicioDeSesion.html">Iniciar Sesión</a>
          </div>
        </div>

        <!-- Si ha iniciado sesión -->

        <div class="menuUsuario" id="menuAdmin">
          <button class="menuUsuario-boton" style="vertical-align: center;">
            <img id="imagenPerfil" src="<?php echo $fotoPerfil; ?>" width="40px"
              style="border-radius: 50%; margin-top: 5px;"></button>
          <div class="menuUsuario-contenido">
            <img src="<?php echo $fotoPerfil; ?>" alt="Imagen usuario hover" width="75px">
            <p id="nombreUsuario" style="color: black; text-align: center; font-size: larger;">¡Bienvenido
              <?php echo $_SESSION['usuario']; ?>!
            </p>

            <a href="./administradores.php" style="margin-bottom: 10px;">Administrar</a>
            <button style="margin-right: 10px;" onclick=" window.location.href = './PHP/editarPerfil.php';">Editar
              perfil</button>
            <button class="botonesMenuAdmin" onclick="cerrarSesion()">Cerrar sesión</button>
          </div>
        </div>

        

        <!-- Menu responsive -->
        <div class="menuResponsive">
          <li class="dropdown">
            <div class="dropdown-content">
              <a href="./index.php">Inicio</a>
              <a href="./partidos.php?temporada=2024">Temporadas</a>
              <a href="./clasificacion.php?temporada=2024">Clasificación</a>
              <a href="./noticias.html">Noticias</a>
              <a href="./resumenes.html">Resúmenes</a>
              <a href="./contacto.html">Contacto Web</a>
            </div>
            <button class="dropbtn">Menu ↓</button>
          </li>
        </div>
      </ul>




    </header>
  </div>

  <div id="footer"> <!--footer-->
    <footer class="footer">
      <!-- Teléfono de contacto, Redes Sociales, Ubicación, Descarga de la app -->
      Teléfono contacto☎️: +34 566 34 21 78 &nbsp; &nbsp; &nbsp;
      Ubicación📌: World Trade Center, Floor 77, 110901 NY City &nbsp;&nbsp;&nbsp;
    </footer>
  </div>
  