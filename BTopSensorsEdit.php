<?php

$pageName = "BTopSensorsEdit.php";
$pageTitle = "B-Top sensors administration";

include("preInc.inc");

$params = array();

if($_GET)
{
  $params = $_GET;
}

$frame = "";

if($params["action"] == "Apply")
{  
  if(isset($params["doorsens"]))
    {
      list($door, $sens) = split(',', $params["doorsens"]);
      $params["door"] = $door;
      $params["sens"] = $sens;
    }
  if(!$params["clientId"])
    {
      $frame = errorInput("Error empty clientId name.");
    } // check if we have to insert or update  
  else if(isset($params["id"]))
    {
      $frame = processUpdate("B-Top sensor", "BTopSensors.php", $params, 'processBTopSensorUpdateQuery');
    }
  else
    {
      $frame = processInsert("B-Top sensor", "BTopSensorsEdit.php", $params, 'processBTopSensorInsertQuery');
    }
}
else if($params["action"] == "Delete")
{
  $frame = processDelete("B-Top sensor", "BTopSensors.php", $params, 'processBTopSensorDeleteQuery');
}
else if($params["action"] == "edit")
{
  $frame = getEditForm("B-Top sensor", "BTopSensors.php", "BTopSensorsEdit.php", $params, 'getBTopSensorData', 'getBTopSensorInputs');
}
else if($params["action"] == "create")
{
  $frame = getCreateForm("B-Top sensor", "BTopSensors.php", "BTopSensorsEdit.php", $params, 'getBTopSensorInputs');
}

echo $frame;

echo getBackButton("BTopSensors.php", "Back to B-Top Sensors");

include("postInc.inc");

?>
