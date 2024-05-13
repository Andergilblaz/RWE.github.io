function cargarResultadosTemporada(temporada = null) {
    const xmlUrl = './XML/temporadas.xml';
    const xslUrl = './XML/temporadas.xsl';

    fetch(xmlUrl)
        .then(response => response.text())
        .then(xmlText => {
            const parser = new DOMParser();
            const xmlDoc = parser.parseFromString(xmlText, 'text/xml');

            // Filtrar la temporada si se proporciona un valor para el parámetro 'temporada'
            if (temporada) {
                const temporadaElement = xmlDoc.querySelector(`temporada[numeroTemporada="${temporada}"]`);
                if (!temporadaElement) {
                    throw new Error(`No se encontró la temporada con número ${temporada}`);
                }
                xmlDoc.documentElement.replaceChild(temporadaElement, xmlDoc.documentElement.firstChild);
            }

            // Comprobar si existe una temporada posterior a la actual y si es así, detener la carga
            const nextTemporada = xmlDoc.querySelector('temporada[numeroTemporada="' + (parseInt(temporada) + 1) + '"]');
            if (nextTemporada) {
                if (parseInt(nextTemporada.getAttribute('numeroTemporada')) > parseInt(temporada) + 1) {
                    throw new Error('No se cargarán temporadas posteriores a la seleccionada.');
                }
            }

            return transformarXMLconXSL(xmlDoc, xslUrl);
        })
        .then(html => {
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

const urlParams = new URLSearchParams(window.location.search);
const temporada = urlParams.get('temporada');

// Only load the season if the 'temporada' parameter is provided and equals '2023'
if (temporada === '2023') {
    cargarResultadosTemporada(temporada);
} else {
    console.error('La temporada no es válida o no se proporcionó.');
}