<?xml version="1.0" encoding="UTF-8"?>
<xsl:stylesheet xmlns:xsl="http://www.w3.org/1999/XSL/Transform"
    xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
    xmlns:oai_dc="http://www.openarchives.org/OAI/2.0/oai_dc/"
    xmlns:dc="http://purl.org/dc/elements/1.1/" version="1.0"
    xmlns:oai="http://www.openarchives.org/OAI/2.0/">
    <xsl:output omit-xml-declaration="yes" method="html"/>
    <xsl:template match="/">
        
        <xsl:variable name="oaibase" select="//oai:request"/>
        <xsl:variable name="recordbase"><xsl:text>?verb=GetRecord&amp;metadataPrefix=oai_dc&amp;identifier=</xsl:text></xsl:variable>
        <table>
            <tr>
                <th class="required">Title</th>
                <th class="required">Rights</th>
                <th class="recommended">Type</th>
                <th class="recommended">Coverage</th>
                <th class="recommended">Language</th>
                <th>Contributor</th>
                <th>Creator</th>
                <th>Date</th>
                <th>Description</th>
                <th>Format</th>
                <th>Identifier</th>
                <th>Publisher</th>
                <th>Relation</th>
                <th>Source</th>
                <th>Subject</th>
            </tr>
            <tr>
                <td>
                    <xsl:for-each select="//dc:title">       
                        <div class='value'><a target="_blank" href="{$oaibase}{$recordbase}{./ancestor::oai:record/oai:header/oai:identifier}"><xsl:value-of select="."/></a></div> 
                    </xsl:for-each>
                </td>
                <td>
                    <xsl:for-each select="//dc:rights">
                        <div class='value'><a target="_blank" href="{$oaibase}{$recordbase}{./ancestor::oai:record/oai:header/oai:identifier}"><xsl:value-of select="."/></a></div> 
                    </xsl:for-each>
                </td>
                 <td>
                 <xsl:for-each select="//dc:type">
                        <div class='value'><a target="_blank" href="{$oaibase}{$recordbase}{./ancestor::oai:record/oai:header/oai:identifier}"><xsl:value-of select="."/></a></div> 
                    </xsl:for-each>
                </td>
                <td>
                    <xsl:for-each select="//dc:coverage">
                        <div class='value'><a target="_blank" href="{$oaibase}{$recordbase}{./ancestor::oai:record/oai:header/oai:identifier}"><xsl:value-of select="."/></a></div> 
                    </xsl:for-each>
                </td>
                <td>
                    <xsl:for-each select="//dc:language">
                        <div class='value'><a target="_blank" href="{$oaibase}{$recordbase}{./ancestor::oai:record/oai:header/oai:identifier}"><xsl:value-of select="."/></a></div> 
                    </xsl:for-each>
                </td>
                <td>
                    <xsl:for-each select="//dc:contributor">
                        <div class='value'><a target="_blank" href="{$oaibase}{$recordbase}{./ancestor::oai:record/oai:header/oai:identifier}"><xsl:value-of select="."/></a></div> 
                    </xsl:for-each>
                </td>
                <td>
                    <xsl:for-each select="//dc:creator">
                        <div class='value'><a target="_blank" href="{$oaibase}{$recordbase}{./ancestor::oai:record/oai:header/oai:identifier}"><xsl:value-of select="."/></a></div> 
                    </xsl:for-each>
                </td>
                <td>
                    <xsl:for-each select="//dc:date">
                        <div class='value'><a target="_blank" href="{$oaibase}{$recordbase}{./ancestor::oai:record/oai:header/oai:identifier}"><xsl:value-of select="."/></a></div> 
                    </xsl:for-each>
                </td>
                <td>
                    <xsl:for-each select="//dc:description">
                        <div class='value'><a target="_blank" href="{$oaibase}{$recordbase}{./ancestor::oai:record/oai:header/oai:identifier}"><xsl:value-of select="."/></a></div> 
                    </xsl:for-each>
                </td>
                <td>
                    <xsl:for-each select="//dc:format">
                        <div class='value'><a target="_blank" href="{$oaibase}{$recordbase}{./ancestor::oai:record/oai:header/oai:identifier}"><xsl:value-of select="."/></a></div> 
                    </xsl:for-each>
                </td>
                <td>
                    <xsl:for-each select="//dc:identifier">
                        <div class='value'><a target="_blank" href="{$oaibase}{$recordbase}{./ancestor::oai:record/oai:header/oai:identifier}"><xsl:value-of select="."/></a></div> 
                    </xsl:for-each>
                </td>
                <td>
                    <xsl:for-each select="//dc:publisher">
                        <div class='value'><a target="_blank" href="{$oaibase}{$recordbase}{./ancestor::oai:record/oai:header/oai:identifier}"><xsl:value-of select="."/></a></div> 
                    </xsl:for-each>
                </td>
                <td>
                    <xsl:for-each select="//dc:relation">
                        <div class='value'><a target="_blank" href="{$oaibase}{$recordbase}{./ancestor::oai:record/oai:header/oai:identifier}"><xsl:value-of select="."/></a></div> 
                    </xsl:for-each>
                </td>
                <td>
                    <xsl:for-each select="//dc:source">
                        <div class='value'><a target="_blank" href="{$oaibase}{$recordbase}{./ancestor::oai:record/oai:header/oai:identifier}"><xsl:value-of select="."/></a></div> 
                    </xsl:for-each>
                </td>
                <td>
                    <xsl:for-each select="//dc:subject">
                        <div class='value'><a target="_blank" href="{$oaibase}{$recordbase}{./ancestor::oai:record/oai:header/oai:identifier}"><xsl:value-of select="."/></a></div> 
                    </xsl:for-each>
                </td>
            </tr>
        </table>
    </xsl:template>
</xsl:stylesheet>
