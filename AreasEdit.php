<?php

$pageName = "AreasEdit.php";
$pageTitle = "Areas administration";

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
      $frame = errorInput("Error empty Area name.");
    } // check if we have to insert or update
  else if(!isset($params["locations"]))
    {
      $frame = errorInput("Error empty Location list.");
    }
  else if(isset($params["id"]))
    {
      $frame = processUpdate("Area", "Areas.php", $params, 'processAreaUpdateQuery');
    }
  else
    {
      $frame = processInsert("Area", "AreasEdit.php", $params, 'processAreaInsertQuery');
    }
}
else if($params["action"] == "Delete")
{
  $frame = processDelete("Area", "Areas.php", $params, 'processAreaDeleteQuery');
}
else if($params["action"] == "edit")
{
  $frame = getEditForm("Area", "Areas.php", "AreasEdit.php", $params, 'getAreaData', 'getAreaInputs');
}
else if($params["action"] == "create")
{
  $frame = getCreateForm("Area", "Areas.php", "AreasEdit.php", $params, 'getAreaInputs');
}

echo $frame;

echo getBackButton("Areas.php", "Back to Areas");

include("postInc.inc");

?>
