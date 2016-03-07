<?php

$pageName = "BQueueSensorsEdit.php";
$pageTitle = "B-Queue sensors administration";

include("preInc.inc");

$params = array();

if($_GET)
{
  $params = $_GET;
}

$frame = "";

if($params["action"] == "Apply")
{
  if(!$params["clientId"])
    {
      $frame = errorInput("Error empty clientId name.");
    } // check if we have to insert or update  
  else if(isset($params["id"]))
    {
      $frame = processUpdate("B-Queue sensor", "BQueueSensors.php", $params, processBQueueSensorUpdateQuery);
    }
  else
    {
      $frame = processInsert("B-Queue sensor", "BQueueSensorsEdit.php", $params, processBQueueSensorInsertQuery);
    }
}
else if($params["action"] == "Delete")
{
  $frame = processDelete("B-Queue sensor", "BQueueSensors.php", $params, processBQueueSensorDeleteQuery);
}
else if($params["action"] == "edit")
{
  $frame = getEditForm("B-Queue sensor", "BQueueSensors.php", "BQueueSensorsEdit.php", $params, getBQueueSensorData, getBQueueSensorInputs);
}
else if($params["action"] == "create")
{
  $frame = getCreateForm("B-Queue sensor", "BQueueSensors.php", "BQueueSensorsEdit.php", $params, getBQueueSensorInputs);
}

echo $frame;

echo getBackButton("BQueueSensors.php", "Back to B-Queue Sensors");

include("postInc.inc");

?>
