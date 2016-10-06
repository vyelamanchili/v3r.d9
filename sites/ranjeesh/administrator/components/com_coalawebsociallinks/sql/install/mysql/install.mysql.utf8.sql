CREATE TABLE IF NOT EXISTS `#__cwsocial_metafields` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT 'Primary Key',
  `article_id` int(11) unsigned NULL COMMENT 'FK to the #__content table.',
  `cat_id` int(11) unsigned NULL COMMENT 'FK to the #__categories table.',
  `menu_id` int(11) unsigned NULL COMMENT 'FK to the #__menu table.',
  `attribs` longtext NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


CREATE TABLE IF NOT EXISTS `#__cwsocial_count` (
  `id` int(11) NOT NULL auto_increment,
  `tm` datetime NOT NULL,
  `title` varchar(250) NOT NULL,
  `alias` varchar(250) NOT NULL,
  `url` varchar(250) NOT NULL,
  `facebook_share` int(11) NOT NULL,
  `facebook_like` int(11) NOT NULL,
  `facebook_comment` int(11) NOT NULL,
  `facebook_total` int(11) NOT NULL,
  `google` int(11) NOT NULL,
  `linkedin` int(11) NOT NULL,
  `stumbleupon` int(11) NOT NULL,
  `pinterest` int(11) NOT NULL,
  `reddit` int(11) NOT NULL,
  `state` tinyint(3) NOT NULL DEFAULT '0',
  `checked_out` int(10) unsigned NOT NULL DEFAULT '0',
  `checked_out_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `created` datetime NOT NULL,
  `created_by` int(10) NOT NULL,
  `created_by_alias` varchar(255) NOT NULL,
  `modified` datetime NOT NULL,
  `modified_by` int(10) NOT NULL,
  `publish_up` datetime NOT NULL,
  `publish_down` datetime NOT NULL,
   PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
