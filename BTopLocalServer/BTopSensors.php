<?php

$pageName = "BTopSensors.php";
$pageTitle = "B-Top sensors administration";

include("preInc.inc");

$sensors = $clang->getBTopSensors();
$sensorRows="";
foreach($sensors as $obj)
{
  $sensorRows .= "<tr><td>" . "<a href=\"" . getBluePortailURL("BTopSensorsEdit.php?action=edit&id=" . $obj["id"]) . "\">" . $obj["ref"] . "</a>"
    . "</td><td>" . $obj["host"] . "</td><td>" . htmlentities($obj["descr"]) . "</td><td>" . htmlentities($obj["door"]) . "</td><td>" . htmlentities($obj["nameL1"]) . "</td><td>" . htmlentities($obj["nameL2"]) . "</td></tr>\n";
}

$frame = "<div id=\"formWide\">\n";
$frame .= "<div id=\"SensorList\" class=\"Boxes\">\n";
$frame .= '<a href="' . getBluePortailURL("BTopSensorsEdit.php?action=create") . '">Add a new B-Top sensor</a>' . "\n";
$frame .= '<table border="1">' . "\n";
$frame .= '<tr><th id="topTitle">Ref.</th><th id="topTitle">Host</th><th id="topTitle">Descr</th><th id="topTitle">Door</th><th id="topTitle">From</th><th id="topTitle">To</th></tr>' . "\n";
$frame .= $sensorRows;
$frame .= "</table>\n";
$frame .= '<a href="' . getBluePortailURL("BTopSensorsEdit.php?action=create") . '">Add a new B-Top sensor</a>' . "\n";
$frame .= "</div>\n";
$frame .= "</div>\n";

echo $frame;

echo getBackButton("Configuration.php", "Back to Entities Configuration");

include("postInc.inc");

?>
