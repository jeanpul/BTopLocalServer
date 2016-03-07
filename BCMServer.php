<?php

/**
 * @file BCMServer.php
 * @author fabien.pelisson@blueeyevideo.com
 *
 * Communication with BlueCountLang.inc using a SoapServer
 * Access to BlueCountLang methods is limited by using
 * an intermediate class BCMServer
 */

error_reporting(E_ALL);
ini_set('display_errors', '1');

include_once('Config.inc');

loadBluePHP();

include_once("BlueCountLang.inc");
include_once("BluePHP/DateOps.inc");

class BCMServer
{
  var $clang = false;

  function BCMServer($clang)
    {
      $this->clang = $clang;
      $tz = $this->clang->getTimeZoneData( array() );
      $timezone = $tz[0]["tz"];
      date_default_timezone_set($timezone);
    }

  function callFunction($funcname, $params)
  {
    return call_user_func(array($this, $funcname), $params);
  }

  function getFlowProcessing($params)
  {
    return array ( "FlowProcessing" => $this->clang->callFunction("getFlowCountingProcessing", $params) );
  }

  function getNumberingProcessing($params)
  {
    return array ( "NumberingProcessing" => $this->clang->callFunction("getZoneNumberingProcessing", $params) );
  }

  function getWaitingTimeProcessing($params)
  {
    return array( "WaitingTimeProcessing" => $this->clang->callFunction("getZoneWaitingTimeProcessing", $params) );
  }

  function getProcessTimeProcessing($params)
  {
    return array( "ProcessTimeProcessing" => $this->clang->callFunction("getZoneProcessTimeProcessing", $params) );
  }

  function getNumberingValues($params)
  {
    return array( "NumberingValues" => $this->clang->callFunction("getNumberingValues", $params) );
  }

  function getWaitingTimeValues($params)
  {
    return array( "WaitingTimeValues" => $this->clang->callFunction("getWaitingTimeValues", $params) );
  }

  function getFlowValues($params)
  {
    return array( "FlowValues" => $this->clang->callFunction("getCountersValues", $params) ); 
  }

  function getProcessTimeValues($params)
  {
    return array( "ProcessTimeValues" => $this->clang->callFunction("getProcessTimeValues", $params) );
  }

  function getProcessingValues($params)
  {
    $result = $this->getFlowProcessing($params);
    $result += $this->getNumberingProcessing($params);    
    $result += $this->getWaitingTimeProcessing($params);
    //$result += $this->getProcessTimeProcessing($params);
    return $result;
  }

  function getOneMinuteValues($params)
  {
    $result = null;
    if(isset($params["TimeStr"]))
      {
	// get only data for 1 minute
	$params["Step"] = "minute";
	$params["CompPeriod"] = "minute";
	// remove idp to have all entities
	$params["idp"] = null;
	
	$params["Entity"] = "door";
	$result = $this->getFlowValues($params);
	$params["Entity"] = "location";
	$result += $this->getNumberingValues($params);
	$result += $this->getWaitingTimeValues($params);
	$result += $this->getProcessTimeValues($params);
      }
    return $result;
  }

  protected function getMergedDataOnId($data, $sep = ";")
  {
    $result = array();
    if(is_array($data) and count($data))
      {
	$data_merged = $data[0];
	for($i = 1; $i < count($data); ++$i)
	  {
	    foreach($data[$i] as $dk => $dv)
	      {
		if($dk != "id")
		  {
		    $data_merged[$dk] .= $sep . $dv;
		  }
	      }
	  }
	$result += $data_merged;
      }
    return $result;
  }

  function getMergedValues($processingName, $funcProcessing, $funcValues, $params)
  {
    $processing = $this->clang->callFunction($funcProcessing, array());
    $result = array();
    foreach($processing as $pk => $pv)
      {
	$params["idp"] = $pv["id"];
	$result[] = $this->getMergedDataOnId($this->clang->callFunction($funcValues, $params)); 
      }    
    return array( $processingName => $result );    
  }

  function getMergedFlowValues($params)
  {
    return $this->getMergedValues("FlowValue", "getFlowCountingProcessing", "getCountersValues", $params);
  }

  function getMergedNumberingValues($params)
  {
    return $this->getMergedValues("NumberingValues", "getZoneNumberingProcessing", "getNumberingValues", $params);
  }

  function getMergedWaitingTimeValues($params)
  {
    return $this->getMergedValues("WaitingTimeValues", "getZoneWaitingTimeProcessing", "getWaitingTimeValues", $params);
  }

  function getMergedProcessTimeValues($params)
  {
    return $this->getMergedValues("ProcessTimeValues", "getZoneProcessTimeProcessing", "getProcessTimeValues", $params);
  }

  function getOneDayValues($params)
  {
    $result = null;
    if(isset($params["TimeStr"]))
      {
	$params["Step"] = "minute";
	$params["CompPeriod"] = "day";
	$params["idp"] = null;
	$params["Entity"] = "door";
	$result = $this->getMergedFlowValues($params);
	$params["Entity"] = "location";
	$result += $this->getMergedNumberingValues($params);
	$result += $this->getMergedWaitingTimeValues($params);
	$result += $this->getMergedProcessTimeValues($params);
      }
    return $result;
  }

  function getOneDayWaitingTimeValues($params)
  {
    $result = null;
    if(isset($params["TimeStr"]))
      {
	$params["Step"] = "minute";
	$params["CompPeriod"] = "day";
	$params["idp"] = null;
	$params["Entity"] = "location";
	$result = $this->getMergedWaitingTimeValues($params);
      }
    return $result;
  }

  function getLastDayValues($params)
  {
    $params["TimeStr"] = $this->clang->getLastPushTask();
    return $this->getOneDayValues($params);
  }

  function getLastMinuteValues($params)
  {
    $timestr = $this->clang->getLastPushTask();
    $timestamp = subTime(mktimeFromString($timestr),
			 array( "hour" => 0,
				"minute" => 1,
				"second" => 0,
				"month" => 0,
				"day" => 0,
				"year" => 0 ));
    return $this->getOneMinuteValues(array( "TimeStamp" => $timestamp,
					    "TimeStr" => $timestr ));
  }

}

function print_array_keys($a, $eltName)
{
  if(!is_array($a))
    {
      return "<$eltName>" . $a . "</$eltName>\n";
    }

  if(!count($a))
    {
      return "";
    }

  $isList = is_int(key($a));

  $str = "";
  $str .= "<$eltName>\n";
  foreach($a as $k => $v)
    {
      if($isList)
	{
	  $k = $eltName . "Elt";
	}
      $str .= print_array_keys($v, $k);
    }
  $str .= "</$eltName>\n";
  return $str;
}


$params = array();

if(isset($_GET))
{
  $params = $_GET;
}

$clang = new BlueCountLang(false);
$tz = $clang->getTimeZoneData(array());
date_default_timezone_set($tz[0]["tz"]);

$bcmServer = new BCMServer($clang);

header("Content-Type: text/xml");
if(!isset($params["function"]) or $params["function"] == "getAPI")
  {
    // display WSDL API
    echo file_get_contents("BCMServer.wsdl");
  }
else
  {
    $elts = $bcmServer->callFunction($params["function"], $params);  
    if(!$elts or !is_array($elts))
      {
	$elts = array( "Error" => array( "Message" => "Incorrect parameters", "Number" => "1" ));
      }   
    echo '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
    if(is_array($elts))
      {
	echo print_array_keys($elts, "BCMServerData");
      }
  }

$clang->close();

?>
