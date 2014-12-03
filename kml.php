<?php
header('Content-type: application/vnd.google-earth.kml+xml');
//header('Content-type: text/plain'); // debug
echo "<?xml version=\"1.0\" encoding=\"UTF-8\"?>";

$sDirty = $_GET['s'];
if (preg_match("([A-Za-z0-9\-\_]+)", $sDirty) !== 0 && file_exists("data/" . $sDirty . ".txt"))
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

// Finds largest count
$largest = 0;
foreach ($rowsArray as $rowNumber => $rowString)
{
  // if contains #, delete and skip
  if (strpos($rowString, "#") !== FALSE)
  {
    unset($rowsArray[$rowNumber]);
    continue;
  }

  $rowString = trim($rowString);
  $row = explode("\t", $rowString);
  if ($row[0] > $largest)
  {
    $largest = $row[0];
  }
}

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
  $rowString = trim($rowString);

  $row = explode("\t", $rowString);
  $coordinates = "<coordinates>" . $row[2] . "," . $row[1] . "</coordinates>\n";

  $scaledCount = $row[0] / $largest;

  echo "
        <Placemark id=\"$i\">
          <name>$scaledCount</name>
          <Point>
              $coordinates
          </Point>
        </Placemark>
        ";

  $i++;
}

?>



        </Folder>
    </Document>
</kml>