<?php

function getEditForm($object, $pageCancel, $pageAction, $params, $dataFunction, $inputFunction)
{
  $id = $params["id"];
  $params = call_user_func($dataFunction, $params);
  $str  = "<div id=\"form\" class=\"Boxes\">\n";
  $str .= "<h2>Edit $object</h2>\n";
  $str .= "<form action=\"$pageAction\">\n";
  $str .= "<input type=\"hidden\" name=\"id\" value=\"" . $id . "\" />\n";
  $str .= call_user_func($inputFunction, $params);
  $str .= getBluePortailInputs();
  $str .= "<div class=\"Bars\" id=\"buttons\">\n";
  $str .= "<ul>\n";
  $str .= "<li><input type=\"submit\" name=\"action\" value=\"Apply\" /></li>\n";
  $str .= "<li><input type=\"submit\" name=\"action\" value=\"Delete\" /></li>\n";
  $str .= "</ul>\n";
  $str .= "</div>\n";
  $str .= "</form>\n";
  $str .= "</div>\n";
  return $str;
}

function getCreateForm($object, $pageCancel, $pageAction, $params, $inputFunction)
{
  $str  = "<div id=\"form\" class=\"Boxes\">\n";
  $str .= "<h2>Add a new $object</h2>\n";
  $str .= "<form action=\"$pageAction\">\n";
  $str .= call_user_func($inputFunction, $params);
  $str .= getBluePortailInputs();
  $str .= "<div class=\"Bars\" id=\"buttons\">\n";
  $str .= "<ul>\n";
  $str .= "<li><input type=\"submit\" name=\"action\" value=\"Apply\" /></li>\n";
  $str .= "</ul>\n";
  $str .= "</div>\n";
  $str .= "</form>\n";
  $str .= "</div>\n";
  return $str;
}

function processUpdate($object, $pageListName, $params, $processUpdateQuery)
{
  call_user_func($processUpdateQuery, $params);
  $str  = "<div id=\"Message\" class=\"Boxes\">\n";
  $str .= "<h2>$object updated.</h2>\n";
  $str .= "</div>\n";
  return $str;
}

function processInsert($object, $pageListName, $params, $processInsertQuery)
{
  call_user_func($processInsertQuery, $params);
  $str  = "<div id=\"Message\" class=\"Boxes\">\n";
  $str .= "<h2>$object created. Click <a href=\"" . getBluePortailURL("$pageListName?action=create") . "\">here</a> to create a new $object.</h2>\n";
  $str .= "</div>\n";
  return $str;
}

function processDelete($object, $pageListName, $params, $processDeleteQuery)
{
  call_user_func($processDeleteQuery, $params);
  $str  = "<div id=\"Message\" class=\"Boxes\">\n";
  $str .= "<h2>$object deleted.</h2>\n";
  $str .= "</div>\n";
  return $str;
}

function errorInput($msg)
{
  $str  = "<div id=\"Message\" class=\"Boxes\">\n";
  $str .= "<h2>$msg</h2>\n";
  $str .= "</div>\n";  
  return $str;
}

function getCalendarInputs($params)
{
  global $clang;
  $str = "<table>\n";
  $str .= "<tr><td>From <select name=\"ts\">\n";

  $hoursStart = array ( "00", "01", "02", "03", "04", "05", 
			"06", "07", "08", "09", "10", "11",
			"12", "13", "14", "15", "16", "17",
			"18", "19", "20", "21", "22", "23" );
  foreach($hoursStart as $k)
    {
      $selected = "";
      if(isset($params["ts"]) and strftime($params["testts"], strtotime($params["ts"])) == $k . "00")
	{
	  $selected = "selected";
	}
      $str .= "<option value=\"2007-01-01 " . $k . ":00:00\" $selected>" . $k . "</option>\n";
    }
  $str .= "</select>h\n";
  $str .= " to<select name=\"te\">\n";

  $hoursEnd = array ( "01", "02", "03", "04", "05", "06", 
		      "07", "08", "09", "10", "11", "12", 
		      "13", "14", "15", "16", "17", "18", 
		      "19", "20", "21", "22", "23", "24" );
  foreach($hoursEnd as $k)
    {
      $selected = "";
      if(isset($params["te"]) and strftime($params["testte"], strtotime($params["te"])) == ($k - 1) . "59")
	{
	  $selected = "selected";
	}
      $str .= "<option value=\"2007-01-01 " . ($k - 1) . ":59:00\" $selected>" . $k . "</option>\n";
    }
  $str .= "</select>h</td></tr>\n";
  $str .= "</table>\n";
  $str .= "<input type=\"hidden\" name=\"cal\" value=\"" . $params["cal"] . "\"/>\n";
  $str .= "<input type=\"hidden\" name=\"id\" value=\"" . $params["id"] . "\"/>\n";
  $str .= "<input type=\"hidden\" name=\"pri\" value=\"" . $params["pri"] . "\"/>\n";
  $str .= "<input type=\"hidden\" name=\"testts\" value=\"" . $params["testts"] . "\"/>\n";
  $str .= "<input type=\"hidden\" name=\"testte\" value=\"" . $params["testte"] . "\"/>\n";
  $str .= "<input type=\"hidden\" name=\"isOpen\" value=\"" . $params["isOpen"] . "\"/>\n";
  return $str;
}

function getCalendarData($params)
{
  global $clang;
  $data = $clang->getCalendarData($params);
  return $data[0];
}

function processCalendarUpdateQuery($params)
{
  global $clang;
  $clang->processCalendarUpdate($params);
}

function processCalendarInsertQuery($params)
{
  global $clang;
  $clang->processCalendarInsert($params);
}

function processCalendarDeleteQuery($params)
{
  global $clang;
  $clang->processCalendarDelete($params);
}

function getBTopSensorInputs($params)
{
  $params = array_merge(array( "clientId" => "",
			       "channel" => 0,
			       "counter" => 0,
			       "host" => "",
			       "descr" => "" ), $params);

  global $clang;
  $str = "<table>\n";
  $str .= "<tr><td>ClientId :</td><td><input type=\"text\" name=\"clientId\" value=\"" . htmlentities($params["clientId"]) . "\"></td></tr>\n";
  //$str .= "<tr><td>Channel :</td><td><input id=\"remoteChannel\" type=\"text\" name=\"channel\" value=\"" . htmlentities($params["channel"]) . "\"></td></tr>\n";
  //  $str .= "<tr><td>Counter :</td><td><input type=\"text\" name=\"counter\" value=\"" . htmlentities($params["counter"]) . "\"></td></tr>\n";
  $str .= "<tr><td>Channel :</td><td><select name=\"channel\">\n";
  for($i = 0; $i <= 255; $i++)
    {
      $str .= "<option value=\"$i\" " . (($params["channel"] == $i) ? "selected" : "") . ">$i</option>\n";
    }
  $str .= "</select></td></tr>\n";
  $str .= "<tr><td>Counter :</td><td><select name=\"counter\">";
  for($i = 0; $i <= 1; $i++)
    {
      $str .= "<option value=\"$i\" ". (($params["counter"] == $i) ? "selected" : "") .">$i</option>\n";
    }
  $str .= "</select></td></tr>\n";
  $str .= "<tr><td>Host :</td><td><input id=\"remoteHost\" type=\"text\" name=\"host\" value=\"" . htmlentities($params["host"]) . "\"/></td></tr>\n";
  $str .= "<tr><td>Descr :</td><td><input type=\"text\" name=\"descr\" value=\"" . htmlentities($params["descr"]) . "\"/></td></tr>\n";  
  $str .= "<tr><td colspan=\"2\"><input type=\"button\" value=\"View remote sensor configuration\" " .
    "onClick=\"BTopLocalServer_viewBTopSensorConfig(document.getElementById('remoteChannel').value, " .
    "document.getElementById('remoteHost').value)\"></td></tr>\n";  
  $odoors = $clang->getOrientedDoors();
  $str1 = "<select name=\"doorsens\">\n";
  foreach($odoors as $obj)
    {
      $selected = "";
      if(isset($params["door"]) and $params["door"] == $obj["id"] and 
	 isset($params["sens"]) and $params["sens"] == $obj["sens"])
	{
	  $selected = "selected";
	}
      $str1 .= "<option value=\"" . $obj["id"] .",". $obj["sens"] . "\" $selected>" . htmlentities($obj["door"] . " [" . $obj["nameL1"] . " => " . $obj["nameL2"]) . "]</option>\n";
    }
  $str1 .= "</select>\n";
  $str .= "<tr><td>Door :</td><td>" . $str1 . "</td></tr>\n";
  $str .= "</table>\n";
  $str .= "<input type=\"hidden\" name=\"type\" value=\"B-TOP\" />\n";
  return $str;
}

function getBTopSensorData($params)
{
  global $clang;
  $data = $clang->getBTopSensorData($params);
  return $data[0];
}

function processBTopSensorUpdateQuery($params)
{
  global $clang;
  $clang->processBTopSensorUpdate($params);
}

function processBTopSensorInsertQuery($params)
{
  global $clang;
  $clang->processBTopSensorInsert($params);
}

function processBTopSensorDeleteQuery($params)
{
  global $clang;
  $clang->processBTopSensorDelete($params);
}

function processBQueueSensorUpdateQuery($params)
{
  global $clang;
  $clang->processBQueueSensorUpdate($params);
}

function processBQueueSensorInsertQuery($params)
{
  global $clang;
  $clang->processBQueueSensorInsert($params);
}

function processBQueueSensorDeleteQuery($params)
{
  global $clang;
  $clang->processBQueueSensorDelete($params);
}

function getBQueueSensorInputs($params)
{
  global $clang;
  $str = "<table>\n";
  $str .= "<tr><td>ClientId :</td><td><input type=\"text\" name=\"clientId\" value=\"" . htmlentities($params["clientId"]) . "\"></td></tr>\n";
  $str .= "<tr><td>Channel :</td><td><input id=\"remoteChannel\" type=\"text\" name=\"channel\" value=\"" . htmlentities($params["channel"]) . "\"></td></tr>\n";
  //$str .= "<tr><td>Region :</td><td><input type=\"text\" name=\"region\" value=\"" . htmlentities($params["region"]) . "\"></td></tr>\n";
  $str .= "<tr><td>Host :</td><td><input id=\"remoteHost\" type=\"text\" name=\"host\" value=\"" . htmlentities($params["host"]) . "\"/></td></tr>\n";
  $str .= "<tr><td>Descr :</td><td><input type=\"text\" name=\"descr\" value=\"" . htmlentities($params["descr"]) . "\"/></td></tr>\n";  
  $str .= "<tr><td colspan=\"2\"><input type=\"button\" value=\"View remote sensor configuration\" " .
    "onClick=\"BTopLocalServer_viewBTopSensorConfig(document.getElementById('remoteChannel').value, " .
    "document.getElementById('remoteHost').value)\"></td></tr>\n";  
  $locs = $clang->getLocations();
  $str1 = "<select name=\"location\">\n";
  foreach($locs as $obj)
    {
      $selected = "";
      if(isset($params["location"]) and $params["location"] == $obj["id"])
	{
	  $selected = "selected";
	}
      $str1 .= "<option value=\"" . $obj["id"] . "\" $selected>" . htmlentities($obj["name"]) . "</option>\n";
    }
  $str1 .= "</select>\n";
  $str .= "<tr><td>Location :</td><td>" . $str1 . "</td></tr>\n";
  $str .= "</table>\n";
  $str .= "<input type=\"hidden\" name=\"type\" value=\"B-QUEUE\" />\n";
  return $str;
}

function getBQueueSensorData($params)
{
  global $clang;
  $data = $clang->getBQueueSensorData($params);
  return $data[0];
}

function getLocationInputs($params)
{
  $params = array_merge(array( "name" => ""), $params);

  $str = "<table>\n";
  $str .= "<tr><td>Name :</td><td><input type=\"text\" name=\"name\" value=\"" . htmlentities($params["name"]) . "\"></td></tr>\n";
  $str .= "<input type=\"hidden\" name=\"virtual\" value=\"0\">\n";
  $str .= "</table>\n";
  return $str;
}

function getLocationData($params)
{
  global $clang;
  $data = $clang->getLocationData($params);
  return $data[0];
}

function processLocationUpdateQuery($params)
{
  global $clang;
  $clang->processLocationUpdate($params);
}

function processLocationInsertQuery($params)
{
  global $clang;
  $clang->processLocationInsert($params);
}

function processLocationDeleteQuery($params)
{
  global $clang;
  $clang->processLocationDelete($params);
}

function getDoorInputs($params)
{
  $params = array_merge(array( "name" => ""), $params);

  global $clang;
  $str = "<table>\n";
  $str .= "<tr><td>Name :</td><td><input type=\"text\" name=\"name\" value=\"" . htmlentities($params["name"]) . "\"></td></tr>\n";
  $str .= "<tr><td>Locations :</td><td>";
  $locationPairs = $clang->getLocationPairs($params);
  $str .= "<select name=\"idL1,idL2\">\n";
  foreach($locationPairs as $obj)
    {     
      $idZ1 = $obj["idL1"];
      $idZ2 = $obj["idL2"];
     
      $selected = "";
      if(isset($params["idZ1"]) and $params["idZ1"] == $idZ1 and 
	 isset($params["idZ2"]) and $params["idZ2"] == $idZ2)
	{
	  $selected = "selected";
	}
      
      $str .= "<option value=\"" . $idZ1. "," . $idZ2 . "\" $selected>" . htmlentities($obj["nameL1"]) . ", " . htmlentities($obj["nameL2"]) . "</option>\n";
    }

  $str .= "</select>\n";  
 
  $str .= "</td></tr>\n";
  $str .= "</table>\n";
  return $str;
}

function getDoorData($params)
{
  global $clang;
  return $clang->getDoorData($params);
}

function processDoorUpdateQuery($params)
{
  global $clang;
  $clang->processDoorUpdate($params);
}

function processDoorInsertQuery($params)
{
  global $clang;
  $clang->processDoorInsert($params);
}

function processDoorDeleteQuery($params)
{
  global $clang;
  $clang->processDoorDelete($params);
}

function getGroupInputs($params)
{
  $params = array_merge(array( "name" => ""), $params);

  global $clang;
  $str = "<table>\n";

  $str .= "<tr><td>Name :</td><td colspan=\"3\"><input type=\"text\" name=\"name\" value=\"" . htmlentities($params["name"]) . "\"></td></tr>\n";
  $str .= "<tr><td>From :</td><td>";
  $str .= "<select name=\"idZ1,idZ2\">\n";
  $zonePairs = $clang->getZonePairsWhereDoor();
  foreach($zonePairs as $obj)
    {
      $selected = "";
      if(isset($params["idZ1"]) and $params["idZ1"] == $obj["idZ1"] and
	 isset($params["idZ2"]) and $params["idZ2"] == $obj["idZ2"])
	{
	  $selected = "selected=\"selected\"";
	}
      $str .= "<option value=\"". $obj["idZ1"] . "," . $obj["idZ2"] ."\"" . $selected . ">" . htmlentities($obj["nameZ1"]) . ", " . htmlentities($obj["nameZ2"]) . "</option>\n";
    }
  $str .= "</select>\n";
  $str .= "</td></tr>\n";

  /*
  $doors = $clang->getDoors($params);
  $str .= "<tr><td>Doors :</td><td colspan=\"3\">";
  $str .= "<select name=\"doors[]\" multiple>\n";
  foreach($doors as $obj)
    {
      $selected = "";
      if(isset($params["doors"]) and in_array($obj["id"] . "_1", $params["doors"]))
	{
	  $selected = "selected";
	}
      $str .= "<option value=\"" . $obj["id"] . "_1\" $selected>" . htmlentities($obj["name"] . " [" . $obj["nameL1"] . " => " . $obj["nameL2"]) . "]</option>\n";

      $selected = "";
      if(isset($params["doors"]) and in_array($obj["id"] . "_2", $params["doors"]))
	{
	  $selected = "selected";
	}
      $str .= "<option value=\"" . $obj["id"] . "_2\" $selected>" . htmlentities($obj["name"] . " [" . $obj["nameL2"] . " => " . $obj["nameL1"]) . "]</option>\n";
    }
  $str .= "</select>\n";
  $str .= "</td></tr>\n";
  */
  $str .= "</table>\n";
  return $str;
}

function getGroupData($params)
{
  global $clang;
  return $clang->getGroupData($params);
}

function processGroupUpdateQuery($params)
{
  global $clang;
  $clang->processGroupUpdate($params);
}

function processGroupInsertQuery($params)
{
  global $clang;
  $clang->processGroupInsert($params);
}

function processGroupDeleteQuery($params)
{
  global $clang;
  $clang->processGroupDelete($params);
}

function getAreaInputs($params)
{
  $params = array_merge(array( "name" => "" ), $params);

  global $clang;
  $str = "<table>\n";
  $str .= "<tr><td>Name :</td><td><input type=\"text\" name=\"name\" value=\"" . htmlentities($params["name"]) . "\"></td></tr>\n";
  $locations = $clang->getLocations($params);
  $str .= "<tr><td>Locations :</td><td>";
  $str .= "<select name=\"locations[]\" multiple>\n";
  foreach($locations as $obj)
    {
      $selected = "";
      if(isset($params["locations"]) and in_array($obj["id"], $params["locations"]))
	{
	  $selected = "selected";
	}
      $str .= "<option value=\"" . $obj["id"] . "\" $selected>" . htmlentities($obj["name"]) . "</option>\n";
    }
  $str .= "</select>\n";
  $str .= "</td></tr>\n";
  $str .= "</table>\n";
  return $str;
}

function getAreaData($params)
{
  global $clang;
  $data = $clang->getAreaData($params);
  $obj = $data[0];
  $obj["locations"] = array();
  foreach($data as $v)
    {
      $obj["locations"][] = $v["idL"];
    }
  return $obj;
}

function processAreaUpdateQuery($params)
{
  global $clang;
  $clang->processAreaUpdate($params);
}

function processAreaInsertQuery($params)
{
  global $clang;
  $clang->processAreaInsert($params);
}

function processAreaDeleteQuery($params)
{
  global $clang;
  $clang->processAreaDelete($params);
}

function getNumberingInputs($params)
{
  global $clang;
  $str = "<table>\n";
  $str .= "<tr><td>Location :</td><td>";

  if(isset($params["id"]))
    {
      $str .= "<input type=\"text\" name=\"name\" value=\"" . htmlentities($params["name"]) . "\" readonly></input>";
    }
  else
    {
      $locs = $clang->getLocations();
      $str .= "<select name=\"id\">\n";
      foreach($locs as $obj)
	{
	  $str .= "<option value=\"" . $obj["id"] . "\">" . htmlentities($obj["name"]) . "</option>\n";
	}
      $str .= "</select>\n";
    }
  $str .= "</td></tr>\n";
  $str .= "</table>\n";
  return $str;
}

function getNumberingData($params)
{
  global $clang;
  $params["Entity"] = "location";
  return $clang->getNumberingData($params);
}

function processNumberingInsertQuery($params)
{
  global $clang;
  $clang->processNumberingInsert($params);
}

function processNumberingDeleteQuery($params)
{
  global $clang;
  $clang->processNumberingDelete($params);
}

function getVisitorsInputs($params)
{
  global $clang;
  $str = "<table>\n";
  $str .= "<tr><td>Location :</td><td>";

  if(isset($params["id"]))
    {
      $str .= "<input type=\"text\" name=\"name\" value=\"" . htmlentities($params["name"]) . "\" readonly></input>";
    }
  else
    {
      $locs = $clang->getLocations();
      $str .= "<select name=\"id\">\n";
      foreach($locs as $obj)
	{
	  $str .= "<option value=\"" . $obj["id"] . "\">" . htmlentities($obj["name"]) . "</option>\n";
	}
      $str .= "</select>\n";
    }
  $str .= "</td></tr>\n";
  $str .= "</table>\n";
  return $str;
}

function getVisitorsData($params)
{
  global $clang;
  $params["Entity"] = "location";
  return $clang->getVisitorsData($params);
}

function processVisitorsInsertQuery($params)
{
  global $clang;
  $clang->processVisitorsInsert($params);
}

function processVisitorsDeleteQuery($params)
{
  global $clang;
  $clang->processVisitorsDelete($params);
}

function getWaitingTimeInputs($params)
{
  global $clang;
  $str = "<table>\n";
  $str .= "<tr><td>Location/Area :</td><td>";
  $str .= "<select name=\"zoneid\">\n";

  $areas = $clang->getZonesWithNumberingProcessing();
  foreach($areas as $obj)
    {
      $selected = "";
      if(isset($params["zoneid"]) and $params["zoneid"] == $obj["id"])
	{
	  $selected = "selected";
	}
      $str .= "<option value=\"" . $obj["id"] . "\" $selected>" . $obj["name"] . "</option>\n";
    }

  $str .= "</select>\n";
  $str .= "</td></tr><tr><td>Door/Door Group :</td><td>";
  $str .= "<select name=\"flowid,sens\">\n";

  $flows = $clang->getFlowsWithCountingProcessing();
  foreach($flows as $obj)
    {
      $selected1 = "";
      $selected2 = "";
      if(isset($params["flowid"]) and $params["flowid"] == $obj["id"] and isset($params["sens"]))
	{
	  if($params["sens"] == 1) $selected1 = "selected";
	  if($params["sens"] == 2) $selected2 = "selected";
	}
      $str .= "<option value=\"" . $obj["id"] . ",1" . "\" $selected1>" . $obj["name"] . " [" . $obj["nameZ1"] ." => ". $obj["nameZ2"] . "]</option>\n";
      $str .= "<option value=\"" . $obj["id"] . ",2" . "\" $selected2>" . $obj["name"] . " [" . $obj["nameZ2"] ." => ". $obj["nameZ1"] . "]</option>\n";
    }
  $str .= "</select>\n";
  $str .= "</td></tr><tr><td>Type :</td><td>\n";  
  $str .= "<select name=\"wt_id\">\n";
  $wtType = $clang->getWaitingTimeType();
  foreach($wtType as $obj)
    {
      $selected = "";
      if(isset($params["wt_id"]) and $params["wt_id"] == $obj["id"])
	{
	  $selected = "selected";
	}
      $str .= "<option value=\"" . $obj["id"] . "\" $selected>" . $obj["name"] . "</option>\n";
    }


  $str .= "</select>\n";
  $str .= "</td></tr>\n";
  $str .= "</table>\n";
  return $str;
}

function getWaitingTimeData($params)
{
  global $clang;
  $data = $clang->getWaitingTimeData($params);
  return $data[0];
}

function processWaitingTimeUpdateQuery($params)
{
  global $clang;
  $clang->processWaitingTimeUpdate($params);
}

function processWaitingTimeInsertQuery($params)
{
  global $clang;
  $clang->processWaitingTimeInsert($params);
}

function processWaitingTimeDeleteQuery($params)
{
  global $clang;
  $clang->processWaitingTimeDelete($params);
}

function getBackButton($url, $title)
{
  $str = "<div id=\"barHome\">\n";
  $str .= "<form action=\"$url\" method=\"get\">\n";
  $str .= getBluePortailInputs(); 
  $str .= "<button id=\"Home\" type=\"submit\" value=\"$title\" >$title</button>\n";
  $str .= "</form>\n";
  $str .= "</div>\n";
  return $str;
}

function processTimeZoneUpdateQuery($params)
{
  global $clang;
  $clang->processTimeZoneUpdate($params);
}

function getTimeZoneInputs($params)
{
  global $clang;
  $str = "<select name=\"tz\">\n";
  $timezone_list = timezone_identifiers_list();
  foreach($timezone_list as $v)
    {
      $selected = "";
      if($v == $params["tz"])
	{
	  $selected = "selected";
	}
      $str .= "<option value=\"" . $v . "\" $selected>" . $v . "</option>\n";
    }

  $str .= "</select>\n";
  return $str;
}

function getTimeZoneData($params)
{
  global $clang;
  $data = $clang->getTimeZoneData($params);
  return $data[0];
}

?>
