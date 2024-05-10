<?xml version="1.0" encoding="UTF-8"?>
<xsl:stylesheet version="1.0"
    xmlns:xsl="http://www.w3.org/1999/XSL/Transform">

    <xsl:template match="/">
        <table border="1">
            <thead>
                <tr>
                    <th style= "width:100px">Escudo Local</th>
                    <th style= "width:150px">Equipo Local</th>
                    <th style= "width:150px">Resultado</th>
                    <th style= "width:150px">Equipo Visitante</th>
                    <th style= "width:100px">Escudo Visitante</th>
                </tr>
            </thead>
            <tbody>
                <!-- Iterar sobre cada partido -->
                <xsl:for-each select="temporadas/temporada/jornadas/jornada/partidos/partido">
                    <tr>
                        <td>
                            <img src="{escudoLocal}" alt="Escudo Local" width="100px"/>
                        </td>
                        <td style="text-align:center;" ><xsl:value-of select="equipoLocal"/></td>
                        <td style="text-align:center;"><xsl:value-of select="resultado"/></td>
                        <td style="text-align:center;"><xsl:value-of select="equipoVisitante"/></td>
                        <td>
                            <img src="{escudoVisitante}" alt="Escudo Visitante"  width="100px"/>
                        </td>
                    </tr>
                </xsl:for-each>
            </tbody>
        </table>
    </xsl:template>

</xsl:stylesheet>
