<?php

$installer = $this;

$installer->startSetup();

$installer->run("
DROP TABLE IF EXISTS `{$this->getTable('stuntcoders_banner/banner_group')}`;

CREATE TABLE `{$this->getTable('stuntcoders_banner/banner_group')}` (
    `group_id` smallint(6) NOT NULL AUTO_INCREMENT,
    `code` varchar(255) NOT NULL,
    `name` varchar(255) DEFAULT '',
    PRIMARY KEY (`group_id`),
    UNIQUE KEY `STUNTCODERS_BANNER_GROUP_UNIQUE_CODE` (`code`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='Banner group instance' ;

ALTER TABLE `{$this->getTable('stuntcoders_banner/banner')}` ADD `group_id` smallint(6) AFTER `banner_id`;
");

$installer->endSetup();
