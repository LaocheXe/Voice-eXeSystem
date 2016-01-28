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

class voice_adminSync extends e_admin_dispatcher
{
		public $_options = array();
		protected $modes = array(	
	
		'main'	=> array(
			'controller' 	=> 'voice_sync_exesystem_ui',
			'path' 			=> null,
			'ui' 			=> 'voice_sync_exesystem_form_ui',
			'uipath' 		=> null
		),
	);	
		protected $adminMenu = array(

		'main/sync'		=> array('caption'=> LAN_VOI_UPDATE, 'perm' => 'P'),
		'main/backone'			=> array('caption'=> LAN_MANAGE, 'perm' => 'P'),
		'main/backtwo'		=> array('caption'=> LAN_CREATE, 'perm' => 'P'),
		'main/backthree'			=> array('caption'=> LAN_VOI_INFO_NAME, 'perm' => 'P'),
		'main/backfour'		=> array('caption'=> LAN_VOI_EXAMPLE, 'perm' => 'P')
		// 'main/custom'		=> array('caption'=> 'Custom Page', 'perm' => 'P')
	);
	
		protected $adminMenuAliases = array(
		'main/edit'	=> 'main/sync'				
	);
	
	protected $menuTitle = 'Voice eXeSystem';
}

class voice_sync_exesystem_ui extends e_admin_ui
{
	
	public function syncPage()
    {
	 	$ns = e107::getRender();
		$text .= 'Here is the link to sync the voice plugin - just a test <br />';
		
		
		$this->_options['github'] = array('diz'=>"<span class='label label-warning'>Developer Mode Only</span> Overwrite local files with the latest from github.", 'label'=> 'Sync with Github' );
		if(!empty($_POST['githubSyncProcess']))
		{
			$this->githubSyncProcess();
			return;
		}
		if(varset($_GET['mode']) == 'github')
		{
			$this->githubSync();
		}
		
		
				
		/* Need for Rendering*/
		$ns->tablerender('Sync',$text);	
    } 
	
	
	/*  Back To Main Pages  */
	public function backonePage()
    {
     $mainadmin = e_SELF.'/../admin_config.php?mode=main&action=list';
  
     header("location:".$mainadmin); exit; 
    } 
		public function backtwoPage()
    {
     $mainadmin = e_SELF.'/../admin_config.php?mode=main&action=create';
  
     header("location:".$mainadmin); exit; 
    } 
		public function backthreePage()
    {
     $mainadmin = e_SELF.'/../admin_config.php?mode=main&action=info';
  
     header("location:".$mainadmin); exit; 
    } 
		public function backfourPage()
    {
     $mainadmin = e_SELF.'/../admin_config.php?mode=main&action=example';
  
     header("location:".$mainadmin); exit; 
    } 
}

class voice_sync_exesystem_form_ui extends e_admin_form_ui
{

}		
		
		
new voice_adminSync();

require_once(e_ADMIN."auth.php");
e107::getAdminUI()->runPage();

require_once(e_ADMIN."footer.php");
exit;

?>