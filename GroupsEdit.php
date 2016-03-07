<?php

$pageName = "GroupsEdit.php";
$pageTitle = "Groups administration";

include("preInc.inc");

$params = array();

if($_GET)
{
  $params = $_GET;
}

$frame = "";

if($params["action"] == "Apply")
{
  if(isset($params["idZ1,idZ2"]))
    {
      list($idZ1, $idZ2) = split(',', $params["idZ1,idZ2"]);
      $params["idZ1"] = $idZ1;
      $params["idZ2"] = $idZ2;
    }

  if(!$params["name"])
    {
      $frame = errorInput("Error empty Group name.");
    } // check if we have to insert or update  
  else if(isset($params["id"]))
    {
      $frame = processUpdate("Group", "Groups.php", $params, processGroupUpdateQuery);
    }
  else
    {
      $frame = processInsert("Group", "GroupsEdit.php", $params, processGroupInsertQuery);
    }
}
else if($params["action"] == "Delete")
{
  $frame = processDelete("Group", "Groups.php", $params, processGroupDeleteQuery);
}
else if($params["action"] == "edit")
{
  $frame = getEditForm("Group", "Groups.php", "GroupsEdit.php", $params, getGroupData, getGroupInputs);
}
else if($params["action"] == "create")
{
  $frame = getCreateForm("Group", "Groups.php", "GroupsEdit.php", $params, getGroupInputs);
}

echo $frame;

echo getBackButton("Groups.php", "Back to Groups");

include("postInc.inc");

?>
