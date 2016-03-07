<?php

$pageName = "LocationsEdit.php";
$pageTitle = "Locations administration";

include("preInc.inc");

$params = array();

if($_GET)
{
  $params = $_GET;
}

$frame = "";

if($params["action"] == "Apply")
{
  if(!$params["name"])
    {
      $frame = errorInput("Error empty Location name.");
    } // check if we have to insert or update
  else if(isset($params["id"]))
    {
      $frame = processUpdate("Location", "Locations.php", $params, processLocationUpdateQuery);
    }
  else 
    {
      $frame = processInsert("Location", "LocationsEdit.php", $params, processLocationInsertQuery);
    }
}
else if($params["action"] == "Delete")
{
  $frame = processDelete("Location", "Locations.php", $params, processLocationDeleteQuery);
}
else if($params["action"] == "edit")
{
  $frame = getEditForm("Location", "Locations.php", "LocationsEdit.php", $params, getLocationData, getLocationInputs);
}
else if($params["action"] == "create")
{
  $frame = getCreateForm("Location", "Locations.php", "LocationsEdit.php", $params, getLocationInputs);
}

echo $frame;

echo getBackButton("Locations.php", "Back to Locations");

include("postInc.inc");

?>
