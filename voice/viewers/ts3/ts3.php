<?php
require_once('../../../../class2.php');

if(!e107::isInstalled('voice'))
{
	header('location:'.e_BASE.'index.php');
	exit;	
}

require_once(HEADERF);


//require_once('libraries/TeamSpeak3/TeamSpeak3.php');
require_once('../../libraries/TeamSpeak3/TeamSpeak3.php');

//$sql = e107::getDB();
//$sql->select('voice_exesystem', 'voice_id, voice_name, voice_type, voice_ip, voice_port, voice_qport, voice_password, voice_channel, voice_channelpass, voice_qname, voice_qpass');
//		while($row = $sql->fetch())
//		{
//			if($row['voice_type'] == 2)
//			{
//					$sID = $row['voice_id'];
//					$sHost = $row['voice_ip'];
//					$sJPort = $row['voice_port'];
//					$sQPort = $row['voice_qport'];
//					$sQUser = $row['voice_qname'];
//					$sQPass = $row['voice_qpass'];
//					$sPass = $row['voice_password'];
//					$sChan = $row['voice_channel'];
//					$sChanp = $row['voice_channelpass'];
//					$sType = $row['voice_type'];
					
//					if($_GET['id'] == $sID)
//					{
					
						// The Query
						// connect to server, authenticate and spawn an object for the virtual server on port 9987
						//$ts3_VirtualServer = TeamSpeak3::factory("serverquery://username:password@127.0.0.1:10011/?server_port=9987");
//						$ts3_VirtualServer = TeamSpeak3::factory("serverquery://".$sQUser.":".$sQPass."@".$sHost.":".$sQPort."/?server_port=".$sJPort."");
					
						// Spawn an object using a specified name (Viewer)
						//$ts3_Clent = $ts3_VirtualServer->clientGetByName("Viewer");
						// build/display html tree view using custom image paths to remore icons that are embedded using data URI
//						$text .= $ts3_VirtualServer->getViewer(new TeamSpeak3_Viewer_Html("../../images/icons/", "../../images/flags/", "data:image"));
//						$text .= '<br /><br /><br /><br />';
//					}
//			}
//		}


//if(varture($_GET['id']))
//{
	$id = $_GET['id'];
	if($sql->select("voice_exesystem", "voice_id, voice_type, voice_ip, voice_port, voice_qport, voice_password, voice_qname, voice_qpass", "voice_id LIKE '". $id."%'"))
	{
		while($row = $sql->db_Fetch())
		{
			$sID = $row['voice_id'];
			$sHost = $row['voice_ip'];
			$sJPort = $row['voice_port'];
			$sQPort = $row['voice_qport'];
			$sQUser = $row['voice_qname'];
			$sQPass = $row['voice_qpass'];
			$sPass = $row['voice_password'];
			$sType = $row['voice_type'];
			
			if($row['voice_type'] == 2)
			{
				// The Query
				// connect to server, authenticate and spawn an object for the virtual server on port 9987
				//$ts3_VirtualServer = TeamSpeak3::factory("serverquery://username:password@127.0.0.1:10011/?server_port=9987");
				$ts3_VirtualServer = TeamSpeak3::factory("serverquery://".$sQUser.":".$sQPass."@".$sHost.":".$sQPort."/?server_port=".$sJPort."");
					
				// Spawn an object using a specified name (Viewer)
				//$ts3_Clent = $ts3_VirtualServer->clientGetByName("Viewer");
				// build/display html tree view using custom image paths to remore icons that are embedded using data URI
				$text .= $ts3_VirtualServer->getViewer(new TeamSpeak3_Viewer_Html("../../images/icons/", "../../images/flags/", "data:image"));
				$text .= '<br /><br /><br /><br />';
			}
			else
			{
				header("Location: ".e_PLUGIN."/voice");	
			}
		}
	}
//}

//if(e_AJAX_REQUEST)
//{
//	if(vartrue($_GET['q']))
//	{
//		$q = filter_var($_GET['q'], FILTER_SANITIZE_STRING);
//		if($sql->select("user", "user_id,user_name", "user_name LIKE '". $q."%' ORDER BY user_name LIMIT 15"))
//		{
//			while($row = $sql->db_Fetch())
//			{
//				$id = $row['user_id'];
//				$data[$id] = $row['user_name'];
//			}
			
//			if(count($data))
//			{
//				echo json_encode($data);	
//			}
//		}		
//	}
//	exit;
//}

e107::getRender()->tablerender("TS3 - Test", $text);

require_once(FOOTERF);
exit;
?>