<?xml version="1.0" encoding="UTF-8"?>
<xsl:stylesheet xmlns:xsl="http://www.w3.org/1999/XSL/Transform"
    xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
    xmlns:oai_dc="http://www.openarchives.org/OAI/2.0/oai_dc/"
    xmlns:dc="http://purl.org/dc/elements/1.1/" version="1.0"
    xmlns:oai="http://www.openarchives.org/OAI/2.0/"
    xmlns:mods="http://www.loc.gov/mods/v3">
    <xsl:output omit-xml-declaration="yes" method="html"/>
    <xsl:template match="/">
        
        <xsl:variable name="oaibase" select="//oai:request"/>
        <xsl:variable name="recordbase"><xsl:text>?verb=GetRecord&amp;metadataPrefix=oai_dc&amp;identifier=</xsl:text></xsl:variable>
        
        <xsl:for-each select="//oai:record">
            <xsl:variable name="title" select="normalize-space(.//mods:mods/mods:titleInfo[1]/mods:title)"/>
            <xsl:variable name="coverage" select="normalize-space(.//mods:geographic[1])"/>
            <xsl:variable name="rights" select="normalize-space(.//mods:accessCondition[1])"/>
            <xsl:variable name="language" select="normalize-space(.//mods:languageTerm[1])"/>
            <xsl:variable name="type" select="normalize-space(.//mods:genre[1])"/>
            <xsl:variable name="id" select="./oai:header/oai:identifier"/>
           
            
            <xsl:if test="not($title) or not($coverage) or not($rights) or not($language) or not($type)">
                <tr>
                    <td><a target="_blank" href="{$oaibase}{$recordbase}{$id}"><xsl:value-of select="$id"/></a></td>
                    <td>
                        <xsl:if test="not($title)">
                            <p>Title</p>
                        </xsl:if>
                        <xsl:if test="not($coverage)">
                            <p>Coverage</p>
                        </xsl:if>
                        <xsl:if test="not($rights)">
                            <p>Rights</p>
                        </xsl:if>
                    </td>
                    <td>
                        <xsl:if test="not($language)">
                            <p>Language</p>
                        </xsl:if>
                        <xsl:if test="not($type)">
                            <p>Type</p>
                        </xsl:if>
                    </td>
                </tr>
            </xsl:if>
             
        </xsl:for-each>
    </xsl:template>
</xsl:stylesheet>
