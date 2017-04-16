CREATE DATABASE u910267182_quali;

CREATE USER 'u910267182_user'@'%%' IDENTIFIED BY 'Y=w95aHm8j12pAsW:2';
GRANT ALL ON u910267182_quali.* TO 'u910267182_user'@'%%';

CREATE TABLE `u910267182_quali`.`qualis` (
  `id`            INT(10)        NOT NULL              AUTO_INCREMENT,
  `sigla`         VARCHAR(50)    NULL                  CHARACTER SET UTF8_GENERAL_CI,
  `sigla_efetiva` VARCHAR(50)    NOT NULL              CHARACTER SET UTF8_GENERAL_CI,
  `titulo`        VARCHAR(150)   NOT NULL              CHARACTER SET UTF8_GENERAL_CI,
  `qualis`        CHAR(2)        NOT NULL              CHARACTER SET UTF8_GENERAL_CI,
  `fonte`         VARCHAR(255)   NOT NULL              CHARACTER SET UTF8_GENERAL_CI,
  `metadados`     VARCHAR(20000) NOT NULL DEFAULT '{}' CHARACTER SET UTF8_GENERAL_CI,
  PRIMARY KEY  (`id`)
);

ALTER TABLE `qualis` ADD INDEX(`sigla`);
ALTER TABLE `qualis` ADD INDEX(`sigla_efetiva`);