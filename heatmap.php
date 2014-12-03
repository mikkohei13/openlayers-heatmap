<?php
header('Content-Type: application/javascript; charset=utf-8');
$sDirty = $_GET['s'];
if (file_exists("data/" . $sDirty . ".txt"))
{
  $s = $sDirty;
}
else
{
  exit("// Virheellinen osoite.");
}
?>
// http://openlayers.org/en/v3.0.0/apidoc/ol.layer.Heatmap.html
// http://www.websitedev.de/temp/openlayers-heatmap-layer.html


// Data
var vector = new ol.layer.Heatmap({
  source: new ol.source.KML({
    extractStyles: false,
    projection: 'EPSG:3857',
    url: 'kml.php?s=<?php echo $s; ?>'
  }),
  /*
  // Hyvät arvot laskentareiteille
  radius: 7,
  blur: 40,
  */
  // Hyvät arvot havainnoille
  radius: 7,
  blur: 40,
});

// Raster map
var raster = new ol.layer.Tile({
  source: new ol.source.Stamen({
    layer: 'toner-lite'
  })
});

var map = new ol.Map({
  layers: [raster, vector],
  target: 'map',
  view: new ol.View({
    center: ol.proj.transform([24.1,60.2], 'EPSG:4326', 'EPSG:3857'),
    zoom: 9
  })
});

// Resize map to fill viewport
fixContentHeight();

// On window resize, resize map to fill viewport
$( window ).resize(function() {
  fixContentHeight();
});

// Resize map to fill viewport
// http://stackoverflow.com/questions/12887506/cannot-set-maps-div-height-for-openlayers-map
function fixContentHeight()
{
    var viewHeight = $(window).height();
    var mapElement = $("#map");
    mapElement.height(viewHeight);
    map.updateSize();
}
