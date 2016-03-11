<?php

$pageName = "SensorListAuto.php";

include("preInc.inc");

$cmd = "sudo ping -b -c 3 255.255.255.255 | grep \"bytes from\" | awk -F ' ' '{print \$4}' | sed 's/:$//'";
$result = array();
exec($cmd, $result);

// remove duplicate entries
$hosts = array();
foreach($result as $v)
{
  $hosts[$v] = 0;
}

// check local BTop/BQueue configurations
ini_set('display_errors', false);
foreach($hosts as $k => $v)
{
  if(file_get_contents("http://$k/cgi-bin/Sensor/LocalSensorSet.cgi", false))
    {
      $hosts[$k] = 1;
    }
}
ini_set('display_errors', true);
$frame  = "<div id=\"SensorList\" class=\"Boxes\">\n";
$frame .= "<h1>Check for local sensors</h1>\n";
$frame .= "<table>\n";
foreach($hosts as $k => $v)
{
  if($v == 1)
    {
      $frame .= "<tr><td>$k => $v</td></tr>\n";
    }}
$frame .= "</table>\n";
$frame .= "</div>\n";

$page->setMainPart($frame);

include("postInc.inc");


?>