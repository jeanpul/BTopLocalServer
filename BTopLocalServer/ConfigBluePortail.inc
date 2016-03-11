<?php

/**
 * CHANGE THE VALUE TO YOUR APPROPRIATE SETTING
 * LANG : Application language
 * Language translation is done via locales using mo files
 * @see mkmf commands @see po sub directory
 */
define ('LANG', "en_US");

setlocale(LC_ALL, LANG);

textdomain("BlueCountGUI");

/**
 * Software version @see svn info :
 */
define ('SOFTNAME', "BlueCount Local Server Configuration"); 
define ('VERSION', "4884");

/**
 * Where to find the documentations ?
 */
define ('DOCPATH', "/Docs/");

/**
 * Main title
 */
define ('TITLE', "Configuration");

/**
 * Bottom sentence
 */
define ('COPYRIGHT', "Copyright 2007 Blue Eye Video All Rights Reserved");

define('SESSIONTIME', 3600);
define('CSS', "styles/blueeyevideo.css");

/**
 * Main logo
 */
define ('LOGO', "BEV_LOGO_MR");

/**
 * Menu pages
 * MUST BE DEFINED AFTER THE LOCALE DEFINITION 
 */
$Menu = array( "BTopSensors.php" => _("B-Top Sensor list"),
	       //	       "BQueueSensors.php" => _("B-Queue Sensor list"),
	       "Locations.php" => _("Locations"),
	       "Doors.php" => _("Doors"),
	       "Groups.php" => _("Groups"),
	       "Areas.php" => _("Areas"));

/**
 * Default page
 * Do not use the name of the menu entry in case
 * where you don't have a menu or if you modify the
 * Menu entry title.
 */
define ('DEFAULTPAGE', "/cgi-bin/BTopServerMenu.cgi" );

/**
 * CHANGE THE VALUES TO YOUR APPROPRIATE SETTINGS
 * DBHOST : hostname of the machine which have the database
 * DBNAME : database name (table name in SQL)
 * DBUSER and DBPASSWD : user login and password that have i/o access to the database
 */
define ('BASEPATH', "/home/DATA/");
define ('BTOP_SERVER_DBPATH', BASEPATH . "BTopLocalServer/");

define ('TMP_COUNTER_FILE', BTOP_SERVER_DBPATH . "counters.query");
define ('TMP_NUMBERING_FILE', BTOP_SERVER_DBPATH . "numbering.query");

define ('COUNTDBTYPE', "SQLITE3");
define ('COUNTDBHOST', "localhost");
define ('COUNTDBNAME', BTOP_SERVER_DBPATH . "counters.db");
define ('COUNTDBUSER', "blue");
define ('COUNTDBPASSWD', "blue4eye");

define ('CONFIGDBTYPE', "SQLITE3");
define ('CONFIGDBHOST', "localhost");
define ('CONFIGDBNAME', BTOP_SERVER_DBPATH . "processed.db");
define ('CONFIGDBUSER', "blue");
define ('CONFIGDBPASSWD', "blue4eye");

define ('DATADBTYPE', "SQLITE3");
define ('DATADBHOST', "localhost");
define ('DATADBNAME', BTOP_SERVER_DBPATH . "BLC.db");
define ('DATADBUSER', "blue");
define ('DATADBPASSWD', "blue4eye");
define ('DATADBPATH', "/home/DATA/BTopLocalServer/");

define ('SESSION_DBTYPE', "SQLITE3");
define ('SESSION_DBHOST', "localhost");
define ('SESSION_DBNAME', BTOP_SERVER_DBPATH . "session.db");
define ('SESSION_DBUSER', "blue");
define ('SESSION_DBPASSWD', "blue4eye");

/**
 * Here is the minimum access level
 * required to be an admin user
 */
define ('ADMINACCESS', 2);

/**
 * If we provide access to the statistics link
 * to BlueCountGUI 
 */
define ('STATACCESS', true);
define ('STATURL', "/BlueCountGUI/index.php");

?>
