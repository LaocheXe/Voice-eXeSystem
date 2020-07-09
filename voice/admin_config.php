<?php

// Generated e107 Plugin Admin Area 

require_once('../../class2.php');
if (!getperms('P')) 
{
	header('location:'.e_BASE.'index.php');
	exit;
}

// Added Language URL - eXe
//include_lan(e_PLUGIN.'voice/languages/'.e_LANGUAGE.'.php');
e107::lan('voice', true, true);

class voice_admin extends e_admin_dispatcher
{

	protected $modes = array(	
	
		'main'	=> array(
			'controller' 	=> 'voice_exesystem_ui',
			'path' 			=> null,
			'ui' 			=> 'voice_exesystem_form_ui',
			'uipath' 		=> null
		),
		

	);	
	
	
	protected $adminMenu = array(

		'main/list'			=> array('caption'=> LAN_MANAGE, 'perm' => 'P'),
		'main/create'		=> array('caption'=> LAN_CREATE, 'perm' => 'P'),
		'main/prefs' 		=> array('caption'=> LAN_PREFS, 'perm' => 'P'),	
		'main/info'			=> array('caption'=> LAN_VOI_INFO_NAME, 'perm' => 'P'),
		'main/example'		=> array('caption'=> LAN_VOI_EXAMPLE, 'perm' => 'P'),
		//'main/sync'		=> array('caption'=> LAN_VOI_UPDATE, 'perm' => 'P')
		
		// 'main/custom'		=> array('caption'=> 'Custom Page', 'perm' => 'P')
	);

	protected $adminMenuAliases = array(
		'main/edit'	=> 'main/list'				
	);	
	
	protected $menuTitle = 'Voice eXeSystem'; //TODO LANS
}




				
class voice_exesystem_ui extends e_admin_ui
{
			
		protected $pluginTitle		= 'Voice eXeSystem';
		protected $pluginName		= 'voice';
		protected $table			= 'voice_exesystem';
		protected $pid				= 'voice_id';
		protected $perPage			= 10; 
		protected $batchDelete		= true;
	//	protected $batchCopy		= true;		
	//	protected $sortField		= 'somefield_order';
	//	protected $orderStep		= 10;
	//	protected $tabs			= array(LAN_VOI_NORM_T,LAN_VOI_BLE_V,LAN_VOI_TS3_V,LAN_VOI_VENT_V); // Use 'tab'=>0  OR 'tab'=>1 in the $fields below to enable. 
		protected $tabs			= array(LAN_VOI_NORM_T,LAN_VOI_TYPE_DIS,LAN_VOI_TYPE_MUM,LAN_VOI_TYPE_TS3,LAN_VOI_TYPE_VEN); // Use 'tab'=>0  OR 'tab'=>1 in the $fields below to enable. 
		
	//	protected $listQry      	= "SELECT * FROM #tableName WHERE field != '' "; // Example Custom Query. LEFT JOINS allowed. Should be without any Order or Limit.
	
		protected $listOrder		= 'voice_id DESC';
	
		protected $fields 		= array (  'checkboxes' =>   array ( 'title' => '', 'type' => null, 'data' => null, 'width' => '5%', 'thclass' => 'center', 'forced' => '1', 'class' => 'center', 'toggle' => 'e-multiselect',  ),
		  'voice_id' =>   array ( 'title' => LAN_ID, 'data' => 'int', 'width' => '5%', 'help' => '', 'readParms' => '', 'writeParms' => '', 'class' => 'left', 'thclass' => 'left',  ),
		  'voice_name' =>   array ( 'title' => LAN_VOI_NAME, 'type' => 'text', 'tab' => 0, 'data' => 'str', 'width' => 'auto', 'inline' => true, 'help' => LAN_VOI_INFO_VSN, 'readParms' => '', 'writeParms' => '', 'class' => 'left', 'thclass' => 'left',  ),
		  'voice_type' =>   array ( 'title' => LAN_VOI_TYPE, 'type' => 'dropdown', 'tab' => 0, 'data' => 'int', 'width' => 'auto', 'filter' => true, 'inline' => true, 'help' => LAN_VOI_INFO_ST, 'readParms' => '', 'writeParms' => '', 'class' => 'left', 'thclass' => 'left',  ),
		  'voice_ip' =>   array ( 'title' => LAN_VOI_IP, 'type' => 'text', 'tab' => 0, 'data' => 'str', 'width' => 'auto', 'inline' => true, 'help' => LAN_VOI_INFO_SIP, 'readParms' => '', 'writeParms' => '', 'class' => 'left', 'thclass' => 'left',  ),
		  'voice_port' =>   array ( 'title' => LAN_VOI_PORT, 'type' => 'number', 'tab' => 0, 'data' => 'int', 'width' => 'auto', 'inline' => true, 'help' => LAN_VOI_INFO_VSP, 'readParms' => '', 'writeParms' => '', 'class' => 'center', 'thclass' => 'center',  ),
		  'voice_qport' =>   array ( 'title' => LAN_VOI_QPORT, 'type' => 'number', 'tab' => 3, 'data' => 'int', 'width' => 'auto', 'inline' => true, 'help' => LAN_VOI_INFO_VSQP, 'readParms' => '', 'writeParms' => '', 'class' => 'center', 'thclass' => 'center',  ),
		  'voice_enable_sc' =>   array ( 'title' => LAN_VOI_SCENABLE, 'type' => 'boolean', 'tab' => 0, 'data' => 'int', 'width' => 'auto', 'inline' => true, 'help' => LAN_VOI_INFO_ESC, 'readParms' => '', 'writeParms' => '', 'class' => 'center', 'thclass' => 'center',  ),
		  'voice_enable_msc' =>   array ( 'title' => LAN_VOI_MSCENABLE, 'type' => 'boolean', 'tab' => 0, 'data' => 'int', 'width' => 'auto', 'inline' => true, 'help' => LAN_VOI_INFO_CESC, 'readParms' => '', 'writeParms' => '', 'class' => 'center', 'thclass' => 'center',  ),
		  'voice_msc' =>   array ( 'title' => LAN_VOI_MSC, 'type' => 'textarea', 'tab' => 0, 'data' => 'str', 'width' => 'auto', 'inline' => true, 'help' => LAN_VOI_INFO_CSC, 'readParms' => '', 'writeParms' => '', 'class' => 'center', 'thclass' => 'center',  ),
		  'voice_password' =>   array ( 'title' => LAN_VOI_SERPASS, 'type' => 'text', 'tab' => 0, 'data' => 'str', 'width' => 'auto', 'inline' => true, 'help' => LAN_VOI_INFO_PASS, 'readParms' => '', 'writeParms' => '', 'class' => 'center', 'thclass' => 'center',  ),
		  'voice_channel' =>   array ( 'title' => LAN_VOI_CHANNEL, 'type' => 'text', 'tab' => 0, 'data' => 'str', 'width' => 'auto', 'inline' => true, 'help' => LAN_VOI_INFO_CNL, 'readParms' => '', 'writeParms' => '', 'class' => 'center', 'thclass' => 'center',  ),
		  'voice_channelpass' =>   array ( 'title' => LAN_VOI_CHAPASS, 'type' => 'text', 'tab' => 0, 'data' => 'str', 'width' => 'auto', 'inline' => true, 'help' => LAN_VOI_INFO_CNP, 'readParms' => '', 'writeParms' => '', 'class' => 'center', 'thclass' => 'center',  ),
		  'voice_type_version' =>   array ( 'title' => LAN_VOI_TYPEVERSION, 'tab' => 2, 'type' => 'dropdown', 'data' => 'int', 'width' => 'auto', 'inline' => true, 'help' => LAN_VOI_INFO_BLEV, 'readParms' => '', 'writeParms' => '', 'class' => 'center', 'thclass' => 'center',  ),
		  'voice_listname' =>   array ( 'title' => LAN_VOI_LISTNAME, 'type' => 'dropdown', 'tab' => 0, 'data' => 'int', 'width' => 'auto', 'filter' => true, 'inline' => true, 'help' => LAN_VOI_INFO_URL, 'readParms' => '', 'writeParms' => '', 'class' => 'left', 'thclass' => 'left',  ),
		  'voice_qname' =>   array ( 'title' => LAN_VOI_Q_NAME, 'tab' => 3, 'type' => 'text', 'data' => 'str', 'width' => 'auto', 'inline' => true, 'help' => LAN_VOI_INFO_QNAME, 'readParms' => '', 'writeParms' => '', 'class' => 'left', 'thclass' => 'left',  ),
		  'voice_qpass' =>   array ( 'title' => LAN_VOI_Q_PASS, 'tab' => 3, 'type' => 'text', 'data' => 'str', 'width' => 'auto', 'inline' => true, 'help' => LAN_VOI_INFO_QPASS, 'readParms' => '', 'writeParms' => '', 'class' => 'center', 'thclass' => 'center',  ),
		  'voice_discord_id' =>   array ( 'title' => LAN_VOI_DISID, 'type' => 'text', 'tab' => 1, 'data' => 'str', 'width' => 'auto', 'inline' => true, 'help' => LAN_VOI_INFO_VDID, 'readParms' => '', 'writeParms' => '', 'class' => 'left', 'thclass' => 'left',  ),
		  'voice_discord_invitecode' =>   array ( 'title' => LAN_VOI_DISINVITE, 'type' => 'text', 'tab' => 1, 'data' => 'str', 'width' => 'auto', 'inline' => true, 'help' => LAN_VOI_INFO_VDINTE, 'readParms' => '', 'writeParms' => '', 'class' => 'left', 'thclass' => 'left',  ),
		  'voice_discord_japi' =>   array ( 'title' => LAN_VOI_JAPI, 'type' => 'hidden', 'tab' => 1, 'data' => 'str', 'width' => 'auto', 'inline' => true, 'help' => LAN_VOI_INFO_VDJAPI, 'readParms' => '', 'writeParms' => '', 'class' => 'left', 'thclass' => 'left',  ),	
		  'voice_discord_theme' =>   array ( 'title' => LAN_VOI_DISTHEME, 'type' => 'dropdown', 'tab' => 1, 'data' => 'int', 'width' => 'auto', 'filter' => true, 'inline' => true, 'help' => LAN_VOI_INFO_VDTHEM, 'readParms' => '', 'writeParms' => '', 'class' => 'left', 'thclass' => 'left', ), 
		  'voice_discord_width' =>   array ( 'title' => LAN_VOI_DISWIDTH, 'type' => 'number', 'tab' => 1, 'data' => 'int', 'width' => 'auto', 'inline' => true, 'help' => LAN_VOI_INFO_VDWIDTH, 'readParms' => '', 'writeParms' => '', 'class' => 'center', 'thclass' => 'center',  ),
		  'voice_discord_height' =>   array ( 'title' => LAN_VOI_DISHEIGHT, 'type' => 'number', 'tab' => 1, 'data' => 'int', 'width' => 'auto', 'inline' => true, 'help' => LAN_VOI_INFO_VDHEIGHT, 'readParms' => '', 'writeParms' => '', 'class' => 'center', 'thclass' => 'center',  ),
		  'voice_discord_transp' =>   array ( 'title' => LAN_VOI_DISTRANS, 'type' => 'boolean', 'tab' => 1, 'data' => 'int', 'width' => 'auto', 'filter' => true, 'inline' => true, 'help' => LAN_VOI_INFO_VDTRANS, 'readParms' => '', 'writeParms' => '', 'class' => 'left', 'thclass' => 'left', ), 
		  'voice_discord_iframe' =>   array ( 'title' => LAN_VOI_DISIFRAME, 'type' => 'boolean', 'tab' => 1, 'data' => 'int', 'width' => 'auto', 'filter' => true, 'inline' => true, 'help' => LAN_VOI_INFO_VDIFRAME, 'readParms' => '', 'writeParms' => '', 'class' => 'left', 'thclass' => 'left', ),
		  'voice_discord_frameborder' =>   array ( 'title' => LAN_VOI_DISFBORDER, 'type' => 'number', 'tab' => 1, 'data' => 'int', 'width' => 'auto', 'inline' => true, 'help' => LAN_VOI_INFO_VDFBOR, 'readParms' => '', 'writeParms' => '', 'class' => 'center', 'thclass' => 'center',  ),
		  'voice_viewer' =>   array ( 'title' => LAN_VOI_VCCENABLE, 'type' => 'boolean', 'tab' => 0, 'data' => 'int', 'width' => 'auto', 'inline' => true, 'help' => LAN_VOI_INFO_VCC, 'readParms' => '', 'writeParms' => '', 'class' => 'center', 'thclass' => 'center',  ),
		  'voice_viewer_cc' =>   array ( 'title' => LAN_VOI_CC, 'type' => 'textarea', 'tab' => 0, 'data' => 'str', 'width' => 'auto', 'inline' => true, 'help' => LAN_VOI_INFO_CC, 'readParms' => '', 'writeParms' => '', 'class' => 'center', 'thclass' => 'center',  ),
		  'options' =>   array ( 'title' => 'Options', 'type' => null, 'data' => null, 'width' => '10%', 'thclass' => 'center last', 'class' => 'center last', 'forced' => '1',  ),
		);		
		//frameborder
		protected $fieldpref = array('voice_name', 'voice_type', 'voice_ip', 'voice_port', 'voice_enable_sc', 'voice_enable_msc');
		
		protected $preftabs = array(LAN_GENERAL, "Discord Menu"); // Maybe more in the future
		
		protected $prefs = array(
			'eCustomln'		=> array(
				'title'	=>	LAN_VOIEXE_ADMIN_PREF_ECLN, 
				'type'	=>	'boolean',
				'data' 	=>	'str',
				'help'	=>	LAN_VOIEXE_ADMIN_PREF_ECLN_TIP,
				'tab'	=>	0,
			),
			'linkName'		=> array(
				'title'	=>	LAN_VOIEXE_ADMIN_PREF_LN,
				'type'	=>	'text',
				'data' 	=>	'str',
				'help'	=>	LAN_VOIEXE_ADMIN_PREF_LN_TIP,
				'tab'	=>	0,
			),
			'voice_dmtitle'		=> array(
				'title'	=>	LAN_VOIEXE_ADMIN_PREF_DMT,
				'type'	=>	'text',
				'data' 	=>	'str',
				'help'	=>	LAN_VOIEXE_ADMIN_PREF_DMT_TIP,
				'tab'	=>	1,
			),
			'voice_did'		=> array(
				'title'	=>	LAN_VOIEXE_ADMIN_PREF_DID,
				'type'	=>	'dropdown',
				'data' 	=>	'str',
				'help'	=>	LAN_VOIEXE_ADMIN_PREF_DID_TIP,
				'tab'	=>	1,
			),
			'voice_dviewclass'		=> array(
				'title'	=>	LAN_VOIEXE_ADMIN_PREF_DVC,
				'type'	=>	'userclass',
				'data' 	=>	'str',
				'help'	=>	LAN_VOIEXE_ADMIN_PREF_DVC_TIP,
				'tab'	=>	1,
			),
		); 

		private $discordServer = array();
		
		public function init()
		{
			// Set drop-down values (if any). 
			$this->fields['voice_type']['writeParms'] = array(LAN_VOI_SELECT, LAN_VOI_TYPE_MUM, LAN_VOI_TYPE_TS3, LAN_VOI_TYPE_VEN, LAN_VOI_TYPE_DIS); // Example Drop-down array. 
			$this->fields['voice_type_version']['writeParms'] = array(LAN_VOI_SELECT, LAN_VOI_MUM_V1, LAN_VOI_MUM_V2); // Example Drop-down array. 
			$this->fields['voice_listname']['writeParms'] = array(LAN_VOI_SELECT, LAN_VOI_LU_STYPE, LAN_VOI_LU_SNAME);
			$this->fields['voice_discord_theme']['writeParms'] = array(LAN_VOI_DI_LIGHT, LAN_VOI_DI_DARK);
			
			// For Discord Menu
			$this->discordServer[0] = "None Selected"; // TODO - LAN MAYBE?
			//if($sql->gen("SELECT voice_id,voice_name,voice_type FROM `#voice_exesystem` WHERE voice_type = '4'"))
			$disParmsQ = "SELECT voice_id,voice_name,voice_type FROM `#voice_exesystem` WHERE voice_type = 4";
			$rows = e107::getDB()->retrieve($disParmsQ, true);
			foreach($rows as $row)
			{
				$this->discordServer[$row['voice_id']] = $row['voice_name'];
			}
			$this->prefs['voice_did']['writeParms']['optArray'] = $this->discordServer;
		}
		
		// Infomarion Section 
		public function infoPage()
		{	
			$ns = e107::getRender();
			$text = '<center><img src="images/voice_logo.png" width="100" height="100"></center>
			<br /><br />
			<table>
			<tr>
			<th><font size="+1"><u>'.LAN_VOI_INFO_AIN.'</u></font></th>
			</tr>
			<tbody>
			<tr>
			<td align="right"><b>'.LAN_VOI_INFO_01.'</td>
			<td> </td>
			<td align="left"><i> <a href="mailto:forbiddenchaos@gmail.com" target="_blank">LaocheXe</a></i></b></td>
			</tr>
			<tr>
			<td align="right"><b>'.LAN_VOI_INFO_02.'</td>
			<td> </td>
			<td align="left"><i> <a href="http://defiantz.org" target="_blank">'.LAN_VOI_INFO_SITENAME.'</a></i></b></td>
			</tr>
			<tr>
			<td align="right"><b>'.LAN_VOI_INFO_03.'</td>
			<td> </td>
			<td align="left"><i> <a href="mailto:forbiddenchaos@gmail.com" target="_blank">forbiddenchaos@gmail.com</a></i></b></td>
			</tr>
			</tbody>
			</table>
			<br /><br />
			<table>
			<tr>
			<th><font size="+1"><u>'.LAN_VOI_INFO_PIN.'</u></font></th>
			</tr>
			<tr>
			<td align="right"><b>'.LAN_VOI_NAME.'</b>:</td>
			<td> </td>
			<td align="left">'.LAN_VOI_INFO_VSN.'</td>
			</tr>
			<tr>
			<td align="right"><b>'.LAN_VOI_TYPE.'</b>:</td>
			<td> </td>
			<td align="left">'.LAN_VOI_INFO_ST.'</td>
			</tr>
			<tr>
			<td align="right"><b>'.LAN_VOI_IP.'</b>:</td>
			<td> </td>
			<td align="left">'.LAN_VOI_INFO_SIP.'</td>
			</tr>
			<tr>
			<td align="right"><b>'.LAN_VOI_PORT.'</b>:</td>
			<td> </td>
			<td align="left">'.LAN_VOI_INFO_VSP.'</td>
			</tr>
			<tr>
			<td align="right"><b>'.LAN_VOI_QPORT.'</b>:</td>
			<td> </td>
			<td align="left">'.LAN_VOI_INFO_VSQP.'</td>
			</tr>
			<tr>
			<td align="right"><b>'.LAN_VOI_SCENABLE.'</b>:</td>
			<td> </td>
			<td align="left">'.LAN_VOI_INFO_ESC.'</td>
			</tr>
			<tr>
			<td align="right"><b>'.LAN_VOI_MSCENABLE.'</b>:</td>
			<td> </td>
			<td align="left">'.LAN_VOI_INFO_CESC.'</td>
			</tr>
			<tr>
			<td align="right"><b>'.LAN_VOI_MSC.'</b>:</td>
			<td> </td>
			<td align="left">'.LAN_VOI_INFO_CSC.'</td>
			</tr>
			<tr>
			<td align="right"><b>'.LAN_VOI_SERPASS.'</b>:</td>
			<td> </td>
			<td align="left">'.LAN_VOI_INFO_PASS.'</td>
			</tr>
			<tr>
			<td align="right"><b>'.LAN_VOI_CHANNEL.'</b>:</td>
			<td> </td>
			<td align="left">'.LAN_VOI_INFO_CNL.'</td>
			</tr>
			<tr>
			<td align="right"><b>'.LAN_VOI_CHAPASS.'</b>:</td>
			<td> </td>
			<td align="left">'.LAN_VOI_INFO_CNP.'</td>
			</tr>
			<tr>
			<td align="right"><b>'.LAN_VOI_TYPEVERSION.'</b>:</td>
			<td> </td>
			<td align="left">'.LAN_VOI_INFO_BLEV.'</td>
			</tr>
			</tr>
			<tr>
			<td align="right"><b>'.LAN_VOI_LISTNAME.'</b>:</td>
			<td> </td>
			<td align="left">'.LAN_VOI_INFO_URL.'</td>
			</tr>
			</table>
			<br /><br />
			<table>
			<tr>
			<th><font size="+1"><u>'.LAN_VOI_INFO_MSC_NAME.'</u></font></th>
			</tr>
			<tr>
			<td align="right"><b>'.LAN_VOI_INFO_MSC_INFO_NAME.'</b>:</td>
			<td> </td>
			<td align="left">'.LAN_VOI_INFO_MSC_INFO.'</td>
			</tr>
			<tr>
			<td align="right"><b>'.LAN_VOI_TYPE_TS3.'</b>:</td>
			<td> </td>
			<td align="left">'.LAN_VOI_INFO_MSC_TS3.' '.LAN_VOI_INFO_IN_TS3.'</td>
			</tr>
			<tr>
			<td></td>
			<td></td>
			<td align="left">'.LAN_VOI_INFO_EXM_TS3.'</td>
			</tr>
			<tr>
			<td align="right"><b>'.LAN_VOI_TYPE_VEN.'</b>:</td>
			<td> </td>
			<td align="left">'.LAN_VOI_INFO_MSC_VENT.' '.LAN_VOI_INFO_IN_VENT.'</td>
			</tr>
			<tr>
			<td></td>
			<td></td>
			<td align="left">'.LAN_VOI_INFO_EXM_VEN.'</td>
			</tr>
			<tr>
			<td align="right"><b>'.LAN_VOI_TYPE_MUM.'</b>:</td>
			<td> </td>
			<td align="left">'.LAN_VOI_INFO_MSC_BLE.' '.LAN_VOI_INFO_IN_BLE.'</td>
			</tr>
			<tr>
			<td></td>
			<td></td>
			<td align="left">'.LAN_VOI_INFO_EXM_BLE.'</td>
			</tr>
			</table>
			<br />
			<table>
			<tr>
			<th><font size="+1"><u>'.LAN_VOI_INFO_CIN.'</u></font></th>
			</tr>
			<tr>
			<td align="right"><b>'.LAN_VOI_INFO_CIN_DIS.'</b>:</td>
			<td> </td>
			<td align="left">'.LAN_VOI_INFO_CIN_DIS_A.'</td>
			<td> </td>
			</tr>
			<tr>
			<td></td>
			</tr>
			</table>
			<br />
			<br />
			<table>
			</table>
			<br /><br />
			<table align="center">
			<tfoot>
			<tr>
			<td align="center"><b>'.LAN_DONATE_MSG.'</b></td>
			</tr>
			<tr>
			<td align="center">
			</td>
			</tr>
			</tfoot>
			</table>
			';
			$ns->tablerender(LAN_VOI_INFOMA,$text);	
		}
	
		public function examplePage()
		{
			$file1 = 'example/themes_shortcodes.php';
			$content1 = highlight_file($file1, true);
			
			$file2 = 'example/theme_shortcodes.php';
			$content2 = highlight_file($file2, true);
			
			$ns = e107::getRender();
			$text .='
			<table>
			<tr>
			<th><font size="+1"><u>'.LAN_VOI_INFO_TSC_CODE2.'</u></font></th>
			</tr>
			<tr>
			<td> </td>
			<td>
			<div id=inputCode">';
			$text .= $content1;
			$text .='</div>
			</td>
			</tr>
			</table>
			<p></p>';
			$text .='
			<table>
			<tr>
			<th><font size="+1"><u>'.LAN_VOI_INFO_TSC_CODE1.'</u></font></th>
			</tr>
			<tr>
			<td> </td>
			<td>
			<div id=inputCode">';
			$text .= $content2;
			$text .='</div>
			</td>
			</tr>
			</table>
			<p></p>
			';
			$text .='
			<br /><br />
			<br /><br />
			<table align="center">
			<tfoot>
			<tr>
			<td align="center"><b>'.LAN_DONATE_MSG.'</b></td>
			</tr>
			<tr>
			<td align="center">
			</td>
			</tr>
			</tfoot>
			</table>
			';
			$ns->tablerender(LAN_VOI_EXAMPLE,$text);	
		}
		
	/*	
		// optional - override edit page. 
		public function customPage()
		{
			$ns = e107::getRender();
			$text = 'Hello World!';
			$ns->tablerender('Hello',$text);	
			
		}
	*/
			
}
				


class voice_exesystem_form_ui extends e_admin_form_ui
{

}		
		
		
new voice_admin();

require_once(e_ADMIN."auth.php");
e107::getAdminUI()->runPage();

require_once(e_ADMIN."footer.php");
exit;

?>