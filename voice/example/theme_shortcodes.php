<?php
////********** Bootstrap v3 Theme Shortcodes Example **********////
class theme_shortcodes extends e_shortcode
{
	function __construct()
	{
	}
	
	function sc_bootstrap_usernav()
	{
		include_lan(e_PLUGIN."login_menu/languages/".e_LANGUAGE.".php");
		$tp = e107::getParser();		   
		require_once(e_PLUGIN."login_menu/login_menu_shortcodes.php");			   
		if(!USERID) 
		{
			$text = '
			<ul class="nav navbar-nav navbar-right">';
			
			if(deftrue('USER_REGISTRATION'))
			{
				$text .= '
				<li><a href="'.e_SIGNUP.'">Sign Up</a></li>
				';
			}
			
			$text .= '
			<li class="divider-vertical"></li>
			<li class="dropdown">
				<a class="dropdown-toggle" href="#" data-toggle="dropdown">Sign In <strong class="caret"></strong></a>
				<div class="dropdown-menu col-sm-12" style="min-width:250px; padding: 15px; padding-bottom: 0px;">
				<form method="post" onsubmit="hashLoginPassword(this);return true" action="'.e_REQUEST_HTTP.'" accept-charset="UTF-8">
				{LM_USERNAME_INPUT}
				{LM_PASSWORD_INPUT}
				{LM_IMAGECODE_NUMBER}
				{LM_IMAGECODE_BOX}
				
				<div class="checkbox">
				<input style="float: left; margin-right: 10px;" type="checkbox" name="autologin" id="autologin" value="1">
				<label class="string optional" for="autologin"> Remember me</label>
				</div>
				<input class="btn btn-primary btn-block" type="submit" name="userlogin" id="userlogin" value="Sign In">
			';
			
			$text .= '
			
			<a href="{LM_FPW_LINK=href}" class="btn btn-default btn-sm  btn-block">'.LOGIN_MENU_L4.'</a>
			<a href="{LM_RESEND_LINK=href}" class="btn btn-default btn-sm  btn-block">'.LOGIN_MENU_L40.'</a>
			
			';
			
			
			$text .= "<p></p>
			</form>
			</div>
			</li>";
////*********** Voice Plugin Code ***********////
			if(e107::isInstalled('voice'))
			{
				include_lan(e_PLUGIN."voice/languages/".e_LANGUAGE.".php");
				$text .='{VOICE_EXE_LEGACY}';
			}
			else
			{
				$text .="</ul>";
			}
////*********** Set To True To Display Text ***********////
			return $tp->parseTemplate($text, true, $login_menu_shortcodes);
		} 

		$text = '
		<ul class="nav navbar-nav navbar-right">
		<li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown">{SETIMAGE: w=20}{USER_AVATAR} '. USERNAME.' <b class="caret"></b></a>
		<ul class="dropdown-menu">
		<li>
			<a href="{LM_USERSETTINGS_HREF}"><span class="glyphicon glyphicon-cog"></span> Settings</a>
		</li>
		<li>
			<a class="dropdown-toggle no-block" role="button" href="{LM_PROFILE_HREF}"><span class="glyphicon glyphicon-user"></span> Profile</a>
		</li>
		<li class="divider"></li>';
		
		if(ADMIN) 
		{
			$text .= '<li><a href="'.e_ADMIN_ABS.'"><span class="fa fa-cogs"></span> Admin Area</a></li>
			<li class="divider"></li>';	
		}
		
		$text .= '
		<li><a href="'.e_HTTP.'index.php?logout"><span class="glyphicon glyphicon-off"></span> Logout</a></li>
		</ul>
		</li>
		';
////*********** Voice Plugin Code ***********////		
			if(e107::isInstalled('voice'))
			{
				include_lan(e_PLUGIN."voice/languages/".e_LANGUAGE.".php");
				$text .='{VOICE_EXE_LEGACY}';
			}
			else
			{
				$text .="</ul>";
			}

		return $tp->parseTemplate($text,true,$login_menu_shortcodes);
	}
}

?>