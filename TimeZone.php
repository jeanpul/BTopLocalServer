<?php

$pageName = "TimeZone.php";
$pageTitle = "TimeZone configuration";

include("preInc.inc");

$params = array();

if($_GET)
{
  $params = $_GET;
}

$frame = "";

if(isset($params["tz"]))
{
  processTimeZoneUpdateQuery($params);
  $frame = "<div id=\"info\"><p>TimeZone period changed.</p></div>\n";
}
else
{
  $frame = "<div id=\"formWide\">\n";
  $frame .= "<h2>Counters TimeZone</h2>\n";
  $frame .= "<p>The BlueCount server use this TimeZone to store the counter values. So changing this will affect the future counters date and time.</p>";
  $frame .= "<div id=\"form\">\n";
  $frame .= "<form action=\"TimeZone.php\" method=\"get\">\n";
  $frame .= getTimeZoneInputs(getTimeZoneData($params));
  $frame .= getBluePortailInputs();
  $frame .= "<button id=\"apply\" type=\"submit\" value=\"Apply\">Apply</button>\n";
  $frame .= "</form>\n";
  $frame .= "</div>\n";
  $frame .= "</div>\n";
}

echo $frame;

echo getBackButton("index.php", "Back to Main menu");

include("postInc.inc");

?>