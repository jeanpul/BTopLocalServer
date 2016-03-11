<?php

$pageName = "Configuration.php";
$pageTitle = "Entities Configuration";

include("preInc.inc");

$NbLocations = $clang->getNumberOfLocations();
$NbDoors = $clang->getNumberOfDoors();

?>

<div class="linkList">
 <table>
  <tr>

   <td><ul>
    <li><a id="locations" href="<?php echo getBluePortailURL("Locations.php"); ?>">Locations</a></li>

<?php
if($NbLocations > 1)
{
  echo '<li><a id="doors" href="' . getBluePortailURL("Doors.php") . '">Doors</a></li>' . "\n";
}
else
{
  echo '<li><span class="Off" id="doorsOff">Doors</span></li>' . "\n";
}
?>

</ul></td>

<td><ul>

<?php
if($NbDoors)
{
  echo '<li><a id="groups" href="' . getBluePortailURL("Groups.php") . '">Groups</a></li>' . "\n";
}
else
{
  echo '<li><span class="Off" id="groupsOff">Groups</span></li>' . "\n";
}
?>

<?php
if($NbLocations)
{
  echo '<li><a id="areas" href="' . getBluePortailURL("Areas.php") . '">Areas</a></li>' . "\n";
}
else
{
  echo '<li><span class="Off" id="areasOff">Areas</span></li>' . "\n";
}
?>

</ul></td>
<td><ul>

<?php
if($NbDoors)
{
  echo '<li><a id="btopsensors" href="' . getBluePortailURL("BTopSensors.php") . '">B-Top Sensors</a></li>' . "\n";
}
else
{
  echo '<li><span class="Off" id="btopsensorsOff">B-Top Sensors</span></li>' . "\n";
}


if($NbLocations)
{
  echo '<li><a id="bqueuesensors" href="' . getBluePortailURL("BQueueSensors.php") . '">B-Queue Sensors</a></li>' . "\n";
}
else
{
  echo '<li><span class="Off" id="bqueuesensorsOff">B-Queue Sensors</span></li>' . "\n";
}

?>

</ul></td>
</tr>
</table>

</div>

<?php

echo getBackButton("index.php", "Back to Main menu");

include("postInc.inc");

?>