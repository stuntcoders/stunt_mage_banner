<?php

$installer = $this;

$installer->startSetup();

$installer->run("
ALTER TABLE `{$this->getTable('stuntcoders_banner/banner')}` ADD `sort_order` smallint(6) DEFAULT 0;
");

$installer->endSetup();
