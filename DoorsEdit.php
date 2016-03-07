<?php

$pageName = "DoorsEdit.php";
$pageTitle = "Doors administration";

include("preInc.inc");

$params = array();

if($_GET)
{
  $params = $_GET;
}

$frame = "";

if($params["action"] == "Apply")
{
  if(! isset($params["idZ1"]) || ! isset($params["idZ2"]))
    {
      if(isset($params["idL1,idL2"]))
	{
	  list($idZ1, $idZ2) = split(',', $params["idL1,idL2"]);
	  $params["idZ1"] = $idZ1;
	  $params["idZ2"] = $idZ2;
	}
      else
	{
	  $frame = errorInput("Missing information.");
	}
    }
  if(!$params["name"])
    {
      $frame = errorInput("Error empty Door name.");
    } // check if we have to insert or update  
  else if ($params["idZ1"] == $params["idZ2"])
    {
      $frame = errorInput("Door cannot be defined from a location to the same.");
    }
  else if(isset($params["id"]))
    {
      $frame = processUpdate("Door", "Doors.php", $params, 'processDoorUpdateQuery');
    }
  else 
    {
      $frame = processInsert("Door", "DoorsEdit.php", $params, 'processDoorInsertQuery');
    }
}
else if($params["action"] == "Delete")
{
  $frame = processDelete("Door", "Doors.php", $params, 'processDoorDeleteQuery');
}
else if($params["action"] == "edit")
{
  $frame = getEditForm("Door", "Doors.php", "DoorsEdit.php", $params, 'getDoorData', 'getDoorInputs');
}
else if($params["action"] == "create")
{
  $frame = getCreateForm("Door", "Doors.php", "DoorsEdit.php", $params, 'getDoorInputs');
}

echo $frame;

echo getBackButton("Doors.php", "Back to Doors");

include("postInc.inc");

?>
