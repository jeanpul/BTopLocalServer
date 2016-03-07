<?php

$bcmServer = "blueportail2";
$bcmLogin = "crt";
$mailFrom = "bcm@blueeyevideo.com";
$mailRcpt = "fp@blueeyevideo.com";
//$mailHeader = "Bcc: support@blueeyevideo.com\r\n";
$mailHeader = "Reply-To: support@blueeyevideo.com\r\n";
$mailSubject = "BlueCountManager Monitoring : Comptages des CRTs";
$mailBody = "";
$mailBodyAutoMsg = file_get_contents(BLUEPORTAILROOT . "/" . $clientBluePortail . "/BTopLocalServer/" . "BodyAutoMsg.html");
$comZoneType = "";
$comZoneName = "";

?>
