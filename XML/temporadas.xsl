<?xml version="1.0" encoding="UTF-8"?>
<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">
    <xsl:output method="html" encoding="UTF-8" />

    <!-- Template to match the root element and apply transformations -->
    <xsl:template match="/">
        <!-- Iterate over each temporada -->
        <xsl:for-each select="temporadas/temporada">
            <!-- Display the table of partidos -->
            <table border="0" style="width: 100%; border-collapse: collapse; border-radius: 10px; overflow: hidden;">
                <theader> <!-- Display the estado of the temporada -->
                    <!-- ... -->
                </theader>
                <tbody>
                <tr>
                    <td colspan="9" style="text-align: center;">
                        <h3>Estado de la Temporada: </h3>  <h2><xsl:value-of select="estado" /></h2>
                        <hr></hr>
                    </td>
                </tr>

                <xsl:for-each select="jornadas/jornada">
                    <tr>
                        <th colspan="9" style="font-size: 20px; background-color: #f2f2f2; padding: 10px; border-bottom: 1px solid #ccc; border-top-left-radius: 10px; border-top-right-radius: 10px;">
                            Jornada <xsl:value-of select="numeroJornada" />
                        </th>
                    </tr>
                    <xsl:for-each select="partidos/partido">
                        <tr style="text-align:center; font-size: 18px; background-color:white;">
                            <td><xsl:value-of select="fechaPartido" /></td>
                            <td>
                                <a href="equipos.php?escudo={escudoLocal}">
                                    <img src="{escudoLocal}" alt="Escudo Local" width="100px" style="max-width: 100%;" />
                                </a>
                            </td>
                            <td><xsl:value-of select="equipoLocal" /></td>
                            <td><strong><xsl:value-of select="goleslocal" /></strong></td>
                            <td> - </td>
                            <td><strong><xsl:value-of select="golesvisitante" /></strong></td>
                            <td><xsl:value-of select="equipoVisitante" /></td>
                            <td>
                                <a href="equipos.php?escudo={escudoVisitante}">
                                    <img src="{escudoVisitante}" alt="Escudo Visitante" width="100px" style="max-width: 100%;" />
                                </a>
                            </td>
                            <xsl:if test="position() mod 3 = 0 and position() != last()">
                                <td></td>
                            </xsl:if>
                        </tr>
                    </xsl:for-each>
                    <tr>
                        <td style="height: 20px;" colspan="7"></td>
                    </tr>
                </xsl:for-each>
                </tbody>
            </table>
        </xsl:for-each>
    </xsl:template>
</xsl:stylesheet>
