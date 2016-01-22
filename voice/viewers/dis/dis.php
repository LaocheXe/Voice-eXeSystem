<?php
require_once('../../../../class2.php');

if(!e107::isInstalled('voice'))
{
	header('location:'.e_BASE.'index.php');
	exit;	
}

require_once(HEADERF);


//require_once('libraries/TeamSpeak3/TeamSpeak3.php');
//require_once('../../libraries/TeamSpeak3/TeamSpeak3.php');

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
	//  `voice_discord_id` varchar(128) DEFAULT NULL,
  //`voice_discord_invitecode` varchar(255) DEFAULT NULL,
  //`voice_discord_japi` varchar(200) DEFAULT NULL,
  //`voice_discord_theme` varchar(15) DEFAULT NULL,
  //`voice_discord_width` int(12) unsigned NOT NULL,
  //`voice_discord_height` int(12) unsigned NOT NULL,
  //`voice_discord_transp` int(10) unsigned NOT NULL,
  //`voice_discord_iframe` int(10) unsigned NOT NULL,
  //`voice_discord_frameborder` int(12) unsigned NOT NULL,
	$id = $_GET['id'];
	if($sql->select("voice_exesystem", "voice_id, voice_name, voice_type, voice_discord_id, voice_discord_invitecode, voice_discord_japi, voice_discord_theme", "voice_id LIKE '". $id."%'"))
	{
		while($row = $sql->db_Fetch())
		{
			$sID = $row['voice_id'];
			$sName = $row['voice_name'];
			$sID = $row['voice_discord_id'];
			$sIncode = $row['voice_discord_invitecode'];
			$sJapi = $row['voice_discord_japi'];
			$disTheme = $row['voice_discord_theme'];
			$sType = $row['voice_type'];
			
			if($row['voice_type'] == 4)
			{
				// The Query
				// connect to server, authenticate and spawn an object for the virtual server on port 9987
				//$ts3_VirtualServer = TeamSpeak3::factory("serverquery://username:password@127.0.0.1:10011/?server_port=9987");
				//$ts3_VirtualServer = TeamSpeak3::factory("serverquery://".$sQUser.":".$sQPass."@".$sHost.":".$sQPort."/?server_port=".$sJPort."");
					
				// Spawn an object using a specified name (Viewer)
				//$ts3_Clent = $ts3_VirtualServer->clientGetByName("Viewer");
				// build/display html tree view using custom image paths to remore icons that are embedded using data URI
				//$text .= $ts3_VirtualServer->getViewer(new TeamSpeak3_Viewer_Html("../../images/icons/", "../../images/flags/", "data:image"));
				if(!USERID)
				{
					$userName = "";
				}
				else
				{
					$userName = "".USERNAME."";
				}
				if($disTheme == 0)
				{
					$sTheme = "light";
				}
				elseif($disTheme == 1)
				{
					$sTheme = "dark";
				}
				$sType = "https://";
				$text .= '<iframe src="'.$sType.'discordapp.com/widget?id='.$sID.'&theme='.$sTheme.'&username='.$userName.'" width="450" height="600" allowtransparency="true" frameborder="0"></iframe>';
				
				$text .= '<br /><br /><br /><br />';
				$sTitle .= "".LAN_VOI_TYPE_DIS." - ".$sName."";
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

e107::getRender()->tablerender($sTitle, $text);

require_once(FOOTERF);
exit;
?>