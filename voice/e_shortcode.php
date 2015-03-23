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
	
	
	public function __construct()
	{
		
	}
	
	function sc_voice_exe()
	{
		$sql = e107::getDB();
		$sql->select('voice_exesystem', 'voice_name, voice_type, voice_ip, voice_port, voice_qport, voice_enable_sc, voice_enable_msc, voice_msc, voice_password, voice_channel, voice_channelpass, voice_type_version'); 
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
					$msc = $row['voice_msc'];
					$sChan = $row['voice_channel'];
					$sChanp = $row['voice_channelpass'];
					$sbleType = $row['voice_type_version'];
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
					// Would be Mumble
					if($row['voice_type'] == 1)
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
							$bntClass1 = 'class="dropdown-toggle no-block" role="button" ';
							$btnClass3 = '<span class="glyphicon glyphicon-headphones"></span>';
						if(!empty($sPass))
						{
							if(!empty($sChan))
							{
								if(!empty($sPort))
								{
									$text .='<a '.$btnClass1.'href="'.$sType.''.$sPass.'@'.$sHost.':'.$sPort.'/'.$sChan.'/'.$bleType.'">'.$btnClass3.'Mumble</a>';
								}
								else
								{
									$text .='<a '.$btnClass1.'href="'.$sType.''.$sPass.'@'.$sHost.'/'.$sChan.'/'.$bleType.'">'.$btnClass3.'Mumble</a>';
								}
							}
							else
							{
								if(!empty($sPort))
								{
									$text .='<a '.$btnClass1.'href="'.$sType.''.$sPass.'@'.$sHost.':'.$sPort.'/'.$bleType.'">'.$btnClass3.'Mumble</a>';
								}
								else
								{
									$text .='<a '.$btnClass1.'href="'.$sType.''.$sPass.'@'.$sHost.'/'.$bleType.'">'.$btnClass3.'Mumble</a>';
								}	
							}
						}
						else
						{
							if(!empty($sChan))
							{
								if(!empty($sPort))
								{
									$text .='<a '.$btnClass1.'href="'.$sType.''.$sHost.':'.$sPort.'/'.$sChan.'/'.$bleType.'">'.$btnClass3.'Mumble</a>';
								}
								else
								{
									$text .='<a '.$btnClass1.'href="'.$sType.''.$sHost.'/'.$sChan.'/'.$bleType.'">'.$btnClass3.'Mumble</a>';
								}
							}
							else
							{
								if(!empty($sPort))
								{
									$text .='<a '.$btnClass1.'href="'.$sType.''.$sHost.':'.$sPort.'/'.$bleType.'">'.$btnClass3.'Mumble</a>';
								}
								else
								{
									$text .='<a '.$btnClass1.'href="'.$sType.''.$sHost.'/'.$bleType.'">'.$btnClass3.'Mumble</a>';
								}
							}
						}
					}
					// Would be TeamSpeak3
					elseif($row['voice_type'] == 2)
					{
						//if(!USERID)
						//{
						//	$tsnName = "Guest";
						//}
						//else
						//{
							$tsnName = "".USERNAME."";
						//}
						$bntClass1 = 'class="dropdown-toggle no-block" role="button" ';
						$btnClass3 = '<span class="glyphicon glyphicon-headphones"></span>';
						$sType = "ts3server://";
						//if(!USERID) // Logged Out. 
						//{
							if(!empty($sPass))
						{
							if(!empty($sChan))
							{
								if(!empty($sChanp))
								{
									$text .='<a '.$btnClass1.'href="'.$sType.''.$sHost.''.$tsPort.''.$tsNickname.''.$tsnName.''.$tsPass.''.$tsChan.''.$tsChanp.'">'.$btnClass3.'TeamSpeak3</a>';
								}
								else
								{
									$text .='<a '.$btnClass1.'href="'.$sType.''.$sHost.''.$tsPort.''.$tsNickname.''.$tsnName.''.$tsPass.''.$tsChan.'">'.$btnClass3.'TeamSpeak3</a>';	
								}
							}
							else
							{
								$text .='<a '.$btnClass1.'href="'.$sType.''.$sHost.''.$tsPort.''.$tsNickname.''.$tsnName.''.$tsPass.'">'.$btnClass3.'TeamSpeak3</a>';	
							}
						}
						else
						{
							if(!empty($sChan))
							{
								if(!empty($sChanp))
								{
									$text .='<a '.$btnClass1.'href="'.$sType.''.$sHost.''.$tsPort.''.$tsNickname.''.$tsnName.''.$tsChan.''.$tsChanp.'">'.$btnClass3.'TeamSpeak3</a>';
								}
								else
								{
									$text .='<a '.$btnClass1.'href="'.$sType.''.$sHost.''.$tsPort.''.$tsNickname.''.$tsnName.''.$tsChan.'">'.$btnClass3.'TeamSpeak3</a>';	
								}
							}
							else
							{
								$text .='<a '.$btnClass1.'href="'.$sType.''.$sHost.''.$tsPort.''.$tsNickname.''.$tsnName.'">'.$btnClass3.'TeamSpeak3</a>';	
							}
						}
					}
					// Would be Ventrilo
					elseif($row['voice_type'] == 3)
					{

						$bntClass1 = 'class="dropdown-toggle no-block" role="button" ';
						$btnClass3 = '<span class="glyphicon glyphicon-headphones"></span>';
						$sType = "ventrilo://";
						if(!empty($sPass))
						{
							if(!empty($sChan))
							{
								if(!empty($sChanp))
								{
									$text .='<a '.$btnClass1.'href="'.$sType.''.$sHost.''.$vtPort.'/'.$vtServerName.''.$vtPass.''.$vtChan.''.$vtChanp.'">'.$btnClass3.'Ventrilo</a>';
								}
								else
								{
									$text .='<a '.$btnClass1.'href="'.$sType.''.$sHost.''.$vtPort.'/'.$vtServerName.''.$vtPass.''.$vtChan.'">'.$btnClass3.'Ventrilo</a>';
								}
							}
							else
							{
								$text .='<a '.$btnClass1.'href="'.$sType.''.$sHost.''.$vtPort.'/'.$vtServerName.''.$vtPass.'">'.$btnClass3.'Ventrilo</a>';	
							}
						}
						else
						{
							if(!empty($sChan))
							{
								if(!empty($sChan))
								{
									$text .='<a '.$btnClass1.'href="'.$sType.''.$sHost.''.$vtPort.'/'.$vtServerName.''.$vtChan.''.$vtChanp.'">'.$btnClass3.'Ventrilo</a>';
								}
								else
								{
									$text .='<a '.$btnClass1.'href="'.$sType.''.$sHost.''.$vtPort.'/'.$vtServerName.''.$vtChan.'">'.$btnClass3.'Ventrilo</a>';	
								}
							}
							else
							{
								$text .='<a '.$btnClass1.'href="'.$sType.''.$sHost.''.$vtPort.'/'.$vtServerName.'">'.$btnClass3.'Ventrilo</a>';	
							}
						}
					}
				}
				else
				{
					// MSC is Enabled
					$text .=''.$msc.'';
				}
			}
			
		}
		
		return $text;
		//return "Testing Here";
	}
	
		//function sc_lo_voice($parm='')
		//{
		//	return "Hello ".USERNAME;
		//}
		
		//function sc_voice($parm)
		//{
		//	return '<a href="'.$stype.''.$vartrue($this->var['voice_ip']).'" >Voice Comms</a>';	
		//}
}

?>