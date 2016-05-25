<?php
/*
 * e107 website system
 *
 * Copyright (C) 2008-2009 e107 Inc (e107.org)
 * Released under the terms and conditions of the
 * GNU General Public License (http://www.gnu.org/licenses/gpl.txt)
 *
 * Voice eXeSystem
 * Date: 5-7-2016
 * LaocheXe
 * forbiddenchaos@gmail.com
 * https://github.com/laochexe
 *
*/

if (!defined('e107_INIT')) { exit; }
/*if(!e107::isInstalled('gsitemap'))
{ 
	return;
}*/


class voice_sitelink // include plugin-folder in the name.
{
	function config()
	{
		global $pref;
		
		$links = array();
			
		$links[] = array(
			'name'			=> 'Voice', // Testing,
			'function'		=> "voiceEXE"
		);	
		
		
		return $links;
	}
	
	

	function voiceEXE() 
	{
	/*	$sql = e107::getDb();
		$tp = e107::getParser();
		$sublinks = array();
		
		$sql->select("faqs_info","*","faq_info_id != '' ORDER BY faq_info_order");
		
		while($row = $sql->fetch())
		{
			$sublinks[] = array(
				'link_name'			=> $tp->toHtml($row['faq_info_title'],'','TITLE'),
				'link_url'			=> e107::url('faqs', 'category', $row),
				'link_description'	=> $row['faq_info_about'],
				'link_button'		=> $row['faq_info_icon'],
				'link_category'		=> '',
				'link_order'		=> '',
				'link_parent'		=> '',
				'link_open'			=> '',
				'link_class'		=> intval($row['faq_info_class'])
			);
		}
	*/	
		$voiceeXe = '{VOICE_EXE}';
		return $voiceeXe;
	    
	}
	
}
?>