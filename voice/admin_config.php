<?php

// Generated e107 Plugin Admin Area 

require_once('../../class2.php');
if (!getperms('P')) 
{
	header('location:'.e_BASE.'index.php');
	exit;
}

// Added Language URL - eXe
include_lan(e_PLUGIN.'voice/languages/'.e_LANGUAGE.'.php');

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
		'main/info'			=> array('caption'=> LAN_VOI_INFO_NAME, 'perm' => 'P'),
		'main/example'		=> array('caption'=> LAN_VOI_EXAMPLE, 'perm' => 'P'),
		'main/update'		=> array('caption'=> LAN_VOI_UPDATE, 'perm' => 'P')

		// 'main/custom'		=> array('caption'=> 'Custom Page', 'perm' => 'P')
	);

	protected $adminMenuAliases = array(
		'main/edit'	=> 'main/list'				
	);	
	
	protected $menuTitle = 'Voice eXeSystem';
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
		  'options' =>   array ( 'title' => 'Options', 'type' => null, 'data' => null, 'width' => '10%', 'thclass' => 'center last', 'class' => 'center last', 'forced' => '1',  ),
		);		
		//frameborder
		protected $fieldpref = array('voice_name', 'voice_type', 'voice_ip', 'voice_port', 'voice_enable_sc', 'voice_enable_msc');
		
		
		protected $prefs = array(); 

	
		public function init()
		{
			// Set drop-down values (if any). 
			$this->fields['voice_type']['writeParms'] = array(LAN_VOI_SELECT, LAN_VOI_TYPE_MUM, LAN_VOI_TYPE_TS3, LAN_VOI_TYPE_VEN, LAN_VOI_TYPE_DIS); // Example Drop-down array. 
			$this->fields['voice_type_version']['writeParms'] = array(LAN_VOI_SELECT, LAN_VOI_MUM_V1, LAN_VOI_MUM_V2); // Example Drop-down array. 
			$this->fields['voice_listname']['writeParms'] = array(LAN_VOI_SELECT, LAN_VOI_LU_STYPE, LAN_VOI_LU_SNAME);
			$this->fields['voice_discord_theme']['writeParms'] = array(LAN_VOI_DI_LIGHT, LAN_VOI_DI_DARK);
			//$this->fields['voice_discord_transp']['writeParms'] = array(LAN_VOI_DI_FALSE, LAN_VOI_DI_TRUE);
			//$this->fields['voice_discord_iframe']['writeParms'] = array(LAN_VOI_DI_DISABLE, LAN_VOI_DI_ENABLE);
	
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
			<td align="center"><form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
			<input type="hidden" name="cmd" value="_s-xclick">
			<input type="hidden" name="encrypted" value="-----BEGIN PKCS7-----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-----END PKCS7-----
">
			<input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_donate_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
			<img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" width="1" height="1">
			</form>
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
			<td align="center"><form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
			<input type="hidden" name="cmd" value="_s-xclick">
			<input type="hidden" name="encrypted" value="-----BEGIN PKCS7-----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-----END PKCS7-----
">
			<input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_donate_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
			<img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" width="1" height="1">
			</form>
			</td>
			</tr>
			</tfoot>
			</table>
			';
			$ns->tablerender(LAN_VOI_EXAMPLE,$text);	
		}
		
		public function updatePage()
		{
			$ns = e107::getRender();
			//$st = new system_tools;
			
			//class system_tools
			//{
				//public $_options = array();
				//private $_utf8_exclude = array();
				
				//function __construct()
				//{
					//global $mySQLdefaultdb;
					//$this->_utf8_exclude = array(MPREFIX."core");
					
					$this->_options['github'] = array('diz'=>"<span class='label label-warning'>Developer Mode Only</span> Overwrite local files with the latest from github.", 'label'=> 'Sync with Github' );
					
					$this->_options = multiarray_sort($this->_options, 'label');
					
					if(!empty($_POST['githubSyncProcess']))
					{
						$this->githubSyncProcess();
						return;
					}
					
					if(varset($_GET['mode']) == 'github')
					{
						$this->githubSync();
					}
					
					function githubSync()
					{
						$frm = e107::getForm();
						$mes = e107::getMessage();
						
						$message = $frm->open('githubSync');
						$message .= "<p>This will download the latest .zip file from github to <b>".e_SYSTEM."/temp</b> and then unzip it, overwriting any existing files that it finds on your server. It will take into account any custom folders you may have set in e107_config.php. </p>";
						$message .= $frm->button('githubSyncProcess',1,'delete', "Overwrite Files");
						$message .= $frm->close();
						
						$mes->addInfo($message);
						
						e107::getRender()->tablerender(DBLAN_10.SEP."Sync with Github", $mes->render());	
					}
					function githubSyncProcess()
					{
						if(file_exists(e_TEMP."e107-master.zip"))
						{
							unlink(e_TEMP."e107-master.zip");
						}

						$result = e107::getFile()->getRemoteFile('https://codeload.github.com/e107inc/e107/zip/master', 'e107-master.zip', 'temp');

						if($result == false)
						{
							e107::getMessage()->addError( "Couldn't download .zip file");
						}
						
						$localfile = 'e107-master.zip';
						
						chmod(e_TEMP.$localfile, 0755);
						require_once(e_HANDLER."pclzip.lib.php");
						
						$newFolders = array(
							'e107-master/e107_admin/'       => e_BASE.e107::getFolder('ADMIN'),
							'e107-master/e107_core/'        => e_BASE.e107::getFolder('CORE'),
							'e107-master/e107_docs/'        => e_BASE.e107::getFolder('DOCS'),
							'e107-master/e107_handlers/'    => e_BASE.e107::getFolder('HANDLERS'),
							'e107-master/e107_images/'      => e_BASE.e107::getFolder('IMAGES'),
							'e107-master/e107_languages/'   => e_BASE.e107::getFolder('LANGUAGES'),
							'e107-master/e107_media/'       => e_BASE.e107::getFolder('MEDIA'),
							'e107-master/e107_plugins/'     => e_BASE.e107::getFolder('PLUGINS'),
							'e107-master/e107_system/'      => e_BASE.e107::getFolder('SYSTEM'),
							'e107-master/e107_themes/'      => e_BASE.e107::getFolder('THEMES'),
							'e107-master/e107_web/'         => e_BASE.e107::getFolder('WEB'),
							'e107-master/'                  => e_BASE
						);
						
						
						$srch = array_keys($newFolders);
						$repl = array_values($newFolders);

						$archive 	= new PclZip(e_TEMP.$localfile);
						$unarc 		= ($fileList = $archive -> extract(PCLZIP_OPT_PATH, e_TEMP, PCLZIP_OPT_SET_CHMOD, 0755)); // Store in TEMP first.

						$error = array();
						$success = array();
						$skipped = array();

						$excludes = array('e107-master/','e107-master/install.php','e107-master/favicon.ico');
						
						foreach($unarc as $k=>$v)
						{
							if(in_array($v['stored_filename'],$excludes))
							{
								continue;
							}

							$oldPath = $v['filename'];
							$newPath =  str_replace($srch,$repl, $v['stored_filename']);

							$message = "Moving ".$oldPath." to ".$newPath;

							if($v['folder'] ==1 && is_dir($newPath))
							{
								continue;
							}

							if(!rename($oldPath,$newPath))
							{
								$error[] =  $message;
							}
							else
							{
								$success[] = $message;
							}
						}
						
						if(!empty($success))
						{
							e107::getMessage()->addSuccess(print_a($success,true));
						}

						if(!empty($skipped))
						{
							e107::getMessage()->setTitle("Skipped",E_MESSAGE_INFO)->addInfo(print_a($skipped,true));
						}

						if(!empty($error))
						{
							e107::getMessage()->addError(print_a($error,true));
						}
						
						e107::getRender()->tablerender(DBLAN_10.SEP."Sync with Github", e107::getMessage()->render());
					}
					
					
					
			//	}
		//	}
			
			//$text = 'Hello World!';
			$ns->tablerender('Hello',$text);	
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