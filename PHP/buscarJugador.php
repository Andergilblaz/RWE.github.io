<?php
// Cargar el contenido del archivo XML
$xml = simplexml_load_file('../XML/idJugador.xml');

// Inicializar la variable para almacenar el mensaje
$mensaje = 'Error: No se ha encontrado ningún jugador con ese nombre.';

// Verificar si se ha enviado el formulario y se ha proporcionado el nombre del jugador
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['nombre'])) {
    // Obtener el nombre del jugador enviado por el formulario
    $nombreJugador = $_POST['nombre'];

    // Bandera para indicar si se encontró el jugador
    $jugadorEncontrado = false;

    // Buscar el jugador en el XML por su nombre
    foreach ($xml->jugador as $jugador) {
        if (strcasecmp($jugador->nombre, $nombreJugador) == 0) {
            // Obtener la URL de la página del jugador
            $paginaJugador = $jugador->pagina;

            // Redirigir a la página del jugador
            header("Location: $paginaJugador");
            exit(); // Terminar el script después de redirigir
        }
    }

    // Si el jugador no se encuentra, asignar un mensaje de error
    $mensaje = 'Error: No se ha encontrado ningún jugador con ese nombre.';
    // Mostrar el mensaje de error
    echo $mensaje;
    // Redirigir a la página de inicio
    header("Refresh: 5; url=index.php");
    exit();
} else {
    // Si no se proporciona el nombre del jugador, asignar un mensaje de error
    $mensaje = 'Error: No se proporcionó el nombre del jugador.';
    // Mostrar el mensaje de error
    echo $mensaje;
    // Redirigir a la página de inicio
    header("Refresh: 5; url=index.php");
    exit();
}
?>