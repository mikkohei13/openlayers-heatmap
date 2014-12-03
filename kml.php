<?php
header('Content-type: application/vnd.google-earth.kml+xml');
echo "<?xml version=\"1.0\" encoding=\"UTF-8\"?>";

$sDirty = $_GET['s'];
if (file_exists("data/" . $sDirty . ".txt"))
{
  $s = $sDirty;
}
else
{
  exit("<!-- Virheellinen osoite. -->");
}

$jsData = "";
$fileString = file_get_contents("data/" . $s . ".txt");
$rowsArray = explode("\n", $fileString);

?>
<kml xmlns="http://earth.google.com/kml/2.0" xmlns:atom="http://www.w3.org/2005/Atom">
    <Document>
        <name>Data</name>
        <atom:author>
            <atom:name>Luomus</atom:name>
        </atom:author>
        <atom:link href="http://www.luomus.fi"/>
        <Folder>
            <name>Data</name>

<?php

$i = 0;
foreach ($rowsArray as $rowNumber => $rowString)
{
  // if contains #, skip as comment line
  if (strpos($rowString, "#") !== FALSE)
  {
    continue;
  }

  $rowString = trim($rowString);

  $row = explode("\t", $rowString);
  $coordinates = "<coordinates>" . $row[2] . "," . $row[1] . "</coordinates>\n";

  echo "<Placemark id=\"$i\">
          <name>$i</name>
          <Point>
              $coordinates
          </Point>
        </Placemark>";

  $i++;
}

?>



        </Folder>
    </Document>
</kml>