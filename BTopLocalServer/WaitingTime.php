<?php

$pageName = "WaitingTime.php";
$pageTitle = "Waiting Time indicator";

include("preInc.inc");

$wt = $clang->getZoneWaitingTimeProcessing();
$wtRows = "";
foreach($wt as $obj)
{
  $wtRows .= "<tr><td><a href=\"" . getBluePortailURL("WaitingTimeEdit.php?action=edit&id=" . $obj["id"]) . "\">" . $obj["nameZ"] . "</a></td><td>" . $obj["nameF"] . "</td><td><!--" . 
    $obj["sens"] . ":-->" . $obj["nameZ1"] . "</td><td>" . $obj["nameZ2"] . "</td><td>" . $obj["wt_name"] . "</td></tr>\n";
}

$frame = "<div id=\"formWide\">\n";
$frame .= "<div id=\"SensorList\" class=\"Boxes\">\n";
$frame .= '<a href="' . getBluePortailURL("WaitingTimeEdit.php?action=create") . '">Add a new Waiting Time</a>' . "\n";
$frame .= '<table border="1">' . "\n";
$frame .= '<tr><th id="topTitle">Area/Location</th><th id="topTitle">Door/Door Group</th><th id="topTitle">From</th><th id="topTitle">To</th><th id="topTitle">Type</th></tr>' . "\n";
$frame .= $wtRows;
$frame .= "</table>\n";
$frame .= '<a href="' . getBluePortailURL("WaitingTimeEdit.php?action=create") . '">Add a new Waiting Time</a>' . "\n";
$frame .= "</div>\n";
$frame .= "</div>\n";

echo $frame;

echo getBackButton("Indicators.php", "Back to Indicators");

include("postInc.inc");

?>