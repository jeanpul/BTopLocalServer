<?php

$pageName = "Locations.php";
$pageTitle = "Locations administration";

include("preInc.inc");

$locations = $clang->getLocations();
$locationRows="";
foreach($locations as $obj)
{
  $locationRows .= "<tr><td>" . "<a href=\"" . getBluePortailURL("LocationsEdit.php?action=edit&id=" . $obj["id"]) . "\">" . htmlentities($obj["name"]) . "</a></td></tr>\n";
}

$frame = "<div id=\"formWide\">\n";
$frame .= "<div id=\"SensorList\" class=\"Boxes\">\n";
$frame .= '<a href="' . getBluePortailURL("LocationsEdit.php?action=create") . '">Add a new location</a>' . "\n";
$frame .= '<table border="1">' . "\n";
$frame .= '<tr><th id="topTitle">Name</th></tr>' . "\n";
$frame .= $locationRows;
$frame .= "</table>\n";
$frame .= '<a href="' . getBluePortailURL("LocationsEdit.php?action=create") . '">Add a new location</a>' . "\n";
$frame .= "</div>\n";
$frame .= "</div>\n";

echo $frame;

echo getBackButton("Configuration.php", "Back to Entities Configuration");

include("postInc.inc");

?>
