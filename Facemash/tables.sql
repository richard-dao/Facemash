CREATE TABLE IF NOT EXISTS `battles` (
 `battle_id` bigint(20) unsigned NOT NULL auto_increment,
 `winner` bigint(20) unsigned NOT NULL,
 `loser` bigint(20) unsigned NOT NULL,
 PRIMARY KEY (`battle_id`),
 KEY `winner` (`winner`)
 ) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;
 
 
 CREATE TABLE IF NOT EXISTS `images` (
 `image_id` bigint(20) unsigned NOT NULL auto_increment,
 `filename` varchar(255) NOT NULL,
 `score` int(10) unsigned NOT NULL default '1500',
 `wins` int(10) unsigned NOT NULL default '0',
 `losses` int(10) unsigned NOT NULL default '0',
 `rank` int(10) unsigned NOT NULL default '0',
 PRIMARY KEY (`image_id`)
 ) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;