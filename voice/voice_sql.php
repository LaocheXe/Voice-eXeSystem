<?php exit;?>
CREATE TABLE `voice_exesystem` (
  `voice_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `voice_name` varchar(128) NOT NULL,
  `voice_type` int(10) unsigned NOT NULL,
  `voice_ip` varchar(128) NOT NULL,
  `voice_port` int(12) unsigned NOT NULL,
  `voice_qport` int(12) unsigned DEFAULT NULL,
  `voice_enable_sc` int(12) unsigned NOT NULL,
  `voice_enable_msc` int(12) unsigned NOT NULL,
  `voice_msc` text,
  `voice_password` varchar(255) DEFAULT NULL,
  `voice_channel` varchar(255) DEFAULT NULL,
  `voice_channelpass` varchar(255) DEFAULT NULL,
  `voice_type_version` int(12) unsigned NOT NULL,
  PRIMARY KEY (`voice_id`)
) ENGINE=MyISAM;