<?php

$pageName = "index.php";
$pageTitle = "Main menu";

include("preInc.inc");

getBluePortailURL("Configuration.php");

?>

<div class="linkList">
<table>
<tr>
<td><ul>
<li><a id="entities" href="<?php echo getBluePortailURL("Configuration.php"); ?>">Entities Configuration</a></li>
<li><a id="indicators" href="<?php echo getBluePortailURL("Indicators.php"); ?>">Indicators</a></li>
</ul></td>
<td><ul>
<li><a id="calendar" href="<?php echo getBluePortailURL("Calendar.php"); ?>">Calendar</a></li>
<li><a id="backupRestore" href="<?php echo getBluePortailURL("Settings.php"); ?>">Backup/Restore settings</a></li>
</ul></td>
<td><ul>

<?php

if(defined(STATACCESS))
{
  echo '<li><a id="statistics" target="_blank" rel="nofollow" href="' . getBluePortailURL(STATURL) . '">Statistics</a></li>' . "\n";
}
else
{
  echo '<li><span class="Off" id="statisticsOff">Statistics</span></li>' . "\n";
}

?>

<li><a id="log" href="<?php echo getBluePortailURL("Status.php"); ?>">System status</a></li>

</ul></td>
<td><ul>

<li><a id="time" href="<?php echo getBluePortailURL("TimeZone.php"); ?>">TimeZone</a></li>
<li><a id="help" target="_blank" rel="nofollow" href="https://github.com/jeanpul/BTopLocalServer/wiki">Help</a></li>

</ul></td>
</tr>
</table>

</div>

<?php

include("postInc.inc");

?>
