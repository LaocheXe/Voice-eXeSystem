<?php
//********** Voice eXeSystem Plugin **********
			if(e107::isInstalled('voice'))
			{
				include_lan(e_PLUGIN.'voice/languages/'.e_LANGUAGE.'.php');
				$text .= '
				<ul class="nav navbar-nav navbar-right">
				<li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown">'.LAN_VOIPLUG_NAME.' <b class="caret"></b></a>
				<ul class="dropdown-menu">
				<li>
				{VOICE_EXE}
				';
				$text .= "<p></p>
				</li>
				</ul>";
			}
			else
			{
				$text .="
				</ul>
				";	
			}