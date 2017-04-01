<?php
require_once('../../../../class2.php');

if(!e107::isInstalled('voice'))
{
	header('location:'.e_BASE.'index.php');
	exit;	
}

e107::lan('voice', true, true);

require_once(HEADERF);

	$id = $_GET['id'];
	if($sql->select("voice_exesystem", "voice_id, voice_name, voice_type, voice_ip, voice_port, voice_qport, voice_password, voice_qname, voice_qpass, voice_viewer, voice_viewer_cc", "voice_id LIKE '". $id."%'"))
	{
		while($row = $sql->db_Fetch())
		{
			$sID = $row['voice_id'];
			$sName = $row['voice_name'];
			$sHost = $row['voice_ip'];
			$sJPort = $row['voice_port'];
			$sQPort = $row['voice_qport'];
			$sQUser = $row['voice_qname'];
			$sQPass = $row['voice_qpass'];
			$sPass = $row['voice_password'];
			$sType = $row['voice_type'];
			$sViewerCC = $row['voice_viewer_cc'];
			
			$pageTitle = "".LAN_VOI_TYPE_VEN." - ".$sName."";
		
			if($row['voice_type'] == 1)
			{
				//$pageTitle = "TS3 - ".$sName."";
				
				if($row['voice_viewer'] == 1)
				{
					
					$viewer = e107::getParser()->toHTML($sViewerCC);
					//$viewer = $sViewerCC;
					//$text .= $viewer;
				}
				//else
				//{	
				//	require_once('../../libraries/TeamSpeak3/TeamSpeak3.php');
					// The Query
					// connect to server, authenticate and spawn an object for the virtual server on port 9987
					//$ts3_VirtualServer = TeamSpeak3::factory("serverquery://username:password@127.0.0.1:10011/?server_port=9987");
				//	$ts3_VirtualServer = TeamSpeak3::factory("serverquery://".$sQUser.":".$sQPass."@".$sHost.":".$sQPort."/?server_port=".$sJPort."");
					
					// Spawn an object using a specified name (Viewer)
					//$ts3_Clent = $ts3_VirtualServer->clientGetByName("Viewer");
					// build/display html tree view using custom image paths to remore icons that are embedded using data URI
				//	$viewer = $ts3_VirtualServer->getViewer(new TeamSpeak3_Viewer_Html("../../images/icons/", "../../images/flags/", "data:image"));
				//	$viewer = '<br /><br /><br /><br />';
					//$text .= $viewer;
				//}
				
				$text = $viewer;
				//return $text;
			}
			else
			{
				header("Location: ".e_PLUGIN."/voice");	
			}
		}
	}

e107::getRender()->tablerender($pageTitle, $text);

require_once(FOOTERF);
exit;
?>