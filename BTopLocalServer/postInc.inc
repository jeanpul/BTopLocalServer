<?php

/**
 * \file postInc.inc
 * Will be included at the end of every page.
 * $mainFrame variable must exist and it's
 * the contents of the main part of the page. Others parts
 * will be automatically generated.
 * Do not forget to include preInc.inc at
 * the begining of the page to get apropriate
 * includes
 */

// check admin access to display the Admin menu entry
//if($session["access"] >= ADMINACCESS)
//{
//  $Menu["admin.php"] = _("Admin");
//}

//$Menu["help.php"] = _("Help");
//
//$topLeftInfos = formMenu(array("_softname" => SOFTNAME,
//			       "_revision" => "rev. " . VERSION),
//			 "Left");
//
//$topRightInfos = formMenu(array("_user" => _("User") . " " . $session["login"],
//				"logout.php" => _("Logout"),	
//				"_date" => strftime(_("%a %e %b %Y %Hh"))),				
//			  "Right");
//
//$topInfos = '<div id="left">' . $topLeftInfos . '</div><div id="right">' . $topRightInfos . '</div>' . "\n";
//
//$page->setTopMenu($topInfos);
//
//$page->setLogo(LOGO);
//
//$page->setTitle(TITLE);
//
//$mainMenu = formMenu($Menu, $pageName);
//$page->setMainMenu($mainMenu);
//$page->setSymbols("PREMAINMENU", "<div class=\"Tabs\">\n");
//
//$page->setBottomMenu(array ( ""=> COPYRIGHT ));

//echo $page->toString();

$clang->close();

?>

</div>
<div id="foot">
<p>2016 - managed by Codeffekt - 
<a target="_blank" rel="nofollow" href="https://github.com/jeanpul/">github</a>
</p>
</div>
</div>
</body>
</html>
