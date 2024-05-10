<?xml version="1.0" encoding="UTF-8"?>
<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">

<xsl:template match="/">
    <table border="1" style="width: 100%;">
        <tbody>
            <!-- Iterar sobre cada jornada -->
            <xsl:for-each select="temporadas/temporada/jornadas/jornada">
                <!-- Agregar una cabecera con el número de la jornada -->
                <tr>
                    <th colspan="7" style="font-size: 20px;">Jornada <xsl:value-of select="numeroJornada"/></th>
                </tr>
                <!-- Iterar sobre cada partido de la jornada -->
                <xsl:for-each select="partidos/partido">
                    <tr style="text-align:center; font-size: 18px;">
                        <td><img src="{escudoLocal}" alt="Escudo Local" width="100px"/></td>
                        <td><xsl:value-of select="equipoLocal"/></td>
                        <td><strong><xsl:value-of select="resultado"/></strong></td>
                        <td><xsl:value-of select="equipoVisitante"/></td>
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