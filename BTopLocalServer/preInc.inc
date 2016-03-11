<?php

/**
 * \file posInc.inc
 * Will be included at the begining of every page.
 * "Config.inc" must exits.
 * Do not forget to include postInc.inc at
 * the end of the page to render everything.
 */
include_once('Config.inc');

//loadBluePHP();

include_once("BluePHP/Connect.inc");
include_once("BluePHP/Session.inc");
include_once("BluePHP/FormPageStandard.inc");
include_once("BluePHP/Forms.inc");
include_once("BlueCountLang.inc");
include_once("BluePHP/DateOps.inc");

include_once("CommonOps.inc");

// create a connection to the BlueCountLang
$clang = new BlueCountLang(true);

// create the page layout
$page = new FormPageStandard();

// !! DO NOT DISPLAY THE HEADER BEFORE THE CHECK ACCESS
// OTHERWISE THE LOGIN/PASSWD CONNECTION WINDOW COULD NOT
// BE DISPLAYED

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
<title>BTopLocalServer system - main page</title>
<meta http-equiv="content-type" content="text/html; charset=ISO-8859-1" />
<script type="text/javascript" language="JavaScript" SRC="jscript/BTopLocalServer.js"></script>
<link rel="stylesheet" type="text/css" href="styles/blueeyevideo.css"/>
<link rel="stylesheet" type="text/css" href="BlueSystem/styles/StyleBlueEyeVideo.css"/>
</head>
<body>
<div id="main">
<div id="top">
<table class="head">
<tr>
<td><div align="left"><h3>BlueCount Server Rev. <?php echo VERSION ?><?php if($clientBluePortail) echo " / $clientBluePortail"; ?></h3></div></td>
</tr>
</table>
</div>
<div id="desc">
<h1>
<?php
echo $pageTitle;
?>
</h1>
