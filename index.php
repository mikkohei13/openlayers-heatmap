<?php
$sDirty = $_GET['s'];
if (file_exists("data/" . $sDirty . ".txt"))
{
  $s = $sDirty;
}
else
{
  exit("Virheellinen osoite.");
}
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="chrome=1">
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no, width=device-width">
    <title>Openlayers heatmap</title>
    <link rel="stylesheet" href="style.css" type="text/css">
    <link rel="stylesheet" href="http://openlayers.org/en/v3.0.0/css/ol.css" type="text/css">
    <script src="http://openlayers.org/en/v3.0.0/build/ol.js" type="text/javascript"></script>
  </head>
  <body>

  <div id="map" class="map"><div id="info"></div></div>

  <script src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
  <script src="heatmap.php?s=<?php echo $s; ?>"></script>

  </body>
</html>
