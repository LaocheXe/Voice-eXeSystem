<?php

class voice_shortcodes extends e_shortcode
{
	public		$sType;		// Server Type
	public		$sName;		// Server Name
	public		$sHost;		// Server IP/Host
	public		$sPort;		// Server Port
	public		$sPass;		// Server Password
	public		$sChan;		// Server Channel
	public		$sChanp;	// Server Channel Password
	public		$msc;		// Manually Short Code
	public		$sbleType;	// Server Mumble type
	// Mumble
	//TODO: Add SubChannel+SubChannel etc...
	//public		$bleNickname;	// Mumble Nickname
	//public		$blePort;		// Server Port
	//public		$blePass;		// Server Password
	//public		$bleChan;		// Server Channel
	public		$bleType;		// Mumble Server Version Type
	// TeamSpeak 3
	public		$tsNickname;	// Server NickName
	public		$tsnName;		// Server NickName Insert
	public		$tsPort;		// Server Port
	public		$tsPass;		// Server Password
	public		$tsChan;		// Server Channel
	public		$tsChanp;		// Server Channel Password
	// Vent
	public		$vtName;		// Server Name
	public		$vtPort;		// Server Port
	public		$vtPass;		// Server Password
	public		$vtChan;		// Server Channel
	public		$vtChanp;		// Server Channel Password
	// Discord
	public		$disName;		// Server Name
	//public		$disJAPI;		// Server JSON API
	public		$disID;			// Server ID
	public		$disInvitecode; // Server Invite Code
	public		$disWidth;		// Server Width
	public		$disHeight;		// Server Height
	public		$disTheme;		// Server Theme
	public		$disTrans;		// Server Enable Transparent
	public		$disiFrame;		// Server iFrame
	public		$disFrame;		// Server Frame Border

	
	public function __construct()
	{
		
	}
	
	function sc_voice_exe()
	{
		$pref_eCustomln = e107::pref('voice', 'eCustomln');
		$pref_linkName = e107::pref('voice', 'linkName');
		
		e107::lan('voice', true, true);
		
		$sql = e107::getDB();
		$sql->select('voice_exesystem', 'voice_name, voice_type, voice_ip, voice_port, voice_qport, voice_enable_sc, voice_enable_msc, voice_msc, voice_password, voice_channel, voice_channelpass, voice_type_version, voice_listname, voice_discord_id, voice_discord_invitecode, voice_discord_theme, voice_discord_width, voice_discord_height, voice_discord_transp, voice_discord_iframe, voice_discord_frameborder'); 
		while($row = $sql->fetch())
		{
			if($row['voice_enable_sc'] == 1)
			{
				if($row['voice_enable_msc'] == 0)
				{
					$sName = $row['voice_name'];
					$sHost = $row['voice_ip'];
					$sPort = $row['voice_port'];
					$sPass = $row['voice_password'];
					$sChan = $row['voice_channel'];
					$sChanp = $row['voice_channelpass'];
					$sbleType = $row['voice_type_version'];
					$linkUrlType = $row['voice_listname'];
					$sserverType = $row['voice_type'];
					$disID = $row['voice_discord_id'];
					//$disJAPI = $row['voice_discord_japi'];
					$disInvitecode = $row['voice_discord_invitecode'];
					$disWidth = $row['voice_discord_width'];
					$disHeight = $row['voice_discord_height'];
					$disTheme = $row['voice_discord_theme'];
					$disTrans = $row['voice_discord_transp'];
					$disiFrame = $row['voice_discord_iframe'];
					$disFrame = $row['voice_discord_frameborder'];
					//Mumble
					//$blePort = "?port=".$sPort."";		// Server Port
					//$bleNickname = "";
					//$blePass = "".$sPass."";		// Server Password
					//$bleChan = "&channel=".$sChan."";		// Server Channel
					//$bleType = "&channelpassword=".$sbleType."";		// Server Channel Password
					// TeamSpeak3
					$tsPort = "?port=".$sPort."";		// Server Port
					$tsNickname = "&nickname=";
					$tsPass = "&password=".$sPass."";		// Server Password
					$tsChan = "&channel=".$sChan."";		// Server Channel
					$tsChanp = "&channelpassword=".$sChanp."";		// Server Channel Password
					// Ventrilo
					$vtPort = ":".$sPort."";		// Server Port		
					$vtServerName = "servername=".$sName.""; // DServer Name
					$vtPass = "&serverpassword=".$sPass."";		// Server Password
					$vtChan = "&channelname=".$sChan."";		// Server Channel
					$vtChanp = "&channelpassword=".$sChanp."";		// Server Channel Password
					// Class
					$bntClass1 = 'class="dropdown-toggle no-block" role="button" ';
					// Name URL
					// Get Type Name
					if($linkUrlType == 0)
					{
						$linkName = $nameLink;	
					}
					elseif($linkUrlType == 1)
					{
						if($sserverType == 1)
						{
							$linkName = LAN_VOI_TYPE_MUM;
						}
						elseif($sserverType == 1)
						{
							$linkName = LAN_VOI_TYPE_TS3;
						}
						elseif($sserverType == 3)
						{
							$linkName = LAN_VOI_TYPE_VENT;
						}
						elseif($sserverType == 4)
						{
							$linkName = LAN_VOI_TYPE_DIS;
						}	
					}
					elseif($linkUrlType == 2)
					{
						$linkName = $sName;
					}

					// Mumble
					if($sserverType == 1)
					{
						$sType = "mumble://";
						if($sbleType == 1)
						{
							$bleType = "?version=1.1.0";
						}
						elseif($sbleType == 2)
						{
							$bleType = "?version=1.2.0";
						}
						$btnClass3 = '<span class="icon-ble"></span> ';
						if(!empty($sPass))
						{
							if(!empty($sChan))
							{
								if(!empty($sPort))
								{
									$voice_exe .='<a '.$btnClass1.'href="'.$sType.''.$sPass.'@'.$sHost.':'.$sPort.'/'.$sChan.'/'.$bleType.'">'.$btnClass3.''.$linkName.'</a>';
								}
								else
								{
									$voice_exe .='<a '.$btnClass1.'href="'.$sType.''.$sPass.'@'.$sHost.'/'.$sChan.'/'.$bleType.'">'.$btnClass3.''.$linkName.'</a>';
								}
							}
							else
							{
								if(!empty($sPort))
								{
									$voice_exe .='<a '.$btnClass1.'href="'.$sType.''.$sPass.'@'.$sHost.':'.$sPort.'/'.$bleType.'">'.$btnClass3.''.$linkName.'</a>';
								}
								else
								{
									$voice_exe .='<a '.$btnClass1.'href="'.$sType.''.$sPass.'@'.$sHost.'/'.$bleType.'">'.$btnClass3.''.$linkName.'</a>';
								}	
							}
						}
						else
						{
							if(!empty($sChan))
							{
								if(!empty($sPort))
								{
									$voice_exe .='<a '.$btnClass1.'href="'.$sType.''.$sHost.':'.$sPort.'/'.$sChan.'/'.$bleType.'">'.$btnClass3.''.$linkName.'</a>';
								}
								else
								{
									$voice_exe .='<a '.$btnClass1.'href="'.$sType.''.$sHost.'/'.$sChan.'/'.$bleType.'">'.$btnClass3.''.$linkName.'</a>';
								}
							}
							else
							{
								if(!empty($sPort))
								{
									$voice_exe .='<a '.$btnClass1.'href="'.$sType.''.$sHost.':'.$sPort.'/'.$bleType.'">'.$btnClass3.''.$linkName.'</a>';
								}
								else
								{
									$voice_exe .='<a '.$btnClass1.'href="'.$sType.''.$sHost.'/'.$bleType.'">'.$btnClass3.''.$linkName.'</a>';
								}
							}
						}
					}
					// TeamSpeak3
					elseif($sserverType == 2)
					{
						if(!USERID)
						{
							$tsnName = "Guest";
						}
						else
						{
							$tsnName = "".USERNAME."";
						}
						$btnClass3 = '<span class="icon-ts3"></span> ';
						$sType = "ts3server://";
						if(!empty($sPass))
						{
							if(!empty($sChan))
							{
								if(!empty($sChanp))
								{
									$voice_exe .='<a '.$btnClass1.'href="'.$sType.''.$sHost.''.$tsPort.''.$tsNickname.''.$tsnName.''.$tsPass.''.$tsChan.''.$tsChanp.'">'.$btnClass3.''.$linkName.'</a>';
								}
								else
								{
									$voice_exe .='<a '.$btnClass1.'href="'.$sType.''.$sHost.''.$tsPort.''.$tsNickname.''.$tsnName.''.$tsPass.''.$tsChan.'">'.$btnClass3.''.$linkName.'</a>';	
								}
							}
							else
							{
								$voice_exe .='<a '.$btnClass1.'href="'.$sType.''.$sHost.''.$tsPort.''.$tsNickname.''.$tsnName.''.$tsPass.'">'.$btnClass3.''.$linkName.'</a>';	
							}
						}
						else
						{
							if(!empty($sChan))
							{
								if(!empty($sChanp))
								{
									$voice_exe .='<a '.$btnClass1.'href="'.$sType.''.$sHost.''.$tsPort.''.$tsNickname.''.$tsnName.''.$tsChan.''.$tsChanp.'">'.$btnClass3.''.$linkName.'</a>';
								}
								else
								{
									$voice_exe .='<a '.$btnClass1.'href="'.$sType.''.$sHost.''.$tsPort.''.$tsNickname.''.$tsnName.''.$tsChan.'">'.$btnClass3.''.$linkName.'</a>';	
								}
							}
							else
							{
								$voice_exe .='<a '.$btnClass1.'href="'.$sType.''.$sHost.''.$tsPort.''.$tsNickname.''.$tsnName.'">'.$btnClass3.''.$linkName.'</a>';	
							}
						}
					}
					// Ventrilo
					elseif($sserverType == 3)
					{
						$btnClass3 = '<span class="icon-vent"></span> ';
						$sType = "ventrilo://";
						if(!empty($sPass))
						{
							if(!empty($sChan))
							{
								if(!empty($sChanp))
								{
									$voice_exe .='<a '.$btnClass1.'href="'.$sType.''.$sHost.''.$vtPort.'/'.$vtServerName.''.$vtPass.''.$vtChan.''.$vtChanp.'">'.$btnClass3.''.$linkName.'</a>';
								}
								else
								{
									$voice_exe .='<a '.$btnClass1.'href="'.$sType.''.$sHost.''.$vtPort.'/'.$vtServerName.''.$vtPass.''.$vtChan.'">'.$btnClass3.''.$linkName.'</a>';
								}
							}
							else
							{
								$voice_exe .='<a '.$btnClass1.'href="'.$sType.''.$sHost.''.$vtPort.'/'.$vtServerName.''.$vtPass.'">'.$btnClass3.''.$linkName.'</a>';	
							}
						}
						else
						{
							if(!empty($sChan))
							{
								if(!empty($sChan))
								{
									$voice_exe .='<a '.$btnClass1.'href="'.$sType.''.$sHost.''.$vtPort.'/'.$vtServerName.''.$vtChan.''.$vtChanp.'">'.$btnClass3.''.$linkName.'</a>';
								}
								else
								{
									$voice_exe .='<a '.$btnClass1.'href="'.$sType.''.$sHost.''.$vtPort.'/'.$vtServerName.''.$vtChan.'">'.$btnClass3.''.$linkName.'</a>';	
								}
							}
							else
							{
								$voice_exe .='<a '.$btnClass1.'href="'.$sType.''.$sHost.''.$vtPort.'/'.$vtServerName.'">'.$btnClass3.''.$linkName.'</a>';	
							}
						}
					}
					// Discord
					elseif($sserverType == 4)
					{
						if(!USERID)
						{
							$userName = "";
						}
						else
						{
							$userName = "".USERNAME."";
						}
						if($disTrans == 0)
						{
							$disTransparent = 'false';
						}
						elseif($disTrans == 1)
						{
							$disTransparent = 'true';
						}
						if($disTheme == 0)
						{
							$disSTheme = "light";
						}
						elseif($disTheme == 1)
						{
							$disSTheme = "dark";
						}
						$btnClass3 = '<span class="icon-discord"></span> ';
						$sType = "https://";
						if(!empty($disID))
						{
							if(!empty($disInvitecode))
							{
								if($disiFrame == 0)
								{
									$voice_exe .='<a '.$btnClass1.'href="'.$sType.'discordapp.com/invite/'.$disInvitecode.'?utm_source=Voice_eXe%20e107%20Plugin&utm_medium=Connect" target="_blank">'.$btnClass3.''.$linkName.'</a>';
								}
								elseif ($disiFrame == 1)
								{
									$voice_exe .='<iframe src="'.$sType.'discordapp.com/widget?id='.$disID.'&theme='.$disSTheme.'&username='.$userName.'" width="'.$disWidth.'" height="'.$disHeight.'" allowtransparency="'.$disTransparent.'" frameborder="'.$disFrame.'"></iframe>';
								}
							}
							elseif(empty($disInvitecode))
							{
								if($disiFrame == 1)
								{
									$voice_exe .='<iframe src="'.$sType.'discordapp.com/widget?id='.$disID.'&theme='.$disSTheme.'&username='.$userName.'" width="'.$disWidth.'" height="'.$disHeight.'" allowtransparency="'.$disTransparent.'" frameborder="'.$disFrame.'"></iframe>';
								}
							}
						}
						elseif(empty($disID))
						{
							if(!empty($disInvitecode))
							{
								if($disiFrame == 0)
								{
									$voice_exe .='<a '.$btnClass1.'href="'.$sType.'discordapp.com/invite/'.$disInvitecode.'?utm_source=Voice_eXe%20e107%20Plugin&utm_medium=Connect" target="_blank">'.$btnClass3.''.$linkName.'</a>';
								}
								elseif ($disiFrame == 1)
								{
									$voice_exe .='<iframe src="'.$sType.'discordapp.com/widget?id='.$disID.'&theme='.$disSTheme.'&username='.$userName.'" width="'.$disWidth.'" height="'.$disHeight.'" allowtransparency="'.$disTransparent.'" frameborder="'.$disFrame.'"></iframe>';
								}
							}
							elseif(empty($disInvitecode))
							{
								if($disiFrame == 1)
								{
									$voice_exe .='<iframe src="'.$sType.'discordapp.com/widget?id='.$disID.'&theme='.$disSTheme.'&username='.$userName.'" width="'.$disWidth.'" height="'.$disHeight.'" allowtransparency="'.$disTransparent.'" frameborder="'.$disFrame.'"></iframe>';
								}
							}
						}
					}
				}
				elseif ($row['voice_enable_msc'] == 1)
				{
				
					$msc = $row['voice_msc'];
					// MSC is Enabled;
					$voice_exe .= e107::getParser()->toHTML($msc);
				}
			}
		}
		
		
		$text .='
		<div class="dropdown-menu">
		
		'.$voice_exe.'
		
		<br />
		<div class="divider"></div>
		<a href="'.e_PLUGIN.'voice/voice.php">'.LAN_VOICE_VIEWERS.'</a>
		</div>
		';
		e107::getDebug()->log($text);
		return $text;
	}
	
	function sc_voice_exe_legacy()
	{
		$pref_eCustomln = e107::pref('voice', 'eCustomln');
		$pref_linkName = e107::pref('voice', 'linkName');
		
		e107::lan('voice', true, true);
		
		$sql = e107::getDB();
		$sql->select('voice_exesystem', 'voice_name, voice_type, voice_ip, voice_port, voice_qport, voice_enable_sc, voice_enable_msc, voice_msc, voice_password, voice_channel, voice_channelpass, voice_type_version, voice_listname, voice_discord_id, voice_discord_invitecode, voice_discord_theme, voice_discord_width, voice_discord_height, voice_discord_transp, voice_discord_iframe, voice_discord_frameborder'); 
		while($row = $sql->fetch())
		{
			if($row['voice_enable_sc'] == 1)
			{
				if($row['voice_enable_msc'] == 0)
				{
					$sName = $row['voice_name'];
					$sHost = $row['voice_ip'];
					$sPort = $row['voice_port'];
					$sPass = $row['voice_password'];
					$sChan = $row['voice_channel'];
					$sChanp = $row['voice_channelpass'];
					$sbleType = $row['voice_type_version'];
					$linkUrlType = $row['voice_listname'];
					$sserverType = $row['voice_type'];
					$disID = $row['voice_discord_id'];
					//$disJAPI = $row['voice_discord_japi'];
					$disInvitecode = $row['voice_discord_invitecode'];
					$disWidth = $row['voice_discord_width'];
					$disHeight = $row['voice_discord_height'];
					$disTheme = $row['voice_discord_theme'];
					$disTrans = $row['voice_discord_transp'];
					$disiFrame = $row['voice_discord_iframe'];
					$disFrame = $row['voice_discord_frameborder'];
					//Mumble
					//$blePort = "?port=".$sPort."";		// Server Port
					//$bleNickname = "";
					//$blePass = "".$sPass."";		// Server Password
					//$bleChan = "&channel=".$sChan."";		// Server Channel
					//$bleType = "&channelpassword=".$sbleType."";		// Server Channel Password
					// TeamSpeak3
					$tsPort = "?port=".$sPort."";		// Server Port
					$tsNickname = "&nickname=";
					$tsPass = "&password=".$sPass."";		// Server Password
					$tsChan = "&channel=".$sChan."";		// Server Channel
					$tsChanp = "&channelpassword=".$sChanp."";		// Server Channel Password
					// Ventrilo
					$vtPort = ":".$sPort."";		// Server Port		
					$vtServerName = "servername=".$sName.""; // DServer Name
					$vtPass = "&serverpassword=".$sPass."";		// Server Password
					$vtChan = "&channelname=".$sChan."";		// Server Channel
					$vtChanp = "&channelpassword=".$sChanp."";		// Server Channel Password
					// Class
					$bntClass1 = 'class="dropdown-toggle no-block" role="button" ';
					// Name URL
					// Get Type Name
					if($linkUrlType == 0)
					{
						$linkName = $nameLink;	
					}
					elseif($linkUrlType == 1)
					{
						if($sserverType == 1)
						{
							$linkName = LAN_VOI_TYPE_MUM;
						}
						elseif($sserverType == 1)
						{
							$linkName = LAN_VOI_TYPE_TS3;
						}
						elseif($sserverType == 3)
						{
							$linkName = LAN_VOI_TYPE_VENT;
						}
						elseif($sserverType == 4)
						{
							$linkName = LAN_VOI_TYPE_DIS;
						}	
					}
					elseif($linkUrlType == 2)
					{
						$linkName = $sName;
					}

					// Mumble
					if($sserverType == 1)
					{
						$sType = "mumble://";
						if($sbleType == 1)
						{
							$bleType = "?version=1.1.0";
						}
						elseif($sbleType == 2)
						{
							$bleType = "?version=1.2.0";
						}
						$btnClass3 = '<span class="icon-ble"></span> ';
						if(!empty($sPass))
						{
							if(!empty($sChan))
							{
								if(!empty($sPort))
								{
									$voice_exe .='<a '.$btnClass1.'href="'.$sType.''.$sPass.'@'.$sHost.':'.$sPort.'/'.$sChan.'/'.$bleType.'">'.$btnClass3.''.$linkName.'</a>';
								}
								else
								{
									$voice_exe .='<a '.$btnClass1.'href="'.$sType.''.$sPass.'@'.$sHost.'/'.$sChan.'/'.$bleType.'">'.$btnClass3.''.$linkName.'</a>';
								}
							}
							else
							{
								if(!empty($sPort))
								{
									$voice_exe .='<a '.$btnClass1.'href="'.$sType.''.$sPass.'@'.$sHost.':'.$sPort.'/'.$bleType.'">'.$btnClass3.''.$linkName.'</a>';
								}
								else
								{
									$voice_exe .='<a '.$btnClass1.'href="'.$sType.''.$sPass.'@'.$sHost.'/'.$bleType.'">'.$btnClass3.''.$linkName.'</a>';
								}	
							}
						}
						else
						{
							if(!empty($sChan))
							{
								if(!empty($sPort))
								{
									$voice_exe .='<a '.$btnClass1.'href="'.$sType.''.$sHost.':'.$sPort.'/'.$sChan.'/'.$bleType.'">'.$btnClass3.''.$linkName.'</a>';
								}
								else
								{
									$voice_exe .='<a '.$btnClass1.'href="'.$sType.''.$sHost.'/'.$sChan.'/'.$bleType.'">'.$btnClass3.''.$linkName.'</a>';
								}
							}
							else
							{
								if(!empty($sPort))
								{
									$voice_exe .='<a '.$btnClass1.'href="'.$sType.''.$sHost.':'.$sPort.'/'.$bleType.'">'.$btnClass3.''.$linkName.'</a>';
								}
								else
								{
									$voice_exe .='<a '.$btnClass1.'href="'.$sType.''.$sHost.'/'.$bleType.'">'.$btnClass3.''.$linkName.'</a>';
								}
							}
						}
					}
					// TeamSpeak3
					elseif($sserverType == 2)
					{
						if(!USERID)
						{
							$tsnName = "Guest";
						}
						else
						{
							$tsnName = "".USERNAME."";
						}
						$btnClass3 = '<span class="icon-ts3"></span> ';
						$sType = "ts3server://";
						if(!empty($sPass))
						{
							if(!empty($sChan))
							{
								if(!empty($sChanp))
								{
									$voice_exe .='<a '.$btnClass1.'href="'.$sType.''.$sHost.''.$tsPort.''.$tsNickname.''.$tsnName.''.$tsPass.''.$tsChan.''.$tsChanp.'">'.$btnClass3.''.$linkName.'</a>';
								}
								else
								{
									$voice_exe .='<a '.$btnClass1.'href="'.$sType.''.$sHost.''.$tsPort.''.$tsNickname.''.$tsnName.''.$tsPass.''.$tsChan.'">'.$btnClass3.''.$linkName.'</a>';	
								}
							}
							else
							{
								$voice_exe .='<a '.$btnClass1.'href="'.$sType.''.$sHost.''.$tsPort.''.$tsNickname.''.$tsnName.''.$tsPass.'">'.$btnClass3.''.$linkName.'</a>';	
							}
						}
						else
						{
							if(!empty($sChan))
							{
								if(!empty($sChanp))
								{
									$voice_exe .='<a '.$btnClass1.'href="'.$sType.''.$sHost.''.$tsPort.''.$tsNickname.''.$tsnName.''.$tsChan.''.$tsChanp.'">'.$btnClass3.''.$linkName.'</a>';
								}
								else
								{
									$voice_exe .='<a '.$btnClass1.'href="'.$sType.''.$sHost.''.$tsPort.''.$tsNickname.''.$tsnName.''.$tsChan.'">'.$btnClass3.''.$linkName.'</a>';	
								}
							}
							else
							{
								$voice_exe .='<a '.$btnClass1.'href="'.$sType.''.$sHost.''.$tsPort.''.$tsNickname.''.$tsnName.'">'.$btnClass3.''.$linkName.'</a>';	
							}
						}
					}
					// Ventrilo
					elseif($sserverType == 3)
					{
						$btnClass3 = '<span class="icon-vent"></span> ';
						$sType = "ventrilo://";
						if(!empty($sPass))
						{
							if(!empty($sChan))
							{
								if(!empty($sChanp))
								{
									$voice_exe .='<a '.$btnClass1.'href="'.$sType.''.$sHost.''.$vtPort.'/'.$vtServerName.''.$vtPass.''.$vtChan.''.$vtChanp.'">'.$btnClass3.''.$linkName.'</a>';
								}
								else
								{
									$voice_exe .='<a '.$btnClass1.'href="'.$sType.''.$sHost.''.$vtPort.'/'.$vtServerName.''.$vtPass.''.$vtChan.'">'.$btnClass3.''.$linkName.'</a>';
								}
							}
							else
							{
								$voice_exe .='<a '.$btnClass1.'href="'.$sType.''.$sHost.''.$vtPort.'/'.$vtServerName.''.$vtPass.'">'.$btnClass3.''.$linkName.'</a>';	
							}
						}
						else
						{
							if(!empty($sChan))
							{
								if(!empty($sChan))
								{
									$voice_exe .='<a '.$btnClass1.'href="'.$sType.''.$sHost.''.$vtPort.'/'.$vtServerName.''.$vtChan.''.$vtChanp.'">'.$btnClass3.''.$linkName.'</a>';
								}
								else
								{
									$voice_exe .='<a '.$btnClass1.'href="'.$sType.''.$sHost.''.$vtPort.'/'.$vtServerName.''.$vtChan.'">'.$btnClass3.''.$linkName.'</a>';	
								}
							}
							else
							{
								$voice_exe .='<a '.$btnClass1.'href="'.$sType.''.$sHost.''.$vtPort.'/'.$vtServerName.'">'.$btnClass3.''.$linkName.'</a>';	
							}
						}
					}
					// Discord
					elseif($sserverType == 4)
					{
						if(!USERID)
						{
							$userName = "";
						}
						else
						{
							$userName = "".USERNAME."";
						}
						if($disTrans == 0)
						{
							$disTransparent = 'false';
						}
						elseif($disTrans == 1)
						{
							$disTransparent = 'true';
						}
						if($disTheme == 0)
						{
							$disSTheme = "light";
						}
						elseif($disTheme == 1)
						{
							$disSTheme = "dark";
						}
						$btnClass3 = '<span class="icon-discord"></span> ';
						$sType = "https://";
						if(!empty($disID))
						{
							if(!empty($disInvitecode))
							{
								if($disiFrame == 0)
								{
									$voice_exe .='<a '.$btnClass1.'href="'.$sType.'discordapp.com/invite/'.$disInvitecode.'?utm_source=Voice_eXe%20e107%20Plugin&utm_medium=Connect" target="_blank">'.$btnClass3.''.$linkName.'</a>';
								}
								elseif ($disiFrame == 1)
								{
									$voice_exe .='<iframe src="'.$sType.'discordapp.com/widget?id='.$disID.'&theme='.$disSTheme.'&username='.$userName.'" width="'.$disWidth.'" height="'.$disHeight.'" allowtransparency="'.$disTransparent.'" frameborder="'.$disFrame.'"></iframe>';
								}
							}
							elseif(empty($disInvitecode))
							{
								if($disiFrame == 1)
								{
									$voice_exe .='<iframe src="'.$sType.'discordapp.com/widget?id='.$disID.'&theme='.$disSTheme.'&username='.$userName.'" width="'.$disWidth.'" height="'.$disHeight.'" allowtransparency="'.$disTransparent.'" frameborder="'.$disFrame.'"></iframe>';
								}
							}
						}
						elseif(empty($disID))
						{
							if(!empty($disInvitecode))
							{
								if($disiFrame == 0)
								{
									$voice_exe .='<a '.$btnClass1.'href="'.$sType.'discordapp.com/invite/'.$disInvitecode.'?utm_source=Voice_eXe%20e107%20Plugin&utm_medium=Connect" target="_blank">'.$btnClass3.''.$linkName.'</a>';
								}
								elseif ($disiFrame == 1)
								{
									$voice_exe .='<iframe src="'.$sType.'discordapp.com/widget?id='.$disID.'&theme='.$disSTheme.'&username='.$userName.'" width="'.$disWidth.'" height="'.$disHeight.'" allowtransparency="'.$disTransparent.'" frameborder="'.$disFrame.'"></iframe>';
								}
							}
							elseif(empty($disInvitecode))
							{
								if($disiFrame == 1)
								{
									$voice_exe .='<iframe src="'.$sType.'discordapp.com/widget?id='.$disID.'&theme='.$disSTheme.'&username='.$userName.'" width="'.$disWidth.'" height="'.$disHeight.'" allowtransparency="'.$disTransparent.'" frameborder="'.$disFrame.'"></iframe>';
								}
							}
						}
					}
				}
				elseif ($row['voice_enable_msc'] == 1)
				{
				
					$msc = $row['voice_msc'];
					// MSC is Enabled;
					$voice_exe .= e107::getParser()->toHTML($msc);
				}
			}
		}
		
		
		if($pref_eCustomln == 1)
		{
			$VoiPlug_Name = $pref_linkName;	
		}
		else
		{
			$VoiPlug_Name = LAN_VOIPLUG_NAME;	
		}
		
		$text .='
			<ul class="nav navbar-nav navbar-right">
			<li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown">'.$VoiPlug_Name.' <b class="caret"></b></a>
			<ul class="dropdown-menu">
			<li>
			'.$voice_exe.'
			<p></p>
			</li>
			<li class="divider"></li>
			<li>
			<a href="'.e_PLUGIN.'voice/voice.php">'.LAN_VOICE_VIEWERS.'</a>
			</li>
			</ul>
			';
			
		return $text;
	}
	
	
	function sc_voice_discordmenu($parm='')
	{
		$sql = e107::getDB();
		$pref = e107::getPlugPref('voice');
		$voiceDiscordParamsID = $pref['voice_did'];
		
		if($sql->select("voice_exesystem", "voice_id, voice_name, voice_type, voice_discord_id, voice_discord_theme, voice_discord_width, voice_discord_height, voice_discord_transp, voice_discord_frameborder", "voice_id LIKE '". $voiceDiscordParamsID."%'"))
		{
			while($row = $sql->db_Fetch())
			{
				$sID = $row['voice_discord_id'];
				$disTheme = $row['voice_discord_theme'];
				$disFrameBorder = $row['voice_discord_frameborder'];
				$disWidth = $row['voice_discord_width'];
				$disHeight = $row['voice_discord_height'];
				$disTransp = $row['voice_discord_transp'];
				
				if($disTheme == 0)
				{
					$sTheme = "light";
				}
				elseif($disTheme == 1)
				{
					$sTheme = "dark";
				}
				
				if($disTransp == 0)
				{
					$sTransp = "false";
				}
				elseif($disTransp == 1)
				{
					$sTransp = "true";
				}
				
				$sType = "https://";
				$text .= '<iframe src="'.$sType.'discordapp.com/widget?id='.$sID.'&theme='.$sTheme.'&username='.$userName.'" width="'.$disWidth.'" height="'.$disHeight.'" allowtransparency="'.$sTransp.'" frameborder="'.$disFrameBorder.'"></iframe>';
			}
		}
		return e107::getParser()->toHtml($text, true);
	}
}

?>