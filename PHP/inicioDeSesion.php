<?php
// Inicia la sesión
session_start();

// Ruta al archivo XML que contiene las cuentas de usuario
$xmlFile = '../XML/temporadas.xml';

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
        foreach ($xml->usuarios->cuenta as $cuenta) {
            // Obtiene el usuario y la contraseña de la cuenta actual
            $xmlUsuario = (string) $cuenta->usuario;
            $xmlContraseña = (string) $cuenta->contraseña;

            // Verifica si el usuario y la contraseña coinciden
            if ($xmlUsuario === $usuario && $xmlContraseña === $contraseña) {
                $usuarioEncontrado = true;
                $esAdministrador = ($usuario === 'admin'); // Simulación de estado de administrador

                // Guarda el nombre de usuario en la sesión
                $_SESSION['usuario'] = $usuario;

                // Redirige según el resultado del inicio de sesión
                header('Location: ../index.php?admin=' . ($usuario));
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
<!-- Script JavaScript para guardar el usuario en sessionStorage -->
<script>
    // Verificamos si se pasó un usuario en la URL
    const urlParams = new URLSearchParams(window.location.search);
    const usuario = urlParams.get('admin');

    // Si se pasó un usuario en la URL, lo guardamos en sessionStorage
    if (usuario) {
        sessionStorage.setItem('usuario', usuario);
        console.log('Usuario guardado en sessionStorage:', usuario);
    }
</script>
