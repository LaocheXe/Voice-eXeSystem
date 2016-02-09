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
	
	public $_options = array();
	
	
	public function syncPage()
    {
	 	$ns = e107::getRender();
		//$text .= 'Here is the link to sync the voice plugin - just a test';
		
		$this->_options['github'] = array('diz'=>"<span class='label label-warning'>Developer Mode Only</span> Overwrite local files with the latest from github.", 'label'=> 'Sync with Github' );	
		
		if(!empty($_POST['githubSyncProcess']))
		{
			$this->githubSyncProcess();
			return;
		}
		
		//if(varset($_GET['mode']) == 'github')
		//{
		//	$this->githubSync();
		//}
		
		//if(varset($_GET['modegit']) == 'github')
		//}
		//	$this->githubSync(.e_SELF."?modegit=".$key."');
		//}
		
		if(!vartrue($_GET['mode']) && !isset($_POST['db_execute']))
		{
			$this->render_options();
		}
		
		
		
		
				
		/* Need for Rendering*/
		$ns->tablerender('Sync',$text);	
    } 
	
	public function githubSync()
	{
		$frm = e107::getForm();
		$mes = e107::getMessage();
	//	$message = DBLAN_70;
	//	$message .= "<br /><a class='e-ajax btn btn-success' data-loading-text='".DBLAN_71."' href='#backupstatus' data-src='".e_SELF."?mode=backup' >".LAN_CREATE."</a>";
		$message = $frm->open('githubSync');
		$message .= "<p>This will download the latest .zip file from github to <b>".e_SYSTEM."/temp</b> and then unzip it, overwriting any existing files that it finds on your server. It will take into account any custom folders you may have set in e107_config.php. </p>";
		$message .= $frm->button('githubSyncProcess',1,'delete', "Overwrite Files");
		$message .= $frm->close();
		$mes->addInfo($message);
	//	$text = "<div id='backupstatus' style='margin-top:20px'></div>";
		e107::getRender()->tablerender(DBLAN_10.SEP."Sync with Github", $mes->render());
	}	
	
	public function githubSyncProcess()
	{
		// Delete any existing file.
		if(file_exists(e_TEMP."Voice-eXeSystem-master.zip"))
		{
			unlink(e_TEMP."Voice-eXeSystem-master.zip");
		}
		
		$result = e107::getFile()->getRemoteFile('https://codeload.github.com/LaocheXe/Voice-eXeSystem/zip/master', 'Voice-eXeSystem-master.zip', 'temp');		
/*
		$result = e107::getFile()->getRemoteFile('https://codeload.github.com/e107inc/e107/zip/master', 'e107-master.zip', 'temp');
*/
		if($result == false)
		{
			e107::getMessage()->addError( "Couldn't download .zip file");
		}


		$localfile = 'Voice-eXeSystem-master.zip';

		chmod(e_TEMP.$localfile, 0755);
		require_once("../../e107_handlers/pclzip.lib.php");

//	$base = realpath(dirname(__FILE__));

		$newFolders = array(
		'Voice-eXeSystem-master/'		=> e_BASE.e107::getFolder('PLUGINS'),
		);
		
		$srch = array_keys($newFolders);
		$repl = array_values($newFolders);

		$archive 	= new PclZip(e_TEMP.$localfile);
		$unarc 		= ($fileList = $archive -> extract(PCLZIP_OPT_PATH, e_TEMP, PCLZIP_OPT_SET_CHMOD, 0755)); // Store in TEMP first.

		$error = array();
		$success = array();
		$skipped = array();
//	print_a($unarc);

		$excludes = array('Voice-eXeSystem-master/','Voice-eXeSystem-master/LICENSE','Voice-eXeSystem-master/README.md');


		//$excludes = array('e107-master/','e107-master/install.php','e107-master/favicon.ico');

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
				// $skipped[] =  $newPath. " (already exists)";
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


			//	echo $message."<br />";

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

	public function render_options()
	{
		$frm = e107::getForm();	
		$mes = e107::getMessage(); 
		
		$text = "
		<form method='post' action='".e_SELF."' id='core-db-main-form'>
			<fieldset id='core-db-plugin-scan'>
			<legend class='e-hideme'>".DBLAN_10."</legend>
				<table class='table table-striped adminlist'>
				<colgroup>
					<col style='width: 60%' />
					<col style='width: 40%' />
				</colgroup>
				<tbody>";
				
		$text = "<div>";


		foreach($this->_options as $key=>$val)
		{
			
			$text .= "<div class='pull-left' style='width:50%;padding-bottom:10px'>
			<a class='btn btn-default btn-large pull-left' style='margin-right:10px' href='".e_SELF."?mode=".$key."' title=\"".$val['label']."\">".ADMIN_EXECUTE_ICON."</a>
			<h4 style='margin-bottom:3px'><a href='".e_SELF."?mode=".$key."' title=\"".$val['label']."\">".$val['label']."</a></h4><small>".$val['diz']."</small>
			</div>";
		
		}
		e107::getRender()->tablerender(DBLAN_10, $mes->render().$text);
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