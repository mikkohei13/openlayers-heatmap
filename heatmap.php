<?php
header('Content-Type: application/javascript; charset=utf-8');
$sDirty = $_GET['s'];
if (preg_match("([A-Za-z0-9\-\_]+)", $sDirty) !== 0 && file_exists("data/" . $sDirty . ".txt"))
{
  $s = $sDirty;
}
else
{
  exit("// Virheellinen osoite.");
}

require_once "heatmap.js";
?>