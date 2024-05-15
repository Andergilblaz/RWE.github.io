//Función para que cargue los partidos de cada temporada
function cargarResultadosTemporada(temporadaId = null) {
    const xmlUrl = './XML/temporadas.xml';
    const xslUrl = './XML/temporadas.xsl';

    fetch(xmlUrl)
        .then(response => response.text())
        .then(xmlText => {
            const parser = new DOMParser();
            let xmlDoc = parser.parseFromString(xmlText, 'text/xml');

            // Filtrar la temporada si se proporciona un valor para el parámetro 'temporadaId'
            if (temporadaId) {
                const temporadaElement = xmlDoc.querySelector(`temporada[id="${temporadaId}"]`);
                if (!temporadaElement) {
                    throw new Error(`No se encontró la temporada con ID ${temporadaId}`);
                }

                // Crear un nuevo documento XML con solo el elemento de la temporada seleccionada
                const newXmlDoc = parser.parseFromString('<temporadas></temporadas>', 'text/xml');
                newXmlDoc.documentElement.appendChild(newXmlDoc.importNode(temporadaElement, true));
                xmlDoc = newXmlDoc;
            }

            return transformarXMLconXSL(xmlDoc, xslUrl);
        })
        .then(html => {
            const tablaContainer = document.getElementById('tabla-container');
            if (tablaContainer) {
                tablaContainer.innerHTML = html;
            } else {
                console.error('No se encontró el contenedor de tabla.');
            }
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

// Obtener el parámetro 'temporadaId' de la URL
const urlParams = new URLSearchParams(window.location.search);
const temporadaId = urlParams.get('temporada');

// Cargar los resultados de la temporada si se proporcionó el parámetro 'temporadaId'
if (temporadaId) {
    cargarResultadosTemporada(temporadaId);
} else {
    console.error('La temporada no es válida o no se proporcionó.');
}
