<?php

$pageName = "BQueueSensors.php";
$pageTitle = "B-Queue sensors administration";

include("preInc.inc");

$sensors = $clang->getBQueueSensors();
$sensorRows="";
foreach($sensors as $obj)
{
  $sensorRows .= "<tr><td>" . "<a href=\"" . getBluePortailURL("BQueueSensorsEdit.php?action=edit&id=" . $obj["id"]) . "\">" . $obj["ref"] . "</a>"
    . "</td><td>" . $obj["host"] . "</td><td>" . htmlentities($obj["descr"]) . "</td><td>" . htmlentities($obj["location"]) . "</td></tr>\n";
}

$frame = "<div id=\"formWide\">\n";
$frame .= "<div id=\"SensorList\" class=\"Boxes\">\n";
$frame .= '<a href="' . getBluePortailURL("BQueueSensorsEdit.php?action=create") . '">Add a new B-Queue sensor</a>' . "\n";
$frame .= '<table border="1">' . "\n";
$frame .= '<tr><th id="topTitle">Ref.</th><th id="topTitle">Host</th><th id="topTitle">Descr</th><th id="topTitle">Location</th></tr>' . "\n";
$frame .= $sensorRows;
$frame .= "</table>\n";
$frame .= '<a href="' . getBluePortailURL("BQueueSensorsEdit.php?action=create") . '">Add a new B-Queue sensor</a>' . "\n";
$frame .= "</div>\n";
$frame .= "</div>\n";

echo $frame;

echo getBackButton("Configuration.php", "Back to Entities Configuration");

include("postInc.inc");

?>
