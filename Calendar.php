<?php

$pageName = "Calendar.php";
$pageTitle = "Calendar administration";

include("preInc.inc");

$params = array();

if($_GET)
{
  $params = $_GET;
}

$frame = "";

if(isset($params["id"]))
{
  if($params["ts"] >= $params["te"])
    {
      $frame = "<div id=\"error\"><p>Starting period could not be greater or equal to the end of the period.</p></div>\n";
    }
  else
    {
      processCalendarUpdateQuery($params);
      $frame = "<div id=\"info\"><p>Counting processing period changed.</p></div>\n";
    }
}
else
{
  // fab: fix the calendar id to manage only 1 calenda
  $frame = "<div id=\"formWide\">\n";
  $frame .= "<h2>Time period of counting processing</h2>\n";
  $frame .= "<p>The BlueCount server store and process the counter only during the following period. Counting values that are outside this period will be lost.</p>\n";
  $frame .= "<div id=\"form\">\n";
  $frame .= "<form action=\"Calendar.php\" method=\"get\">\n";
  $frame .= getCalendarInputs(getCalendarData(array( "id" => 0 )));
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