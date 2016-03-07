<?php

$pageName = "NumberingEdit.php";
$pageTitle = "Numbering administration";

include("preInc.inc");

$params = array();

if($_GET)
{
  $params = $_GET;
}

$configDB = new DBConnect(CONFIGDBTYPE, CONFIGDBHOST, CONFIGDBNAME,
			  CONFIGDBUSER, CONFIGDBPASSWD);
$configDB->connectToDB();

$frame = "";

if($params["action"] == "Apply")
{
  if(isset($params["id"]))
    {
      $frame = processInsert("Numbering", "NumberingEdit.php", $params, processNumberingInsertQuery);
    }
}
else if($params["action"] == "Delete")
{
  $frame = processDelete("Numbering", "Numbering.php", $params, processNumberingDeleteQuery);
}
else if($params["action"] == "edit")
{
  $frame = getEditForm("Numbering", "Numbering.php", "NumberingEdit.php", $params, getNumberingData, getNumberingInputs);
}
else if($params["action"] == "create")
{
  $frame = getCreateForm("Numbering", "Numbering.php", "NumberingEdit.php", $params, getNumberingInputs);
}

$configDB->closeDB();

echo $frame;

echo getBackButton("Numbering.php", "Back to Numbering");

include("postInc.inc");

?>
