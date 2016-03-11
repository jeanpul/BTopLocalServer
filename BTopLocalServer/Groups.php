<?php

$pageName = "Groups.php";
$pageTitle = "Groups administration";

include("preInc.inc");

$groups = $clang->getDoorGroups();
$groupRows = "";
foreach($groups as $obj)
{
  $groupRows .= "<tr><td>" . "<a href=\"" . getBluePortailURL("GroupsEdit.php?action=edit&id=" . $obj["id"]) . "\">" . htmlentities($obj["name"]) . "</a>"
    . "</td><td>".htmlentities($obj["nameZ1"])."</td><td>".htmlentities($obj["nameZ2"])."</td></tr>\n";
}

$frame = "<div id=\"formWide\">\n";
$frame .= "<div id=\"SensorList\" class=\"Boxes\">\n";
$frame .= '<a href="' . getBluePortailURL("GroupsEdit.php?action=create") . '">Add a new group</a>' . "\n";
$frame .= '<table border="1">' . "\n";
$frame .= '<tr><th id="topTitle">Name</th><th>From</th><th>To</th></tr>' . "\n";
$frame .= $groupRows;
$frame .= "</table>\n";
$frame .= '<a href="' . getBluePortailURL("GroupsEdit.php?action=create") . '">Add a new group</a>' . "\n";
$frame .= "</div>\n";
$frame .= "</div>\n";

echo $frame;

echo getBackButton("Configuration.php", "Back to Entities Configuration");

include("postInc.inc");

?>
