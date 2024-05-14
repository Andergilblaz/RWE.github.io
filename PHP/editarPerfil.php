<?php
session_start();

// Verificar si el usuario está autenticado
if (!isset($_SESSION['usuario'])) {
    $alertMessage = "⚠️Inicia sesión para acceder a esta página⚠️";
    echo "<script>alert('$alertMessage'); window.location.href='../inicioDeSesion.html';</script>";
    exit();
}

// Ruta del archivo XML de usuarios
$xmlFile = "../XML/usuarios.xml";

// Función para cargar el archivo XML
function loadXML($file)
{
    $xml = simplexml_load_file($file);
    if ($xml === false) {
        die("Error al cargar el archivo XML.");
    }
    return $xml;
}

// Función para guardar el archivo XML
function saveXML($xml, $file)
{
    $result = $xml->asXML($file);
    if ($result === false) {
        die("Error al guardar el archivo XML.");
    }
}

// Función para buscar y actualizar el usuario en el XML
function updateUserData($xml, $username, $newUsername, $newPassword)
{
    foreach ($xml->cuenta as $cuenta) {
        if ($cuenta->usuario == $username) {
            $cuenta->usuario = $newUsername;
            $cuenta->contraseña = $newPassword;
            saveXML($xml, "../XML/usuarios.xml");
            return true;
        }
    }
    return false;
}

// Procesar el formulario cuando se envíe
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener datos del formulario
    $oldUsername = $_SESSION['usuario'];
    $newUsername = $_POST['newUsername'];
    $newPassword = $_POST['newPassword'];

    // Cargar el XML
    $xml = loadXML($xmlFile);

    // Actualizar los datos del usuario
    if (updateUserData($xml, $oldUsername, $newUsername, $newPassword)) {
        // Actualizar la sesión si se cambió el nombre de usuario
        $_SESSION['usuario'] = $newUsername;                   //↓Dejamos espacios ya que no se puede hacer por código↓
        $alertMessage = "Los datos se han actualizado correctamente.                                         Nuevo usuario: $newUsername y Nueva contraseña: $newPassword";
        echo "<script>alert('$alertMessage'); window.location.href='../index.html';</script>";
        exit();
    } else {
        $errorMessage = "Error: No se pudo encontrar al usuario.";
    }
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RWE - Administrador: <?php echo $_SESSION['usuario']; ?></title>
    <link rel="icon" type="image/jpg" href="Multimedia/Fotos/LogoWaterpolo.png" />
    <link rel="stylesheet" href="../estilos.css">
</head>

<body>
    <div>
        <h2>Cambiar Usuario y Contraseña del usuario: <?php echo $_SESSION['usuario']; ?></h2>
        <?php if (isset($errorMessage)): ?>
            <div style="color: red;"><?php echo $errorMessage; ?></div>
        <?php endif; ?>
        <hr><br>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <label for="newUsername">Nuevo nombre de Usuario:</label>
            <input type="text" id="newUsername" name="newUsername" required><br><br>
            <label for="newPassword">Nueva Contraseña:
                <input style="height:40px;" type="password" id="newPassword" name="newPassword" required>
                <button class="botonMostrarOcultar" type="button" onclick="togglePasswordVisibility()">🙈</button>
            </label>
            <input type="submit" value="Guardar Cambios">
        </form>
    </div>
</body>

<!-- Con la intención de evitar errores en estilos aplicamos los estilos directamente desde aquí -->
<style>
    body {
        background-color: #017ED1;
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 0;
        display: flex;
        align-items: center;
        justify-content: center;
        height: 100vh;
        
    }

    div {
        background-color: #fff;
        border-radius: 5px;
        box-shadow: 2 2 5px rgba(0, 0, 0, 1);
        padding: 20px;
        width: 500px;
        height: 450px;
    }

    h2 {
        color: #333;
        font-size: 30px;
        margin-bottom: 20px;
        text-align: center;
    }

    label {
        color: #333;
        display: block;
        font-size: 20px;
        margin-bottom: 5px;
    }

    input {
        border: 1px solid #ccc;
        border-radius: 3px;
        font-size: 20px;
        margin-bottom: 10px;
        padding: 5px;
        width: 100%;
        height: 40px;
    }

    input[type="submit"] {
        background-color: #333;
        border: 0;
        border-radius: 3px;
        color: #fff;
        cursor: pointer;
        font-size: 20px;
        padding: 10px;
        width: 100%;
        height: 50px;
    }
    

    input[type="submit"]:hover {
        background-color: #555;
    }

    .botonMostrarOcultar {
        background-color: transparent;
        border: 0;
        border-radius: 3px;
        cursor: pointer;
        font-size: 20px;
        padding: 10px;
        width: 45px;
        height: 5px;
        margin-bottom: 10px;
        float: right;
        margin-top: -4px;
        margin-left: -45px; 
        z-index: 1000;
        position: absolute;
    }
</style>

<script>
    function togglePasswordVisibility() {
        var passwordInput = document.getElementById("newPassword");
        var button = document.querySelector("button[type='button']");

        if (passwordInput.type === "password") {
            passwordInput.type = "text";
            button.textContent = "🙉";
        } else {
            passwordInput.type = "password";
            button.textContent = "🙈";
        }
    }
</script>


</html>