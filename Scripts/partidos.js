// Función para cargar el XML y aplicar la transformación XSL
function cargarResultadosTemporada() {
    // Ruta del archivo XML
    const xmlUrl = './XML/temporadas.xml';
    // Ruta del archivo XSL
    const xslUrl = './XML/temporadas.xsl';

    // Cargar el archivo XML
    fetch(xmlUrl)
        .then(response => response.text())
        .then(xmlText => {
            // Convertir el texto XML en un objeto XML
            const parser = new DOMParser();
            const xmlDoc = parser.parseFromString(xmlText, 'text/xml');

            // Transformar el XML con XSL
            return transformarXMLconXSL(xmlDoc, xslUrl);
        })
        .then(html => {
            // Agregar el HTML transformado a un contenedor en tu página
            const tablaContainer = document.getElementById('tabla-container');
            tablaContainer.innerHTML = html;
        })
        .catch(error => {
            console.error('Error al cargar o transformar el XML:', error);
        });
}

// Función para transformar el XML con XSL
function transformarXMLconXSL(xml, xslUrl) {
    return new Promise((resolve, reject) => {
        const xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = () => {
            if (xmlhttp.readyState == 4) {
                if (xmlhttp.status == 200) {
                    const xsl = xmlhttp.responseXML;
                    const xsltProcessor = new XSLTProcessor();
                    xsltProcessor.importStylesheet(xsl);
                    const resultDocument = xsltProcessor.transformToDocument(xml);
                    const serializer = new XMLSerializer();
                    const transformedHTML = serializer.serializeToString(resultDocument);
                    resolve(transformedHTML);
                } else {
                    reject(new Error('Error al cargar el archivo XSL'));
                }
            }
        };
        xmlhttp.open('GET', xslUrl, true);
        xmlhttp.send();
    });
}

// Llamar a la función para cargar los resultados de la temporada cuando la página esté lista
document.addEventListener('DOMContentLoaded', cargarResultadosTemporada);

function cargarPartidosJ1() {
    // Obtener el parámetro de la URL correspondiente al año
    var urlParams = new URLSearchParams(window.location.search);
    var temporada = urlParams.get('temporada');

    // Cambiar el valor de la jornada a 1
    var nuevaURL = window.location.href.replace(/jornada=\d+/, "jornada=1");

    // Redirigir a la nueva URL
    window.location.href = nuevaURL;
}

function cargarPartidosJ2() {
    // Obtener el parámetro de la URL correspondiente al año
    var urlParams = new URLSearchParams(window.location.search);
    var temporada = urlParams.get('temporada');

    // Cambiar el valor de la jornada a 2
    var nuevaURL = window.location.href.replace(/jornada=\d+/, "jornada=2");

    // Redirigir a la nueva URL
    window.location.href = nuevaURL;
}
function cargarPartidosJ3() {
    // Obtener el parámetro de la URL correspondiente al año
    var urlParams = new URLSearchParams(window.location.search);
    var temporada = urlParams.get('temporada');

    // Cambiar el valor de la jornada a 3
    var nuevaURL = window.location.href.replace(/jornada=\d+/, "jornada=3");

    // Redirigir a la nueva URL
    window.location.href = nuevaURL;
}

function cargarPartidosJ4() {
    // Obtener el parámetro de la URL correspondiente al año
    var urlParams = new URLSearchParams(window.location.search);
    var temporada = urlParams.get('temporada');

    // Cambiar el valor de la jornada a 4
    var nuevaURL = window.location.href.replace(/jornada=\d+/, "jornada=4");

    // Redirigir a la nueva URL
    window.location.href = nuevaURL;
}

// Repite el mismo patrón para las jornadas restantes...

function cargarPartidosJ5() {
    var urlParams = new URLSearchParams(window.location.search);
    var temporada = urlParams.get('temporada');
    var nuevaURL = window.location.href.replace(/jornada=\d+/, "jornada=5");
    window.location.href = nuevaURL;
}

function cargarPartidosJ6() {
    var urlParams = new URLSearchParams(window.location.search);
    var temporada = urlParams.get('temporada');
    var nuevaURL = window.location.href.replace(/jornada=\d+/, "jornada=6");
    window.location.href = nuevaURL;
}

function cargarPartidosJ7() {
    var urlParams = new URLSearchParams(window.location.search);
    var temporada = urlParams.get('temporada');
    var nuevaURL = window.location.href.replace(/jornada=\d+/, "jornada=7");
    window.location.href = nuevaURL;
}

function cargarPartidosJ8() {
    var urlParams = new URLSearchParams(window.location.search);
    var temporada = urlParams.get('temporada');
    var nuevaURL = window.location.href.replace(/jornada=\d+/, "jornada=8");
    window.location.href = nuevaURL;
}

function cargarPartidosJ9() {
    var urlParams = new URLSearchParams(window.location.search);
    var temporada = urlParams.get('temporada');
    var nuevaURL = window.location.href.replace(/jornada=\d+/, "jornada=9");
    window.location.href = nuevaURL;
}

function cargarPartidosJ10() {
    var urlParams = new URLSearchParams(window.location.search);
    var temporada = urlParams.get('temporada');
    var nuevaURL = window.location.href.replace(/jornada=\d+/, "jornada=10");
    window.location.href = nuevaURL;
}
