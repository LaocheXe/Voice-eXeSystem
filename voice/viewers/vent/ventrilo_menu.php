<?php
/*
 * e107 website system
 *
 * Copyright (C) 2008-2013 e107 Inc (e107.org)
 * Released under the terms and conditions of the
 * GNU General Public License (http://www.gnu.org/licenses/gpl.txt)
 *
 * Ventrilo Menu
 * by LaocheXe
 * www.defiantz.org
 *
*/

// TODO: Update for e107 Menu
// Ventrilostatus.php
include "viewers/vent/ventrilostatus.php";

// Database calls
$sql = e107::getDB();
$sql->select('voice_exesystem', 'voice_name, voice_type, voice_ip, voice_port, voice_qport, voice_enable_sc, voice_enable_msc, voice_msc, voice_password, voice_channel, voice_channelpass, voice_type_version');
while($row = $sql->fetch())
{
	if($row['voice_type'] == 3)
	{
		$stat = new CVentriloStatus;
		$stat->m_cmdprog	= "c:/var/www/html/ventrilo_status";	// Adjust accordingly. - Plugin Directory
		$stat->m_cmdcode	= "2";
		$stat->m_cmdhost	= $row['voice_ip'];
		$stat->m_cmdport	= $row['voice_port'];
		if($row['voice_pass'] == !null) // Might need to be correct
		{
			$stat->m_cmdpass	= $row['voice_password'];
		}
		else
		{
			$stat->m_cmdpass	= "";	
		}
	}
}

// Information Section
//$stat = new CVentriloStatus;
//$stat->m_cmdprog	= "c:/var/www/html/ventrilo_status";	// Adjust accordingly.
//$stat->m_cmdcode	= "2";					// Detail mode.
//$stat->m_cmdhost	= "127.0.0.1";			// Assume ventrilo server on same machine.
//$stat->m_cmdport	= "3784";				// Port to be statused.
//$stat->m_cmdpass	= "";					// Status password if necessary.

?>