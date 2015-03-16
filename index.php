<?php
header('Content-Type: text/html; charset=utf-8');


$dataDir = "data";

if (! isset($_GET['s']))
{
  exit("Virheellinen osoite (parametri 's' puuttuu).");
}
$sDirty = $_GET['s'];
if (preg_match("([A-Za-z0-9\-\_]+)", $sDirty) !== 0 && file_exists($dataDir . "/" . $sDirty . ".txt"))
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

  <script src="http://maps.google.com/maps/api/js?v=3&amp;sensor=false"></script>
  <script src="https://code.jquery.com/jquery-2.1.1.min.js"></script>

  <?php require_once "heatmap.php"; ?>

  </body>
</html>
