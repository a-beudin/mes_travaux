CREATE TABLE `tp_bookmarks` (
  `id`          varchar(32)  NOT NULL default '',
  `nomSite`     varchar(255) NOT NULL default '',
  `url`         varchar(255) NOT NULL default '',
  `description` text         NOT NULL,
  `dateIns`     datetime     NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (`id`)
) TYPE=MyISAM;
