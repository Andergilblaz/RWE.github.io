<?xml version="1.0" encoding="UTF-8"?>
<!DOCTYPE xsl:stylesheet [
    <!ENTITY escudo "entity-value">
]>
<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">

<!-- Estilos para la tabla de los partidos -->
<xsl:template match="/">
    <table border="0" style="width: 100%; border-collapse: collapse; border-radius: 10px; overflow: hidden;">
        <tbody>
            <!-- Iterar sobre cada jornada -->
            <xsl:for-each select="temporadas/temporada/jornadas/jornada">
                <!-- Agregar una cabecera con el número de la jornada -->
                <tr>
                    <th colspan="7" style="font-size: 20px; background-color: #f2f2f2; padding: 10px; border-bottom: 1px solid #ccc; border-top-left-radius: 10px; border-top-right-radius: 10px;">Jornada <xsl:value-of select="numeroJornada"/></th>
                </tr>
                <!-- Iterar sobre cada partido de la jornada -->
                <xsl:for-each select="partidos/partido">
                    <tr style="text-align:center; font-size: 18px; background-color:white; ">
                        <td><xsl:value-of select="fechaPartido"/></td>
                        <td>
                            <a href="equipos.php?{../../../@nombreTemporada}&escudo;={escudoLocal}">
                                <img src="{escudoLocal}" alt="Escudo Local" width="100px"/>
                            </a>
                        </td>
                        <td><xsl:value-of select="equipoLocal"/></td>
                        <td><strong><xsl:value-of select="resultado"/></strong></td>
                        <td>
                            <a href="equipos.php?{../../../@nombreTemporada}&escudo;={escudoVisitante}">
                                <img src="{escudVisitante}" alt="Escudo Visitante" width="100px"/>
                            </a>
                        </td>
                        <td><img src="{escudoVisitante}" alt="Escudo Visitante" width="100px"/></td>
                        <!-- Insertar una celda vacía para separar cada tres partidos -->
                        <xsl:if test="position() mod 3 = 0 and position() != last()"></xsl:if>
                    </tr>
                </xsl:for-each>
                <!-- Agregar una fila con una celda vacía para crear un espacio entre las jornadas -->
                <tr>
                    <td style="height: 20px;" colspan="5"></td>
                </tr>
            </xsl:for-each>
        </tbody>
    </table>
</xsl:template>

</xsl:stylesheet>