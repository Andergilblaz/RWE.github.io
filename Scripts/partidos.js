function cargarResultadosTemporada(temporada) {
    var url = './XML/temporadas.xml';
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            procesarXML(this, temporada);
        }
    };
    xmlhttp.open("GET", url, true);
    xmlhttp.send();
}

function procesarXML(xml, temporada) {
    var xmlDoc = xml.responseXML;
    var temporadas = xmlDoc.getElementsByTagName("temporada");

    for (var i = 0; i < temporadas.length; i++) {
        var fechaTemporadaElement = temporadas[i].getElementsByTagName("fechaTemporada")[0];
        if (fechaTemporadaElement) {
            var temporadaActual = fechaTemporadaElement.childNodes[0].nodeValue;
            if (temporadaActual === temporada) {
                var jornadas = temporadas[i].getElementsByTagName("jornada");
                var resultadosHTML = '';

                for (var j = 0; j < jornadas.length; j++) {
                    var partidos = jornadas[j].getElementsByTagName("partido");

                    for (var k = 0; k < partidos.length; k++) {
                        var partido = partidos[k];
                        var equipoLocal = getValorNodo(partido, "equipoLocal");
                        var equipoVisitante = getValorNodo(partido, "equipoVisitante");
                        var escudoLocal = getValorNodo(partido, "escudoLocal");
                        var escudoVisitante = getValorNodo(partido, "escudoVisitante");
                        var fechaPartido = getValorNodo(partido, "fechaPartido");
                        var resultado = getValorNodo(partido, "resultado");
                        var piscinaPartido = getValorNodo(partido, "piscinaPartido");
                        var estadoPartido = getValorNodo(partido, "estadoPartido");

                        resultadosHTML += '<div class="partido">';
                        resultadosHTML += '<h1>1ª Division Española</h1>';
                        resultadosHTML += '<p>' + piscinaPartido + '</p>';
                        resultadosHTML += '<p>' + fechaPartido + '</p>';
                        resultadosHTML += '<p>' + estadoPartido + '</p>';
                        resultadosHTML += '<div class="detallesEquipo">';
                        resultadosHTML += '<div>';
                        resultadosHTML += '<h2>' + equipoLocal + '</h2>';
                        resultadosHTML += '<img src="' + escudoLocal + '" alt="' + equipoLocal + '" style="width: 100px;">';
                        resultadosHTML += '</div>';
                        resultadosHTML += '<div>';
                        resultadosHTML += '<p><strong>Resultado:</strong> ' + resultado + '</p>';
                        resultadosHTML += '</div>';
                        resultadosHTML += '<div>';
                        resultadosHTML += '<h2>' + equipoVisitante + '</h2>';
                        resultadosHTML += '<img src="' + escudoVisitante + '" alt="' + equipoVisitante + '" style="width: 100px;">';
                        resultadosHTML += '</div>';
                        resultadosHTML += '</div>';
                        resultadosHTML += '</div>';
                    }
                }

                document.getElementById("contenedorResultados").innerHTML = resultadosHTML;
                return;
            }
        } else {
            console.error("Elemento 'fechaTemporada' no encontrado en la temporada:", i);
        }
    }

    document.getElementById("contenedorResultados").innerHTML = "No se encontraron resultados para la temporada especificada.";
}

function getValorNodo(parent, tag) {
    var nodo = parent.getElementsByTagName(tag)[0];
    return nodo ? nodo.textContent : "";
}

cargarResultadosTemporada("2023-24");



