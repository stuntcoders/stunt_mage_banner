<?php

$installer = $this;

$installer->startSetup();

$installer->run("
DROP TABLE IF EXISTS `{$this->getTable('stuntcoders_banner/banner')}`;
DROP TABLE IF EXISTS `{$this->getTable('stuntcoders_banner/banner_group')}`;

CREATE TABLE `{$this->getTable('stuntcoders_banner/banner')}` (
    `banner_id` SMALLINT(6) NOT NULL AUTO_INCREMENT,
    `group_id` SMALLINT(6),
    `code` VARCHAR(255) DEFAULT '',
    `url` VARCHAR(255) DEFAULT '',
    `text` VARCHAR(255) DEFAULT '',
    `image` VARCHAR(255) DEFAULT '',
    `heading` VARCHAR(255) DEFAULT '',
    PRIMARY KEY (`banner_id`),
    UNIQUE KEY STUNTCODERS_BANNER_UNIQUE_CODE (`code`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='Banner instance' ;

CREATE TABLE `{$this->getTable('stuntcoders_banner/banner_group')}` (
    `group_id` smallint(6) NOT NULL AUTO_INCREMENT,
    `code` varchar(255) NOT NULL,
    `name` varchar(255) DEFAULT '',
    PRIMARY KEY (`group_id`),
    UNIQUE KEY `STUNTCODERS_BANNER_GROUP_UNIQUE_CODE` (`code`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='Banner group instance' ;

");

$installer->endSetup();
