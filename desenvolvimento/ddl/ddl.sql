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
  `metadados` blob,
  PRIMARY KEY  (`id`)
);

-- A coluna metadados serah uma dynamic column
-- https://mariadb.com/kb/en/mariadb/dynamic-columns/

-- UPDATE `qualis` SET `metadados` = COLUMN_ADD(`metadados`,
--                                                           'ISSN', `issn`,
--                                                           'Área de Avaliação', `area_avaliacao`,
--                                                           'Tipo', `tipo`,
--                                                           'H5-GM', '',
--                                                           'Local Google Scholar Metrics', '',
--                                                           'URL DBLP', '',
--                                                           'URL CONFERÊNCIA', ''
--                                   );
--
--
--
-- SELECT `item_name`, cast(COLUMN_JSON(`dynamic_cols`) AS CHAR(10000) CHARACTER SET utf8), `bob` FROM `assets` WHERE 1