<?php
session_start(); // Inicia la sesión

// Verificar si el usuario está autenticado
if (!isset($_SESSION['usuario'])) {
    header('Location: inicioDeSesion.html');
    exit;
}

// Obtener el nombre de usuario de la sesión
$nombreUsuario = $_SESSION['usuario'];

// Cargar los datos actualizados del usuario desde el archivo XML
$xmlFileUsuarios = '../XML/usuarios.xml'; // Ruta al archivo XML de usuarios
$xml = simplexml_load_file($xmlFileUsuarios); // Cargar el archivo XML
$usuarioActualizado = null;

if ($xml) {
    foreach ($xml->cuenta as $cuenta) {
        $usuario = (string) $cuenta->usuario;

        if ($usuario === $nombreUsuario) {
            $usuarioActualizado = $cuenta;
            break;
        }
    }
} else {
    echo "Error al cargar el archivo XML.";
}

// Verificar si se encontró el usuario actualizado
if (!$usuarioActualizado) {
    echo "El usuario no fue encontrado en el archivo XML.";
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Perfil Actualizado</title>
</head>
<body>
    <h1>Perfil Actualizado</h1>
    <p>Los datos de tu perfil han sido actualizados con éxito:</p>
    <ul>
        <li><strong>Nuevo Nombre de Usuario:</strong> <?php echo $usuarioActualizado->usuario; ?></li>
        <li><strong>Nueva Contraseña:</strong> <?php echo $usuarioActualizado->contraseña; ?></li>
       
    </ul>
    <a href="../index.html">Volver a la página principal</a>
</body>
</html>
