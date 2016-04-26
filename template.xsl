<?xml version="1.0" encoding="UTF-8"?>

<xsl:stylesheet version="1.0"
xmlns:xsl="http://www.w3.org/1999/XSL/Transform">
<xsl:output method="html" encoding="utf-8"/>

<xsl:template match="/udata">
	<html>
	<body>
		<h1><xsl:value-of select="module"/></h1>
		<ul>
		<xsl:for-each select="items/item">
			<li>
				<a href="http://brightstudio.ru{@link}">
					<xsl:value-of select="."/>
				</a>
			</li>
		</xsl:for-each>
		</ul>
	</body>
	</html>
</xsl:template>
</xsl:stylesheet>