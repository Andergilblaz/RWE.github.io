<?php
// Inicia la sesión
session_start();

// Ruta al archivo XML que contiene las cuentas de usuario
$xmlFile = 'usuarios.xml';

// Verifica si se ha enviado un formulario con datos de inicio de sesión
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtiene el usuario y la contraseña del formulario
    $usuario = $_POST['usuario'];
    $contraseña = $_POST['contraseña'];

    // Carga el archivo XML
    $xml = simplexml_load_file($xmlFile);

    if ($xml) {
        $usuarioEncontrado = false;
        $esAdministrador = false;

        // Recorre cada cuenta de usuario en el XML
        foreach ($xml->cuenta as $cuenta) {
            // Obtiene el usuario y la contraseña de la cuenta actual
            $xmlUsuario = (string)$cuenta->usuario;
            $xmlContraseña = (string)$cuenta->contraseña;

            // Verifica si el usuario y la contraseña coinciden
            if ($xmlUsuario === $usuario && $xmlContraseña === $contraseña) {
                $usuarioEncontrado = true;
                $esAdministrador = ($usuario === 'admin'); // Simulación de estado de administrador

                // Establece el estado de administrador en sessionStorage (JavaScript)
                echo '<script>sessionStorage.setItem("esAdministrador", ' . ($esAdministrador ? 'true' : 'false') . ');</script>';

                // Guarda el nombre de usuario en la sesión
                $_SESSION['usuario'] = $usuario;

                // Redirige según el resultado del inicio de sesión
                header('Location: ../administradores.php');
                exit;
            }
        }

        // Redirige si el inicio de sesión es incorrecto
        header('Location: ../inicioDeSesion.html?incorrecto=true');
        exit;
    } else {
        echo '<p>Error al cargar el archivo XML.</p>';
    }
}
?>
