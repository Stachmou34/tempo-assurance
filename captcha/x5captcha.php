<?php
include("../res/x5engine.php");
$nameList = array("mu5","gkm","73a","6gh","4up","w85","hvw","vlt","hm7","3mf");
$charList = array("8","S","C","T","E","K","6","J","S","6");
$cpt = new X5Captcha($nameList, $charList);
//Check Captcha
if ($_GET["action"] == "check")
	echo $cpt->check($_GET["code"], $_GET["ans"]);
//Show Captcha chars
else if ($_GET["action"] == "show")
	echo $cpt->show($_GET['code']);
// End of file x5captcha.php
