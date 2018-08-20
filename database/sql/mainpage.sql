CREATE TABLE IF NOT EXISTS `/* TABLE_PREFIX */mainpage` (
  `id` int(11) NOT NULL auto_increment,
  `body` text NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

INSERT INTO `/* TABLE_PREFIX */mainpage` (`id`, `body`) VALUES (1, '<p>Главная страница.</p>');
