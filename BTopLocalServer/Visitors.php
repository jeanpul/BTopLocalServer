<?php

$pageName = "Visitors.php";
$pageTitle = "Visitors indicator";

include("preInc.inc");

$n = $clang->getLocationsWithCountingProcessing();

$nRows = "";
foreach($n as $obj)
{
  $nRows .= "<tr><td><a href=\"" . getBluePortailURL("VisitorsEdit.php?action=edit&id=" . $obj["id"]) . "\">" . $obj["name"] . "</a></td></tr>\n";
}

$addURL = '<a href="' . getBluePortailURL("VisitorsEdit.php?action=create") . '">Add a new Visitors</a>' . "\n"; 

$frame = "<div id=\"formWide\">\n";
$frame .= "<div id=\"SensorList\" class=\"Boxes\">\n";
$frame .= $addURL;
$frame .= '<table border="1">' . "\n";
$frame .= '<tr><th id="topTitle">Location/Area</th></tr>' . "\n";
$frame .= $nRows;
$frame .= "</table>\n";
$frame .= $addURL;
$frame .= "</div>\n";
$frame .= "</div>\n";
$frame .= getBackButton("Indicators.php", "Back to Indicators");

echo $frame;

include("postInc.inc");

?>
