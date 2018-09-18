<?php
//********** Voice eXeSystem Plugin **********
			if(e107::isInstalled('voice'))
			{
				include_lan(e_PLUGIN."voice/languages/".e_LANGUAGE.".php");
				$text .='{VOICE_EXE_LEGACY}';
			}
			else
			{
				$text .="</ul>";
			}