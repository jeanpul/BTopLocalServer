<?php

$pageName = "Areas.php";
$pageTitle = "Areas administration";

include("preInc.inc");

$areas = $clang->getLocationAreas();
$areaRows= "";
foreach($areas as $obj)
{
  $areaRows .= "<tr><td>" . "<a href=\"" . getBluePortailURL("AreasEdit.php?action=edit&id=" . $obj["id"]) . "\">" . htmlentities($obj["name"]) . "</a>"
    . "</td></tr>\n";
}

$frame = "<div id=\"formWide\">\n";
$frame .= "<div id=\"SensorList\" class=\"Boxes\">\n";
$frame .= '<a href="' . getBluePortailURL("AreasEdit.php?action=create") . '">Add a new area</a>' . "\n";
$frame .= '<table border="1">' . "\n";
$frame .= '<tr><th id="topTitle">Name</th></tr>' . "\n";
$frame .= $areaRows;
$frame .= "</table>\n";
$frame .= '<a href="' . getBluePortailURL("AreasEdit.php?action=create") . '">Add a new area</a>' . "\n";
$frame .= "</div>\n";
$frame .= "</div>\n";

echo $frame;

echo getBackButton("Configuration.php", "Back to Entities Configuration");

include("postInc.inc");

?>
