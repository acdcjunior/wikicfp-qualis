CREATE DATABASE u910267182_quali;

CREATE USER 'u910267182_user'@'%%' IDENTIFIED BY 'Y=w95aHm8j12pAsW:2';
GRANT ALL ON u910267182_quali.* TO 'u910267182_user'@'%%';

CREATE TABLE `u910267182_quali`.`qualis` (
  `id` int(10) NOT NULL auto_increment,
  `sigla` varchar(50) NULL,
  `sigla_efetiva` varchar(50) NOT NULL,
  `titulo` varchar(150) NOT NULL,
  `qualis` char(2) NOT NULL,
  `fonte` varchar(255) NOT NULL,
  `metadados` varchar(20000) not null default '{}',
  PRIMARY KEY  (`id`)
);