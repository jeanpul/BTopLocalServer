<?php

$pageName = "Status.php";
$pageTitle = "System status";

include("preInc.inc");

$NbLocations = $clang->getNumberOfLocations();
$NbDoors = $clang->getNumberOfDoors();

?>

<div id="formWide">

<h3><u>Counting information</u></h3>
<div class="Boxes">
<table border="1">
<tr><th id="topTitle">Entity</th><th id="topTitle">Total processed</th><th id="topTitle">Total expected</th><th id="topTitle">Date first</th><th id="topTitle">Date last</th><th id="topTitle">Counters sum</th></tr>

<?php
$frame = "";

$countDBInfos = $clang->getBTopCountingInfos();

$frame .= "<tr><th>B-Top</th><td>" . $countDBInfos["NbEntries"] . "</td><td>" . $countDBInfos["NbProcessed"] . "</td><td>" . 
$countDBInfos["MinTime"] . "</td><td>" . $countDBInfos["MaxTime"] . "</td><td>" . $countDBInfos["SumValues"] . "</td></tr>\n";

$countDBInfos = $clang->getLocationCountingInfos();

if(count($countDBInfos))
  {
    $frame .= "<tr><th>Location</th><td>" . $countDBInfos["SumCumul0"] . "," . $countDBInfos["SumCumul1"] . "</td><td>" . $countDBInfos["SumExpected0"] . "," . $countDBInfos["SumExpected1"] . "</td><td>" . 
      $countDBInfos["MinTime"] . "</td><td>" . $countDBInfos["MaxTime"] . "</td><td>" . $countDBInfos["SumValues0"] . "," . $countDBInfos["SumValues1"] . "</td></tr>\n";
  }

$countDBInfos = $clang->getAreaCountingInfos();

if(count($countDBInfos))
  {
    $frame .= "<tr><th>Area</th><td>" .  $countDBInfos["SumCumul0"] . "," . $countDBInfos["SumCumul1"] . "</td><td>" . $countDBInfos["SumExpected0"] . "," . $countDBInfos["SumExpected1"] . "</td><td>" . 
      $countDBInfos["MinTime"] . "</td><td>" . $countDBInfos["MaxTime"] . "</td><td>" . $countDBInfos["SumValues0"] . "," . $countDBInfos["SumValues1"] . "</td></tr>\n";
  }

$countDBInfos = $clang->getDoorCountingInfos();

if(count($countDBInfos))
  {
    $frame .= "<tr><th>Door</th><td>" . $countDBInfos["SumCumul0"] . "," . $countDBInfos["SumCumul1"] . "</td><td>" . $countDBInfos["SumExpected0"] . "," . $countDBInfos["SumExpected1"] . "</td><td>" . 
      $countDBInfos["MinTime"] . "</td><td>" . $countDBInfos["MaxTime"] . "</td><td>" . $countDBInfos["SumValues0"] . "," . $countDBInfos["SumValues1"] . "</td></tr>\n";
  }

$countDBInfos = $clang->getGroupCountingInfos();

if(count($countDBInfos))
  {
    $frame .= "<tr><th>Group</th><td>" . $countDBInfos["SumCumul0"] . "," . $countDBInfos["SumCumul1"] . "</td><td>" . $countDBInfos["SumExpected0"] . "," . $countDBInfos["SumExpected1"] . "</td><td>" . 
      $countDBInfos["MinTime"] . "</td><td>" . $countDBInfos["MaxTime"] . "</td><td>" . $countDBInfos["SumValues0"] . "," . $countDBInfos["SumValues1"] . "</td></tr>\n";
  }

echo $frame;

?>

</table>
</div>

<h3><u>Numbering information</u></h3>
<div class="Boxes">
<table order="1">
<tr><th id="topTitle">Entity</th><th id="topTitle">Total processed</th><th id="topTitle">Total expected</th><th id="topTitle">Date first</th><th id="topTitle">Date last</th><th id="topTitle">Value Sum</th></tr>

<?php

$frame = "";

$countDBInfos = $clang->getBQueueNumberingInfos();

if(count($countDBInfos))
  {
    $frame .= "<tr><th>B-Queue</th><td>" . $countDBInfos["NbEntries"] . "</td><td>" . $countDBInfos["NbProcessed"] . "</td><td>" . 
      $countDBInfos["MinTime"] . "</td><td>" . $countDBInfos["MaxTime"] . "</td><td>" . $countDBInfos["SumValues"] . "</td></tr>\n";
  }

$countDBInfos = $clang->getLocationNumberingInfos();

if(count($countDBInfos))
  {
    $frame .= "<tr><th>Location</th><td>" . $countDBInfos["SumCumul"] . "</td><td>" . $countDBInfos["SumExpected"] . "</td><td>" . 
      $countDBInfos["MinTime"] . "</td><td>" . $countDBInfos["MaxTime"] . "</td><td>" . $countDBInfos["SumValues"] . "</td></tr>\n";
  }

$countDBInfos = $clang->getAreaNumberingInfos();

if(count($countDBInfos))
  {
    $frame .= "<tr><th>Area</th><td>" . $countDBInfos["SumCumul"] . "</td><td>" . $countDBInfos["SumExpected"] . "</td><td>" . 
      $countDBInfos["MinTime"] . "</td><td>" . $countDBInfos["MaxTime"] . "</td><td>" . $countDBInfos["SumValues"] . "</td></tr>\n";
  }

echo $frame

?>

</table>
</div>

</div>

<?php

echo getBackButton("index.php", "Back to Main menu");

include("postInc.inc");

?>