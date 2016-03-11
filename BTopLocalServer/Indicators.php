<?php

$pageName = "Indicators.php";
$pageTitle = "Indicators Configuration";

include("preInc.inc");

$NbLocations = $clang->getNumberOfLocations();
$NbNumberingAreas = $clang->getNumberOfNumberingAreas();
$NbDoors = $clang->getNumberOfDoors();

// Group of door need door to exist : no need to test existence of group


?>

<div class="linkList">
 <table>
  <tr>
   <td>
    <ul>

<?php

if($NbLocations)
{
  echo '<li><a id="visitors" href="' . getBluePortailURL("Visitors.php") . '">Visitors</a></li>' . "\n";
}
else
{
  echo '<li><span class="Off" id="visitorsOff">Visitors</span></li>' . "\n";
}

?>

</ul></td>
<td><ul>

<?php

if($NbLocations)
{
  echo '<li><a id="numbering" href="' . getBluePortailURL("Numbering.php") . '">Numbering</a></li>' . "\n";
}
else
{
  echo '<li><span class="Off" id="numberingOff">Numbering</span></li>' . "\n";
}

?>

</ul></td>
<td><ul>

<?php

if($NbDoors and $NbNumberingAreas)
{
  echo '<li><a id="waitingtime" href="' . getBluePortailURL("WaitingTime.php") . '">Waiting Time</a></li>' . "\n";
}
else
{
  echo '<li><span class="Off" id="waitingtimeOff">Waiting Time</span></li>' . "\n";
}


?>

    </ul>
   </td>
  </tr>
 </table>
</div>

<?php

echo getBackButton("index.php", "Back to Main menu");

include("postInc.inc");

?>