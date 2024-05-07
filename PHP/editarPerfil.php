<?php
session_start(); // Inicia la sesión

// Función para cargar los datos de usuarios desde el archivo XML
function cargarUsuario($xmlFile, $nombreUsuario)
{
    $xml = simplexml_load_file($xmlFile); // Cargamos el archivo XML

    if ($xml) {
        foreach ($xml->cuenta as $cuenta) {
            $usuarioXML = (string) $cuenta->usuario;

            if ($usuarioXML === $nombreUsuario) {
                return $cuenta; // Devolvemos el nodo XML del usuario encontrado
            }
        }
    } else {
        echo "Error al cargar el archivo XML.";
    }

    return null; // Retorna null si no se encontró el usuario
}

// Utiliza el nombre del usuario almacenado en la sesión para buscar el nodo XML del usuario correspondiente en el archivo XML
$nombreUsuario = isset($_SESSION['usuario']) ? $_SESSION['usuario'] : null;

if ($nombreUsuario) {
    $xmlFileUsuarios = '../XML/usuarios.xml'; // Ruta al archivo XML de usuarios
    $usuario = cargarUsuario($xmlFileUsuarios, $nombreUsuario); // Cargamos el usuario desde el XML

    if ($usuario) {
        // Si se envió el formulario, actualizar los datos del perfil
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Obtener los datos del formulario
            $nuevoNombre = trim($_POST['nuevo_nombre']); // Eliminar espacios en blanco
            $nuevaContrasena = $_POST['nueva_contrasena'];

            // Validar que la contraseña no esté vacía
            if (empty($nuevaContrasena)) {
                echo "Error: La contraseña no puede estar vacía.";
                exit;
            }

            // Actualizar los datos del usuario en el XML
            $usuario->usuario = $nuevoNombre;
            $usuario->contraseña = password_hash($nuevaContrasena, PASSWORD_DEFAULT); // Encriptar la contraseña

            // Guardar los cambios en el archivo XML
            $xml = simplexml_load_file($xmlFileUsuarios);

            if ($xml) {
                // No es necesario modificar el XML cargado, ya que se modificó directamente el nodo $usuario
                $xml->asXML($xmlFileUsuarios); // Guardar los cambios en el archivo XML
                header('Location: success.php');
                exit;
            } else {
                echo "Error al cargar el archivo XML.";
            }
        }
    } else {
        echo "El usuario no fue encontrado en el archivo XML.";
    }
} else {
    echo "No hay usuario almacenado en la sesión.";
}
?>
<!DOCTYPE html>
<html>

<head>
    <title>Editar Perfil</title>
</head>

<body>
    <h1>Editar el perfil de <?php echo $nombreUsuario; ?></h1>
    <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <label for="nuevo_nombre">Nuevo nombre:</label>
        <input type="text" id="nuevo_nombre" name="nuevo_nombre" required>
        <label for="nueva_contrasena">Nueva Contraseña:</label>
        <input type="password" id="nueva_contrasena" name="nueva_contrasena" required>
        <button type="submit" name="actualizar_perfil">Actualizar Perfil</button>
    </form>
</body>

</html>
