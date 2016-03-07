<?php

$pageName = "VisitorsEdit.php";
$pageTitle = "Visitors administration";

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
      $frame = processInsert("Visitors", "VisitorsEdit.php", $params, 'processVisitorsInsertQuery');
    }
}
else if($params["action"] == "Delete")
{
  $frame = processDelete("Visitors", "Visitors.php", $params, 'processVisitorsDeleteQuery');
}
else if($params["action"] == "edit")
{
  $frame = getEditForm("Visitors", "Visitors.php", "VisitorsEdit.php", $params, 'getVisitorsData', 'getVisitorsInputs');
}
else if($params["action"] == "create")
{
  $frame = getCreateForm("Visitors", "Visitors.php", "VisitorsEdit.php", $params, 'getVisitorsInputs');
}

$configDB->closeDB();

echo $frame;

echo getBackButton("Visitors.php", "Back to Visitors");

include("postInc.inc");

?>
