<?php

$installer = $this;

$installer->startSetup();

$installer->run("
DROP TABLE IF EXISTS `{$this->getTable('stuntcoders_banner/banner')}`;

CREATE TABLE `{$this->getTable('stuntcoders_banner/banner')}` (
    `banner_id` smallint(6) NOT NULL AUTO_INCREMENT,
    `width` smallint(6) NOT NULL,
    `height` smallint(6) NOT NULL,
    `display` smallint(6) DEFAULT 0,
    `url` varchar(255) DEFAULT '',
    `image` varchar(255) DEFAULT '',
    `category` smallint(6) DEFAULT 0,
    PRIMARY KEY (`banner_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='Banner instance' ;
");

$installer->endSetup();
