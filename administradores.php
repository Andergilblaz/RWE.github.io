<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Resultados Waterpolo Español</title>
    <link rel="stylesheet" href="estilos.css">
    <link rel="icon" type="image/jpg" href="Multimedia/Fotos/LogoWaterpolo.png" />
    <script src="Scripts/scripts.js"></script>
</head>

<script>
    window.onload = function () {
        cargarTablaMenu();
    };
</script>

<body>

    <div class="tablaMenu">
        <header id="tablaMenu"> <!-- Aquí se cargará el menú dinámico --></header>
    </div>

    <img src="Multimedia/Fotos/Chica.png" class="chica" width="250px" style="float: left; margin-top: 130px;">
    <img src="Multimedia/Fotos/Chico.png" class="chico" width="250px" style="float: right; margin-top: 120px;">




    <article class="cuadradoInfo">
        <div class="contacto"> <!-- Cuadrado de mensajes recibidos-->
            <?php
            session_start(); // Inicia la sesión
            
            // Luego puedes acceder a $_SESSION['usuario']
            if (isset($_SESSION['usuario'])) {
                $usuario = $_SESSION['usuario'];
                echo "<h2>¡Bienvenido $usuario!</h2>";
            } else {
                echo "<h2>¡Bienvenido!</h2>";
            }
            ?>

            <p>En esta sección podrás leer los mensajes y gestionar cuentas de administradores.</p>
            <hr>
            <img src="Multimedia/Fotos/LogoWaterpolo.png" alt="Logotipo" width="100px"
                style="float: right; margin-top:-120px; margin-right: 10px;">

            <!-- Aquí se mostrarán los datos de los mensajes -->
            <div class="recibidos"> <!--Zona de mensajes-->
                <?php


                $xmlFile = 'PHP-XML-XSL-XSD/contacto.xml';

                // Verificar si el archivo XML ha sido modificado desde la última carga
                $lastModifiedTime = isset($_SESSION['lastModifiedTime']) ? $_SESSION['lastModifiedTime'] : 0;
                clearstatcache();
                $fileModifiedTime = filemtime($xmlFile);

                if ($fileModifiedTime > $lastModifiedTime || !isset($_SESSION['xml'])) {
                    // El archivo XML ha sido modificado o no está cargado en la sesión, cargar el nuevo XML
                    $xml = simplexml_load_file($xmlFile);

                    if ($xml) {
                        // Convertir el objeto SimpleXMLElement a un array para serialización
                        $xmlArray = json_decode(json_encode($xml), true);

                        $_SESSION['xml'] = $xmlArray;
                        $_SESSION['lastModifiedTime'] = $fileModifiedTime;
                        $_SESSION['numeroregistros'] = count($xmlArray['envio']);
                        $_SESSION['posicion'] = 0;
                    }
                }

                // Obtener el envío actual basado en la posición almacenada en la sesión
                $envio = isset($_SESSION['xml'], $_SESSION['xml']['envio'][$_SESSION['posicion']]) ? $_SESSION['xml']['envio'][$_SESSION['posicion']] : null;

                // Procesar la navegación mediante formularios y botones
                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    if (isset($_POST['leido']) && $_POST['leido'] === 'marcar como leido') {
                        $posicion = $_SESSION['posicion'];

                        if ($posicion >= 0 && $posicion < $_SESSION['numeroregistros']) {
                            // Eliminar el mensaje del XML
                            $xml = simplexml_load_file($xmlFile);
                            unset($xml->envio[$posicion]);
                            $xml->asXML($xmlFile);

                            // Recargar la sesión con el XML actualizado
                            $xmlArray = json_decode(json_encode($xml), true);
                            $_SESSION['xml'] = $xmlArray;
                            $_SESSION['numeroregistros'] = count($xmlArray['envio']);

                            // Ajustar la posición si es necesario
                            if ($posicion === $_SESSION['numeroregistros']) {
                                $_SESSION['posicion']--;
                            }

                            // Redirigir a la misma página después de marcar como leído para reflejar el cambio
                            header('Location: ' . $_SERVER['PHP_SELF']);
                            exit;
                        }
                    }


                    if (isset($_POST['direccion'])) {
                        $direccion = $_POST['direccion'];

                        if (isset($_SESSION['posicion']) && isset($_SESSION['numeroregistros'])) {
                            switch ($direccion) {
                                case 'primero':
                                    $_SESSION['posicion'] = 0; /*Posición 0 es el 1*/
                                    break;
                                case 'anterior':
                                    if ($_SESSION['posicion'] > 0) {
                                        $_SESSION['posicion']--;
                                    }
                                    break;
                                case 'siguiente':
                                    if ($_SESSION['posicion'] < $_SESSION['numeroregistros'] - 1) {
                                        $_SESSION['posicion']++;
                                    }
                                    break;
                                case 'ultimo':
                                    $_SESSION['posicion'] = $_SESSION['numeroregistros'] - 1;
                                    break;
                                default:
                                    break;
                            }
                        }

                        // Redirigir a la misma página después de procesar el formulario para reflejar el cambio
                        header('Location: ' . $_SERVER['PHP_SELF']);
                        exit;
                    }
                }
                ?>

                    <?php if (!empty($envio) && is_array($envio)): ?>
                        <h2>Mensajes recibidos</h2>
                        <hr>
                        <p style="color:Black; font-size:25px"> <strong> Mensaje número <?php echo $_SESSION['posicion'] + 1; ?>
                                de
                                <?php echo $_SESSION['numeroregistros']; ?>
                            </strong>
                        </p>
                        <p><strong style="color:Black;">Nombre:</strong>
                            <?php echo isset($envio['nombre']) ? $envio['nombre'] : 'N/A'; ?></p>
                        <p><strong style="color:Black;">Apellidos:</strong>
                            <?php echo isset($envio['apellidos']) ? $envio['apellidos'] : 'N/A'; ?></p>
                        <p><strong style="color:Black;">Correo:</strong>
                            <?php echo isset($envio['correo']) ? $envio['correo'] : 'N/A'; ?></p>
                        <p><strong style="color:Black;">Mensaje:</strong>
                            <?php echo isset($envio['mensaje']) ? $envio['mensaje'] : 'N/A'; ?></p>

                        <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                            <input type="hidden" name="leido" value="marcar como leido">
                            <button style="margin-left:-3px;" class="botonMensajes" type="submit">Marcar como leído</button>
                        </form>

                    <?php else: ?>

                        <?php if ($_SESSION['posicion'] < 0 || $_SESSION['posicion'] >= $_SESSION['numeroregistros']): ?>
                            <p>No hay más mensajes para leer.</p>
                        <?php else: ?>
                            <p>Error al cargar los mensajes.</p>
                        <?php endif; ?>

                    <?php endif; ?>

                <div class="botonMensajesContainer">
                    <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                        <input type="hidden" name="direccion" value="primero">
                        <button class="botonMensajes" type="submit">← ←</button>
                    </form>
                    <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                        <input type="hidden" name="direccion" value="anterior">
                        <button class="botonMensajes" type="submit">←</button>
                    </form>
                    <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                        <input type="hidden" name="direccion" value="siguiente">
                        <button class="botonMensajes" type="submit">→</button>
                    </form>
                    <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                        <input type="hidden" name="direccion" value="ultimo">
                        <button class="botonMensajes" type="submit">→ →</button>
                    </form>
                </div>
                <br><br>
            </div>
        </div>

        <article>
            <?php
            // Función para cargar los datos de usuarios desde el archivo XML
            function cargarUsuarios($xmlFile)
            {
                $usuarios = [];

                // Verificar si el archivo XML existe
                if (file_exists($xmlFile)) {
                    $xml = simplexml_load_file($xmlFile);

                    if ($xml) {
                        foreach ($xml->cuenta as $cuenta) {
                            $usuario = (string) $cuenta->usuario;
                            $contrasena = (string) $cuenta->contraseña;
                            $usuarios[] = ['usuario' => $usuario, 'contraseña' => $contrasena];
                        }
                    } else {
                        echo "Error al cargar el archivo XML.";
                    }
                } else {
                    echo "El archivo XML de usuarios no existe.";
                }

                return $usuarios;
            }

            // Ruta al archivo XML de usuarios
            $xmlFileUsuarios = 'PHP-XML-XSL-XSD/usuarios.xml';

            // Procesar el formulario para agregar usuarios
            if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['agregar_usuario'])) {
                $nuevoUsuario = $_POST['nuevo_usuario'];
                $nuevaContrasena = $_POST['nueva_contrasena'];

                // Verificar si el archivo XML existe antes de intentar cargarlo
                if (file_exists($xmlFileUsuarios)) {
                    $xml = simplexml_load_file($xmlFileUsuarios);

                    if ($xml) {
                        // Agregar el nuevo usuario al archivo XML
                        $nuevoCuenta = $xml->addChild('cuenta');
                        $nuevoCuenta->addChild('usuario', $nuevoUsuario);
                        $nuevoCuenta->addChild('contraseña', $nuevaContrasena);

                        // Guardar el archivo XML modificado
                        $xml->asXML($xmlFileUsuarios);

                        // Recargar la lista de usuarios
                        $usuarios = cargarUsuarios($xmlFileUsuarios);
                    } else {
                        echo "Error al cargar el archivo XML.";
                    }
                } else {
                    echo "El archivo XML de usuarios no existe.";
                }
            }

            // Procesar el formulario para eliminar usuarios
            if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['eliminar_usuario'])) {
                $usuarioEliminar = $_POST['usuario_eliminar'];

                // Verificar si el archivo XML existe antes de intentar cargarlo
                if (file_exists($xmlFileUsuarios)) {
                    $xml = simplexml_load_file($xmlFileUsuarios);

                    if ($xml) {
                        // Eliminar el usuario del archivo XML
                        foreach ($xml->cuenta as $cuenta) {
                            if ((string) $cuenta->usuario === $usuarioEliminar) {
                                unset($cuenta[0]);
                                break;
                            }
                        }

                        // Guardar el archivo XML modificado
                        $xml->asXML($xmlFileUsuarios);

                        // Recargar la lista de usuarios
                        $usuarios = cargarUsuarios($xmlFileUsuarios);
                    } else {
                        echo "Error al cargar el archivo XML.";
                    }
                } else {
                    echo "El archivo XML de usuarios no existe.";
                }
            }

            // Cargar la lista de usuarios desde el archivo XML
            $usuarios = cargarUsuarios($xmlFileUsuarios);
            ?>

            <!DOCTYPE html>
            <html lang="es">

            <head>
                <meta charset="UTF-8">
                <title>Gestión de Usuarios</title>
                <link rel="stylesheet" href="estilos.css">
            </head>

            <body>

                <article class="gestionUsuariosContainer">
                    <h2>Gestión de usuarios</h2>
                    <hr>

                    <!-- Formulario para agregar un nuevo usuario -->
                    <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                        <label for="nuevo_usuario">Nuevo Usuario:</label>
                        <input type="text" id="nuevo_usuario" name="nuevo_usuario" required>
                        <label for="nueva_contrasena">Contraseña:</label>
                        <input type="password" id="nueva_contrasena" name="nueva_contrasena" required>
                        <button type="submit" name="agregar_usuario">Agregar Usuario</button>
                    </form>
                    <br>

                    <!-- Tabla de usuarios -->
                    <table border="1">
                        <thead>
                            <tr>
                                <th>Usuario</th>
                                <th>Contraseña</th>
                                <th>Acción</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($usuarios as $usuario): ?>
                                <tr>
                                    <td><?php echo $usuario['usuario']; ?></td>
                                    <td><?php echo $usuario['contraseña']; ?></td>
                                    <td>
                                        <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                                            <input type="hidden" name="usuario_eliminar"
                                                value="<?php echo $usuario['usuario']; ?>">
                                            <button type="submit" name="eliminar_usuario">Eliminar</button>
                                        </form>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </article>

            </body>

            </html>



        </article>

</body>

</html>