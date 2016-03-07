<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

$clientBluePortail = false;

function startElement($parser, $tagName, $attrs)
{
  global $flowElt;
  global $curTagName;

  $curTagName = $tagName;

  if($tagName == "FLOWPROCESSINGELT")
    {
      $flowElt = array( "id" => 0, "flowid" => 0, "nameF" => 0, "entity" => "door" );
    }
}

function endElement($parser, $tagName)
{
  global $flowList;
  global $flowElt;

  if($tagName == "FLOWPROCESSINGELT")
    {
      $flowList[] = $flowElt;
    }
}

function tagData($parser, $data)
{
  global $flowElt;
  global $curTagName;

  if($curTagName == "ID" && is_numeric($data))
    {
      $flowElt["id"] = (int) $data;
    } 
  else if($curTagName == "FLOWID" && is_numeric($data))
    {
      $flowElt["flowid"] = (int) $data;
    }
  else if($curTagName == "NAMEF" && strlen($data) > 1) // de la merde
    {
      $flowElt["nameF"] = $data;
    }
  else if($curTagName == "ENTITY" && strlen($data) > 1)
    {
      $flowElt["entity"] = $data;
    }
}

/**
 * Returns the url with extra input parameters used
 * by BluePortail if activated
 */
function getBluePortailURL($url)
{
  global $clientBluePortail;

  $ret = $url;

  if($clientBluePortail)
    {
      $data = explode("?", $url, 2);
      if($data)
	{
	  $ret = $data[0];
	  $ret .= "?clientBluePortail=" . $clientBluePortail;
	  if(isset($data[1]))
	    {
	      $ret .= "&" . $data[1];
	    }
	}      
    }
  return $ret;
}


// parse date before so date param could be used
// into configuration file (email subject...)
date_default_timezone_set("Europe/Paris");
if(isset($_REQUEST) and isset($_REQUEST["DateValue"])) 
  {
    $date = $_REQUEST["DateValue"];
  }
else 
  {
    // get the yesterday date
    $date = strftime("%Y-%m-%d", 
		     mktime(1, 0, 0, 
			    (int) date('m'), 
			    (int) date('d') - 1, 
			    (int) date('Y'))); 
  }

define ('BLUEPORTAILROOT', "/home/DATA/BluePortail/clients/" );

// Check if BluePortail is actived to source the right conf file
if(isset($_REQUEST) and isset($_REQUEST["clientBluePortail"]))
  {
    $clientBluePortail = $_REQUEST["clientBluePortail"];
    include_once(BLUEPORTAILROOT . "/" . $clientBluePortail . "/BTopLocalServer/" . "ConfigMonitoringBluePortail.inc");
  }
else
  {
    include_once("ConfigMonitoringBluePortail.inc");
  }

$data = file_get_contents(getBluePortailURL("http://$bcmServer//BTopLocalServer/BCMServer.php?function=getProcessingValues"));

$parser = xml_parser_create();
xml_set_element_handler($parser, "startElement", "endElement");
xml_set_character_data_handler($parser, "tagData");

$flowList = array();
$flowElt = array();
$curTagName = false;

xml_parse($parser, $data, true);
xml_parser_free($parser);

$output = "Porte ; Date ; Entrees ; Sorties\n";

foreach($flowList as $k => $v) 
  {
    $flowid = $v["flowid"];
    $entity = $v["entity"];
    $url = getBluePortailURL("http://$bcmServer//BlueCountGUI/IndicatorCSV.php?login=$bcmLogin&access=1&Step=hour&Analysis=flows&Format=tabular&Entity=$entity&id=$flowid&DateValue=$date&rfunc=getCountersIds&CompPeriod=day&TitleMode=simple");
    $str = file($url);

    if(count($str))
      {
	$switchCol = false;
	$titles = explode(";", $str[0]);
	$title1 = trim(trim($titles[1]), '"');
	$title2 = trim(trim($titles[2]), '"');
	if(($title1 == $comZoneName and 
	   $comZoneType == "input") or
	   ($title2 == $comZoneName and
	   $comZoneType == "output"))
	  {
	    $switchCol = true;
	  }

	for($i = 1; $i < count($str); ++$i)
	  {
	    $cols = explode(";", $str[$i]);
	    if($switchCol)
	      {
		$output .= $v["nameF"] . " ; " . $cols[0] . ";" . trim($cols[2],"\n") . ";" . $cols[1] . "\n";
	      }
	    else
	      {
		$output .= $v["nameF"] . " ; " . $str[$i];
	      }
	  }
      }
  }

if(isset($_REQUEST["noMail"]))
{
  echo $output;
  exit(0);
}

$mailHeaders = "From: $mailFrom\r\n";

//specify MIME version 1.0
$mailHeaders .= "MIME-Version: 1.0\r\n";

//unique boundary
$boundary = uniqid("HTMLDEMO");

//tell e-mail client this e-mail contains//alternate versions
$mailHeaders .= "Content-Type: multipart/mixed; boundary = $boundary\r\n";

// add specific user header
$mailHeaders .= $mailHeader;

//plain text version of message
$mailBody = "--$boundary\r\n" .
  "Content-Type: data/csv; name=\"counting.csv\"\r\n" .
  "Content-Transfer-Encoding: base64\r\n" . 
  "Content-Disposition: attachment; filename=\"counting.csv\"" . "\r\n\r\n";
$mailBody .= chunk_split(base64_encode($output));

//HTML version of message
$mailBody .= "--$boundary\r\n" .
   "Content-Type: text/html; charset=UTF-8\r\n" .
   "Content-Transfer-Encoding: base64\r\n\r\n";
$mailBody .= chunk_split(base64_encode($mailBodyAutoMsg));

if(!mail($mailRcpt, $mailSubject, $mailBody, $mailHeaders))
  {
    die("<b>Cannot send email !</b>");
  }

echo "<html>\n<body>\n";
echo "<p>Counting data for $date :</p>\n";
echo "<pre>\n";
echo $output;
echo "</pre>\n";
echo "<p>The following mail will be delivered to $mailRcpt</p>\n";
echo "<p>The mail subject will be : $mailSubject</p>\n";
echo "<pre>\n";
echo $mailHeaders;
echo $mailBody;
echo "</pre>\n";
echo "</body></html>\n";

?>

