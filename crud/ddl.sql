CREATE TABLE `qualis` (
  `id` int(10) NOT NULL auto_increment,
  `titulo` varchar(150) NOT NULL,
  `sigla` varchar(50) NULL,
  `sigla_efetiva` varchar(50) NOT NULL,
  `qualis` char(2) NOT NULL,
  `issn` varchar(50) NULL,
  `area_avaliacao` varchar(50) NULL,
  `fonte` varchar(255) NOT NULL,
  PRIMARY KEY  (`id`)
) 