<?php exit;?>
CREATE TABLE IF NOT EXISTS `voice_exesystem` (
  `voice_id` int(10) NOT NULL AUTO_INCREMENT,
  `voice_name` varchar(128) NOT NULL,
  `voice_type` int(10) unsigned NOT NULL,
  `voice_ip` varchar(128) NOT NULL,
  `voice_port` int(12) unsigned NOT NULL,
  `voice_qport` int(12) unsigned DEFAULT NULL,
  `voice_qname` varchar(255) DEFAULT NULL,
  `voice_qpass` varchar(255) DEFAULT NULL,
  `voice_enable_sc` int(12) unsigned NOT NULL,
  `voice_enable_msc` int(12) unsigned NOT NULL,
  `voice_msc` text,
  `voice_password` varchar(255) DEFAULT NULL,
  `voice_channel` varchar(255) DEFAULT NULL,
  `voice_channelpass` varchar(255) DEFAULT NULL,
  `voice_type_version` int(12) unsigned NOT NULL,
  `voice_listname` int(10) unsigned NOT NULL,
  `voice_discord_id` varchar(128) DEFAULT NULL,
  `voice_discord_invitecode` varchar(255) DEFAULT NULL,
  `voice_discord_japi` varchar(200) DEFAULT NULL,
  `voice_discord_theme` varchar(15) DEFAULT NULL,
  `voice_discord_width` int(12) unsigned NOT NULL,
  `voice_discord_height` int(12) unsigned NOT NULL,
  `voice_discord_transp` int(10) unsigned NOT NULL,
  `voice_discord_iframe` int(10) unsigned NOT NULL,
  `voice_discord_frameborder` int(12) unsigned NOT NULL,
  `voice_viewer` int(12) unsigned NOT NULL,
  `voice_viewer_cc` text,
  PRIMARY KEY (`voice_id`)
) ENGINE=MyISAM;