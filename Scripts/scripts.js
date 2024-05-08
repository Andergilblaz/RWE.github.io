
function cargarTablaMenu() {

    fetch('CargasDinamicas/navFooter.php')
        .then(response => response.text())
        .then(data => {
            const parser = new DOMParser();
            const htmlDocument = parser.parseFromString(data, 'text/html');

            // Verificar si hay un administrador en el sessionStorage
            const usuario = sessionStorage.getItem('usuario');
            const menuUsuario = htmlDocument.getElementById('menuUsuario');

            // Verificar si hay un administrador en el sessionStorage
            if (usuario !== null) {
                const menuAdmin = htmlDocument.getElementById('menuAdmin');
                menuAdmin.style.display = 'block'; // Mostrar el menú de administrador
                menuUsuario.style.display = 'none'; // Ocultar el menú de inicio de sesión
                document.getElementById('tablaMenu').innerHTML = htmlDocument.getElementById('tablaMenu').innerHTML;
                
                
            } else {
                const menuAdmin = htmlDocument.getElementById('menuAdmin');
                menuAdmin.style.display = 'none'; // Mostrar el menú de administrador
                menuUsuario.style.display = 'block'; // Mostrar el menú de inicio de sesión
                document.getElementById('tablaMenu').innerHTML = htmlDocument.getElementById('tablaMenu').innerHTML;

            }

        });
}


function cargarFooter() { //Funcion cargar Footer
    fetch('CargasDinamicas/navFooter.php') //Busca dentro del archivo articulos.html
        .then(response => response.text())
        .then(data => {
            const parser = new DOMParser();
            const htmlDocument = parser.parseFromString(data, 'text/html');

            const footer = htmlDocument.getElementById('footer').innerHTML; //Le pones el id que quieras coger
            document.getElementById('footer').innerHTML = footer; //Pone el contenido donde debe
        });
}



function cargarNoticias() { //Funcion cargar Footer
    fetch('CargasDinamicas/noticias.html') //Busca dentro del archivo articulos.html
        .then(response => response.text())
        .then(data => {
            const parser = new DOMParser();
            const htmlDocument = parser.parseFromString(data, 'text/html');
            const noticias = htmlDocument.getElementById('noticias').innerHTML; //Le pones el id que quieras coger
            document.getElementById('noticias').innerHTML = noticias; //Pone el contenido donde debe
        });
}

function cargarPP() {
    let partidoIndex = 1; // Índice del primer partido a cargar

    // Función para cargar el próximo partido
    const cargarProximoPartido = () => {
        fetch('CargasDinamicas/proximosPartidos.html') // Busca el archivo de partidos
            .then(response => response.text())
            .then(data => {
                const parser = new DOMParser();
                const htmlDocument = parser.parseFromString(data, 'text/html');
                const proximoPartidoContainer = document.getElementById('proximoPartido1');

                // Obtener el contenido del próximo partido basado en el índice
                const proximoPartidoContent = htmlDocument.getElementById(`proximoPartido${partidoIndex}`).innerHTML;

                // Reemplazar el contenido del contenedor actual con el próximo partido
                proximoPartidoContainer.innerHTML = proximoPartidoContent;

                // Incrementar el índice del partido para cargar el siguiente en la próxima iteración
                partidoIndex++;

                // Obtener el número total de partidos disponibles (ajusta esto según tu estructura)
                const totalPartidos = 2; // Por ejemplo, si tienes proximoPartido1, proximoPartido2, proximoPartido3

                // Si llegamos al final de los partidos, reiniciar al primero
                if (partidoIndex > totalPartidos) {
                    partidoIndex = 1; // Reiniciar al primer partido
                }
            })
            .catch(error => console.error('Error al cargar el próximo partido:', error));
    };

    // Llamar a cargarProximoPartido inicialmente
    cargarProximoPartido();

    // Establecer un intervalo para cargar el próximo partido cada 5 segundos
    setInterval(cargarProximoPartido, 5000); // Cargar el próximo partido cada 5 segundos (5000 milisegundos)
}

function cargarTablaClasificacionPreview() {
    fetch('CargasDinamicas/tablaClasificacion.html')
        .then(response => response.text())
        .then(data => {
            const parser = new DOMParser();
            const htmlDocument = parser.parseFromString(data, 'text/html');
            const tablaClasificacionPreview = htmlDocument.getElementById('tablaClasificacionPreview').innerHTML; //Le pones el id que quieras coger
            document.getElementById('tablaClasificacionPreview').innerHTML = tablaClasificacion; //Pone el contenido donde debe
        });
}

function cargarTablaClasificacion() {
    fetch('CargasDinamicas/tablaClasificacion.html')
        .then(response => response.text())
        .then(data => {
            const parser = new DOMParser();
            const htmlDocument = parser.parseFromString(data, 'text/html');
            const tablaClasificacion = htmlDocument.getElementById('tablaClasificacion').innerHTML; //Le pones el id que quieras coger
            document.getElementById('tablaClasificacion').innerHTML = tablaClasificacion; //Pone el contenido donde debe
        });
}


// Función para cargar y mostrar el contenido del equipo a seleccionar
function cargarSeleccionarEquipo() {
    fetch('CargasDinamicas/infoEquipos.html')
        .then(response => response.text())
        .then(data => {
            const parser = new DOMParser();
            const htmlDocument = parser.parseFromString(data, 'text/html');
            const seleccionarEquipo = htmlDocument.getElementById('seleccionarEquipo').innerHTML;
            document.getElementById('seleccionarEquipo').innerHTML = seleccionarEquipo;
        });
}

function cargarInfoBoadilla() {
    // Ocultar el botón antes de cargar la información del equipo
    document.getElementById('botonTemporada').style.display = 'none';

    fetch('CargasDinamicas/infoEquipos.html')
        .then(response => response.text())
        .then(data => {
            document.getElementById('infoEquipo').style.display = 'block';
            const parser = new DOMParser();
            const htmlDocument = parser.parseFromString(data, 'text/html');
            
            // Extraer el contenido del div con id 'infoBoadilla' del documento analizado
            const infoBoadillaContent = htmlDocument.getElementById('infoBoadilla');

            // Verificar si se encontró el elemento
            if (infoBoadillaContent) {
                // Obtener el contenido interno del div 'infoBoadilla'
                const innerHTMLContent = infoBoadillaContent.innerHTML;

                // Asignar el contenido extraído al elemento deseado en tu página
                document.getElementById('infoEquipo').innerHTML = innerHTMLContent;
            } else {
                console.error("No se encontró el elemento 'infoBoadilla' en el documento HTML cargado.");
            }
        })
        .catch(error => {
            console.error("Error al cargar y procesar el documento HTML:", error);
        });
}


function cargarPartidosJ1() {
    fetch('CargasDinamicas/infoPartidos.html')
        .then(response => response.text())
        .then(data => {
            const parser = new DOMParser();
            const htmlDocument = parser.parseFromString(data, 'text/html');

            const partidosJ1 = htmlDocument.getElementById('jornada1').innerHTML; // Obtener el contenido de Jornada1
            document.getElementById('partidos').innerHTML = partidosJ1; // Asignar el contenido a 'partidosJ1'
        })
        .catch(error => {
            console.error("Error al cargar y procesar el documento HTML:", error);
        });
}



// Función para ocultar el contenido actual y mostrar el equipo Boadilla
function mostrarInfoEquipo() {
    // Ocultar el contenido actual
    document.getElementById('seleccionador').style.display = 'none';
    document.getElementById('chica').style.display = 'none';
    document.getElementById('chico').style.display = 'none';
    document.getElementById('infoJugadores').style.display = 'none';

    // Mostrar el contenido del equipo Boadilla
    cargarInfoBoadilla();
}

// Función para ocultar el contenido actual y mostrar el equipo Boadilla
function volverSeleccionarEquipo() {
    // Ocultar el contenido actual
    document.getElementById('infoEquipo').style.display = 'none';
    document.getElementById('chica').style.display = 'block';
    document.getElementById('chico').style.display = 'block';
    // Mostrar el contenido del equipo Boadilla
    cargarSeleccionarEquipo();
}

function cargarInfoJugador(numeroJugador) {
    // Obtener la URL base (sin parámetros)
    const baseUrl = window.location.href.split('?')[0];
    // Redirigir a la página infoJugadores.html con el parámetro 'jugador'
    window.location.href = baseUrl.replace('equipos.html', 'infoJugadores.html') + '#' + numeroJugador;
}


function editarPerfil() {
    // Aquí puedes agregar el código JavaScript para la funcionalidad de editar perfil
    alert("Funcionalidad de editar perfil en proceso...");
}

function cerrarSesion() {
    // Aquí puedes agregar el código JavaScript para la funcionalidad de cerrar sesión
    alert("Funcionalidad de cerrar sesión en proceso...");
}

// Función para obtener el valor del parámetro "temporada" de la URL
function getSeasonFromURL() {
    const urlParams = new URLSearchParams(window.location.search);
    return urlParams.get('temporada');
}

// Función para actualizar el texto del botón según la temporada en la URL
function updateButtonSeason() {
    const season = getSeasonFromURL();
    if (season) {
        document.querySelector('#botonTemporada').textContent = season + '↓';
    }
}

// Llamar a la función para actualizar el texto del botón cuando se carga la página
updateButtonSeason();



function cargarMenuSegunAdmin() {
    const parametroAdmin = obtenerParametroAdmin();
    const menuAdmin = document.getElementById('menuAdmin');
    const menuUsuario = document.getElementById('menuUsuario');

    // Ocultar ambos menús por defecto
    menuAdmin.style.display = 'none';


    if (parametroAdmin && parametroAdmin === 'a') {
        // Si el parámetro admin existe y es 'a', mostrar el menú de administrador
        menuAdmin.style.display = 'block';
        const nombreUsuario = obtenerParametroUsuario();
        const nombreUsuarioElemento = document.getElementById('nombreUsuario');
        if (nombreUsuario) {
            // Si se proporciona el nombre de usuario en la URL, mostrarlo
            nombreUsuarioElemento.innerText = `¡Bienvenido, ${nombreUsuario}!`;
        } else {
            // Si no se proporciona el nombre de usuario, mostrar un mensaje de bienvenida genérico
            nombreUsuarioElemento.innerText = '¡Bienvenido!';
        }
    } else {
        // Si el parámetro admin no existe o no es 'a', mostrar el menú de usuario estándar
        menuUsuario.style.display = 'block';
    }
}

function cerrarSesion() {
    alert('Sesión cerrada correctamente.');

    window.sessionStorage.clear(); // Borra el sessionStorage
    window.location.href = './index.html'; // Redirige al index
}
//----------------------------------------Boton Scroll---------------------------------------//
document.addEventListener("DOMContentLoaded", function () {
    // Obtener referencia al botón de scroll
    var btnScroll = document.getElementById("btnScroll");

    // Agregar evento de click al botón
    btnScroll.addEventListener("click", function () {
        // Configurar la posición a la que deseas hacer scroll (en píxeles)
        var scrollTargetPosition = 700; // Ejemplo: hacer scroll hasta 1000 píxeles desde la parte superior

        // Realizar el scroll suave hasta la posición especificada
        window.scrollTo({
            top: scrollTargetPosition,
            behavior: "smooth" // Hacer el scroll suave
        });
    });
});

