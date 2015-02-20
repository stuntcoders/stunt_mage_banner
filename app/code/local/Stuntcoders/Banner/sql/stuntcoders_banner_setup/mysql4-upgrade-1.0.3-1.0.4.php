<?php
$installer = $this;

$installer->startSetup();

$installer->run("
ALTER TABLE `{$this->getTable('stuntcoders_banner/banner')}` ADD `code` VARCHAR(255) AFTER `banner_id`;
ALTER TABLE `{$this->getTable('stuntcoders_banner/banner')}` ADD CONSTRAINT STUNTCODERS_BANNER_UNIQ_CODE UNIQUE (`code`);
");

$installer->endSetup();
