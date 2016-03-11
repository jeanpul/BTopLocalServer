<html>
<body>

<?php

include_once('Config.inc');

loadBluePHP();

include_once("BlueCountLang.inc");
include_once("BluePHP/DBConnect.inc");

function BTopServer_buildBTopKey($client, $channel, $counter)
{
  return "${client}_B-TOP_${channel}_${counter}";
}

function BTopServer_buildBQueueKey($client, $channel, $region)
{
  return "${client}_B-QUEUE_${channel}_${region}";
}

function BTopServer_grabCounter($params)
{
  $fin = fopen(TMP_COUNTER_FILE, "a");
  if($fin)
  {  
    $ref = BTopServer_buildBTopKey($params["client"], $params["channel"], $params["counter"]);
    $query = "insert into counting(ref, value, time) values(\"$ref\", " . $params["value"] . ", \"" . $params["timeStart"] . "\");\n";
    fwrite($fin, $query);
    fclose($fin);
  }
}

function BTopServer_grabNumbering($params)
{
  global $clang;

  $fin = fopen(TMP_NUMBERING_FILE, "a");
  if($fin)
  {
    $ref = BTopServer_buildBQueueKey($params["client"], $params["channel"], $params["region"]);
    $query = "insert into numbering(ref, value, time) values(\"$ref\", " . $params["value"] . ", \"" . $params["timestamp"] . "\");\n";
    fwrite($fin, $query);
    fclose($fin);
  }
}

openlog("BlueCountServer GrabCounter : ", LOG_PID, LOG_USER);


if(!isset($_GET["test"]))
{
  // create a connection to the BlueCountLang
  $clang = new BlueCountLang(true);

  if($_GET["type"] == 144)
    {
      $timestampUTC = $_GET["timeStart"];
      $_GET["timeStart"] = $clang->convertToTimeZone($_GET["timeStart"]);
      syslog(LOG_INFO, 
	     "Counter(144) " . $_GET["client"] . " " . 
	     $_GET["channel"] . " " . $_GET["counter"] . " " . 
	     $_GET["value"] . " " . $_GET["timeStart"] . " ($timestampUTC UTC) (" . 
	     $_GET["timeEnd"] . " UTC)");
      BTopServer_grabCounter($_GET);
    }
  else if($_GET["type"] == 145)
    {
      $timestampUTC = $_GET["timestamp"];
      $_GET["timestamp"] = $clang->convertToTimeZone($_GET["timestamp"]);
      syslog(LOG_INFO, 
	     "Numbering(145) " . $_GET["client"] . " " . 
	     $_GET["channel"] . " " . $_GET["region"] . " " . 
	     $_GET["value"] . " " . $_GET["timestamp"] . " ($timestampUTC UTC)");
      BTopServer_grabNumbering($_GET);
    }
  else if($_GET["type"] == 146)
    {
      $timestampUTC = $_GET["timeStart"];
      $_GET["timeStart"] = $clang->convertToTimeZone($_GET["timeStart"]);
      syslog(LOG_INFO, 
	     "Counter(146) " . $_GET["client"] . " " . 
	     $_GET["channel"] . " " . $_GET["counter0"] . " " . 
	     $_GET["value0"] . " " . $_GET["counter1"] . " " . 
	     $_GET["value1"] . " " . $_GET["timeStart"] . " ($timestampUTC UTC) (" . 
	     $_GET["timeEnd"] . " UTC)");
      BTopServer_grabCounter(array( "client" => $_GET["client"], "channel" => $_GET["channel"], 
				    "counter" => $_GET["counter0"], "value" => $_GET["value0"],
				    "timeStart" => $_GET["timeStart"]) );
      BTopServer_grabCounter(array( "client" => $_GET["client"], "channel" => $_GET["channel"], 
				    "counter" => $_GET["counter1"], "value" => $_GET["value1"],
				    "timeStart" => $_GET["timeStart"]) );
    }

  $clang->close();
}
else
{
  syslog(LOG_INFO, "Asking for BlueHTTP test");
}

closelog();

?>

</body>
</html>
