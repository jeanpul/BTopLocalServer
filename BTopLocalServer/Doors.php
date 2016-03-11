<?php

$pageName = "Doors.php";
$pageTitle = "Doors administration";

include("preInc.inc");

$doors = $clang->getDoors();
$doorsRows = "";
foreach($doors as $obj)
{
  $doorsRows .= "<tr><td>" . "<a href=\"" . getBluePortailURL("DoorsEdit.php?action=edit&id=" . $obj["id"]) . "\">" . htmlentities($obj["name"]) . "</a>"
    . "</td><td>" . htmlentities($obj["nameZ1"] . "," . $obj["nameZ2"]) . "</td></tr>\n";
}

$frame = "<div id=\"formWide\">\n";
$frame .= "<div id=\"SensorList\" class=\"Boxes\">\n";
$frame .= '<a href="' . getBluePortailURL("DoorsEdit.php?action=create") . '">Add a new door</a>' . "\n";
$frame .= '<table border="1">' . "\n";
$frame .= '<tr><th id="topTitle">Name</th><th id="topTitle">Locations</th></tr>' . "\n";
$frame .= $doorsRows;
$frame .= "</table>\n";
$frame .= '<a href="' . getBluePortailURL("DoorsEdit.php?action=create") . '">Add a new door</a>' . "\n";
$frame .= "</div>\n";
$frame .= "</div>\n";

echo $frame;

echo getBackButton("Configuration.php", "Back to Entities Configuration");

include("postInc.inc");

?>