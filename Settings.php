<?php

$pageName = "Status.php";
$pageTitle = "Backup/Restore settings";

include("preInc.inc");

?>

<div class="linkList">
<table>
<tr>
<td>
<div class="linkList"><ul>
<li><a id="backup" href="<?php echo getBluePortailURL("/cgi-bin/BTopServer/BTopServerBackup.cgi"); ?>">Backup</a></li>
</ul></div>

</td>
<td>
<div class="linkList"><ul>
<li><a id="restore" href="<?php echo getBluePortailURL("/cgi-bin/BTopServer/BTopServerRestore.cgi"); ?>">Restore</a></li>
</ul></div>
</td>
<td>
<div class="linkList"><ul>

<li><a id="clear" href="<?php echo getBluePortailURL("Clear.php"); ?>">Clear</a></li>
</ul></div>
</td>
</tr>
</table>
</div>

<?php

echo getBackButton("index.php", "Back to Main menu");

include("postInc.inc");

?>