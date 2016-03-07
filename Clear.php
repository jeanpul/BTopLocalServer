<?php

$pageName = "Clear.php";
$pageTitle = "Clear all settings";

include("preInc.inc");

$params = $_POST;

if(isset($params) and isset($params["action"]) and $params["action"] = "Cancel")
{
  $clang->clearAll();
?>
<div id="formWide">
<p>Settings cleared.</p>
</div>
<?php  
}
else
{
?>

<div id="formWide">
<div id="infoSmall">
<p>Warning : "Clear all settings" implies you lose all the configuration done on the entities and also the
counting data and the statistics stored in the databases.</p>
</div>
<div id="form">
<form action="Clear.php" method="post">
<?php echo getBluePortailInputs(); ?>
<button type="submit" name="action" value="Clear">Clear all settings</button>
</form>
</div>
</div>

<?php
}

echo getBackButton("Settings.php", "Back to Backup/Resotre menu");

include("postInc.inc");

?>
