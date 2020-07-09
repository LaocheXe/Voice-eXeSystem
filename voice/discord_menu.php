<?php

	// This is being made for the use of Discord
	// Other Menus should be requested at Voice Issue Tracker on Github
	if (!defined('e107_INIT')) { exit; }
	
	// voice pref (plugin.xml pref)
	$pref = e107::getPlugPref('voice');
	
	if(check_class($pref['voice_dviewclass']))
	{
		//require_once(e_PLUGIN."anteup/_class.php");
		e107::lan('voice');
		//$sc	= e107::getScBatch('anteup', true);
		//$template = e107::getTemplate('anteup');
		//$text = e107::getParser()->parseTemplate($template['menu'], false, $sc);
		$sc	= e107::getScBatch('voice', true);
		$template = e107::getTemplate('voice');
		$text = e107::getParser()->parseTemplate($template['discord_menu'], false, $sc);

		e107::getRender()->tablerender($pref['voice_dmtitle'], $text, 'voice');
	}

?>