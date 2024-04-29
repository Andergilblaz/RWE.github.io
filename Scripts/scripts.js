
function cargarTablaMenu() { //Funcion cargar Nav
    fetch('CargasDinamicas/navFooter.html') //Busca dentro del archivo articulos.html
        .then(response => response.text())
        .then(data => {
            const parser = new DOMParser();
            const htmlDocument = parser.parseFromString(data, 'text/html');

            const tablaMenu = htmlDocument.getElementById('tablaMenu').innerHTML; //Le pones el id que quieras coger
            document.getElementById('tablaMenu').innerHTML = tablaMenu; //Pone el contenido donde debe
        });
}

function cargarFooter() { //Funcion cargar Footer
    fetch('CargasDinamicas/navFooter.html') //Busca dentro del archivo articulos.html
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



