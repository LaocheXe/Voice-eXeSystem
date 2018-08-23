<?php

/**
 * @file
 * Addon file to display help block on Admin UI.
 */

if(!defined('e107_INIT'))
{
	exit;
}

// [PLUGINS]/voice/languages/[LANGUAGE]/[LANGUAGE]_admin.php
e107::lan('voice', true, true);
// Added Language URL - eXe
//include_lan(e_PLUGIN.'voice/languages/'.e_LANGUAGE.'_admin.php');


/**
 * Class voice_help.
 */
class voice_help
{

	private $action;

	public function __construct()
	{
		$this->action = varset($_GET['action'], '');
		$this->renderHelpBlock();
	}

	public function renderHelpBlock()
	{
		switch($this->action)
		{
			default:
				$block = $this->getHelpBlockListPage();
				break;
		}

		if(!empty($block))
		{
			e107::getRender()->tablerender($block['title'], $block['body']);
		}
	}

	public function getHelpBlockListPage()
	{
		e107::js('footer', 'https://buttons.github.io/buttons.js');

		$content = '';

		$issue = array(
			'href="https://github.com/LaocheXe/Voice-eXeSystem/issues" arget="_blank"',
			'class="github-button"',
			'data-icon="octicon-issue-opened"',
			'data-style="mega"',
			'data-count-api="/repos/LaocheXe/Voice-eXeSystem#open_issues_count"',
			'data-count-aria-label="# issues on GitHub"',
			'aria-label="Issue LaocheXe/Voice-eXeSystem on GitHub"',
		);

		$star = array(
			'href="https://github.com/LaocheXe/Voice-eXeSystem" arget="_blank"',
			'class="github-button"',
			'data-icon="octicon-star"',
			'data-style="mega"',
			'data-count-href="/LaocheXe/Voice-eXeSystem/stargazers"',
			'data-count-api="/repos/LaocheXe/Voice-eXeSystem#stargazers_count"',
			'data-count-aria-label="# stargazers on GitHub"',
			'aria-label="Star LaocheXe/Voice-eXeSystem on GitHub"',
		);

		$content .= '<p class="text-center">' . LAN_VOICEXE_ADMIN_HELP_03 . '</p>';
		$content .= '<p class="text-center">';
		$content .= '<a ' . implode(" ", $issue) . '>' . LAN_VOICEXE_ADMIN_HELP_04 . '</a>';
		$content .= '</p>';

		$content .= '<p class="text-center">' . LAN_VOICEXE_ADMIN_HELP_02 . '</p>';
		$content .= '<p class="text-center">';
		$content .= '<a ' . implode(" ", $star) . '>' . LAN_VOICEXE_ADMIN_HELP_05 . '</a>';
		$content .= '</p>';

		$beerImage = '<img src="https://beerpay.io/LaocheXe/Voice-eXeSystem/badge.svg" />';
		$beerWishImage = '<img src="https://beerpay.io/LaocheXe/Voice-eXeSystem/make-wish.svg" />';

		$content .= '<p class="text-center">' . LAN_VOICEXE_ADMIN_HELP_06 . '</p>';
		$content .= '<p class="text-center">';
		$content .= '<a href="https://beerpay.io/LaocheXe/Voice-eXeSystem" arget="_blank">' . $beerImage . '</a>';
		$content .= '</p>';
		$content .= '<p class="text-center">';
		$content .= '<a href="https://beerpay.io/LaocheXe/Voice-eXeSystem" arget="_blank">' . $beerWishImage . '</a>';
		$content .= '</p>';
		
		$paypalImage = '<img src="http://www.templechurch.org/FILES/BUTTONS/paypal-donate-button.png" alt="Paypal Donate" height="75" width="100" />';
		
		$content .= '<p class="text-center"> ' . LAN_VOICEXE_ADMIN_HELP_07 . '</p>';
		$content .=	'<p class="text-center">';
		$content .= '<a href="https://www.paypal.me/laochexe" target="_blank">' . $paypalImage . '</a>';
		$content .= '</p>';

		$block = array(
			'title' => LAN_VOICEXE_ADMIN_HELP_01,
			'body'  => $content,
		);

		return $block;
	}

}


new voice_help();
