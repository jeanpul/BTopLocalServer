<?php

$pageName = "Numbering.php";
$pageTitle = "Numbering indicator";

include("preInc.inc");

$n = $clang->getZonesWithNumberingProcessing();

$nRows = "";
foreach($n as $obj)
{
  $nRows .= "<tr><td><a href=\"" . getBluePortailURL("NumberingEdit.php?action=edit&id=" . $obj["id"]) . "\">" . $obj["name"] . "</a></td></tr>\n";
}

$addUrl = '<a href="' . getBluePortailURL("NumberingEdit.php?action=create") . '">Add a new Numbering</a>' . "\n"; 

$frame = "<div id=\"formWide\">\n";
$frame .= "<div id=\"SensorList\" class=\"Boxes\">\n";
$frame .=  $addUrl;
$frame .= '<table border="1">' . "\n";
$frame .= '<tr><th id="topTitle">Location/Area</th></tr>' . "\n";
$frame .= $nRows;
$frame .= "</table>\n";
$frame .= $addUrl;
$frame .= "</div>\n";
$frame .= "</div>\n";
$frame .= getBackButton("Indicators.php", "Back to Indicators");

echo $frame;

include("postInc.inc");

?>