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
            // Jugador encontrado, obtener la información del jugador
            $jugadorEncontrado = true;
            $nombreCompleto = $jugador->nombre . ' ' . $jugador->apellidos;
            $fechaNacimiento = $jugador->fechaNacimiento;
            $nacionalidad = $jugador->nacionalidad;
            $posicion = $jugador->posicion;
            $dorsal = $jugador->dorsal;
            $foto = $jugador->foto;

            // Mostrar la información del jugador
            echo "<h2>Información del Jugador</h2>";
            echo "<img src='" . htmlspecialchars($foto) . "' alt='Foto del jugador' style='width: 100px;'><br>";
            echo "<p>Nombre: " . htmlspecialchars($nombreCompleto) . "</p>";
            echo "<p>Fecha de Nacimiento: " . htmlspecialchars($fechaNacimiento) . "</p>";
            echo "<p>Nacionalidad: " . htmlspecialchars($nacionalidad) . "</p>";
            echo "<p>Posición: " . htmlspecialchars($posicion) . "</p>";
            echo "<p>Dorsal: " . htmlspecialchars($dorsal) . "</p>";

            // Terminar el script después de mostrar la información del jugador
            exit();
        }
    }

    // Si el jugador no se encuentra, asignar un mensaje de error
    if (!$jugadorEncontrado) {
        $mensaje = 'Error: No se ha encontrado ningún jugador con ese nombre.';
    }
} else {
    // Si no se proporciona el nombre del jugador, asignar un mensaje de error
    $mensaje = 'Error: No se proporcionó el nombre del jugador.';
}

// Mostrar el mensaje de error
echo $mensaje;

// Redirigir a la página de inicio después de 5 segundos
header("Refresh: 5; url=index.php");
exit();
?>
