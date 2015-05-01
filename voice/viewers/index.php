<?php
// Servers List - List Each Server
// Mumble - List Mumble Servers
// TeamSpeak 3 - List TeamSpeak 3 Servers
// Ventrilo - List Ventrilo Servers
// List them all under catagories - Mumble, TeamSpeak3, Ventrilo
// Each Catagory will be Bold maybe even a Header H4 or H3
// Servers Listed Under the Catagories will be links linking to ble/ble.php, ts3/ts3.php, vent/vent.php
// Each server will use ID number to show the Viewers (ble.php?id1 - ble.php?id12 - etc...)
require_once('../../class2.php');
class teamspeak3_view
{
	//public function __construct()
	//{
		
	//}
	
	function ts3_viewer()
	{
		require_once('libraries/TeamSpeak3/TeamSpeak3.php');
		
		$sql = e107::getDB();
		$sql->select('voice_exesystem', 'voice_id, voice_name, voice_type, voice_ip, voice_port, voice_qport, voice_password, voice_channel, voice_channelpass, voice_qname, voice_qpass'); 
		while($row = $sql->fetch())
		{
			if($row['voice_type'] == 2)
			{
					$sID = $row['voice_id'];
					$sHost = $row['voice_ip'];
					$sJPort = $row['voice_port'];
					$sQPort = $row['voice_qport'];
					$sQUser = $row['voice_qname'];
					$sQPass = $row['voice_qpass'];
					$sPass = $row['voice_password'];
					$sChan = $row['voice_channel'];
					$sChanp = $row['voice_channelpass'];
					$sType = $row['voice_type'];
					
					// The Query
					// connect to server, authenticate and spawn an object for the virtual server on port 9987
					//$ts3_VirtualServer = TeamSpeak3::factory("serverquery://username:password@127.0.0.1:10011/?server_port=9987");
					$ts3_VirtualServer = TeamSpeak3::factory("serverquery://".$sQUser.":".$sQPass."@".$sHost.":".$sQPort."/?server_port=".$sJPort."");
					
					// build/display html tree view using custom image paths to remore icons that are embedded using data URI
					$text .= $ts3_VirtualServer->getViewer(new TeamSpeak3_Viewer_Html("images/icons/", "images/flags", "data:image"));

			}
		}


		return $text;
	}
}

?>