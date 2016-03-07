<?php

$pageName = "WaitingTimeEdit.php";
$pageTitle = "Waiting Time administration";

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
  if(isset($params["flowid,sens"]))
    {
      list($flowid, $sens) = split(',', $params["flowid,sens"]);
      $params["flowid"] = $flowid;
      $params["sens"] = $sens;
    }

  if(isset($params["id"]))
    {
      $frame = processUpdate("Waiting Time", "WaitingTime.php", $params, processWaitingTimeUpdateQuery);
    }
  else
    {
      $frame = processInsert("Waiting Time", "WaitingTimeEdit.php", $params, processWaitingTimeInsertQuery);
    }
}
else if($params["action"] == "Delete")
{
  $frame = processDelete("Waiting Time", "WaitingTime.php", $params, processWaitingTimeDeleteQuery);
}
else if($params["action"] == "edit")
{
  $frame = getEditForm("Waiting Time", "WaitingTime.php", "WaitingTimeEdit.php", $params, getWaitingTimeData, getWaitingTimeInputs);
}
else if($params["action"] == "create")
{
  $frame = getCreateForm("Waiting Time", "WaitingTime.php", "WaitingTimeEdit.php", $params, getWaitingTimeInputs);
}

$configDB->closeDB();

echo $frame;

echo getBackButton("WaitingTime.php", "Back to Waiting Time");

include("postInc.inc");

?>
