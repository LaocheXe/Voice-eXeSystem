<?php

require_once('../../../../class2.php');

require_once(HEADERF);
require("../../libraries/ts3wi/functions.inc.php");
require("../../libraries/ts3wi/config.php");
require("../../libraries/ts3wi/lang.php");
require("../../libraries/ts3wi/ts3admin.class.php");

//$text .='<iframe allowtransparency="true" src="http://indev.defiantz.org/ts3wi/tsviewpub.php?skey=0&sid=1936&showicons=right&bgcolor=333333&fontcolor=ff0000" style="height:1250px;width:100%" scrolling="auto" frameborder="0">Your Browser will not show Iframes</iframe>';


e107::getRender()->tablerender("TS3 - Test", $text);

require_once(FOOTERF);
//exit;
?>