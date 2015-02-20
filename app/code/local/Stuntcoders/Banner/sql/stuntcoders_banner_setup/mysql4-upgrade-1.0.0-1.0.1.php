<?php
$installer = $this;

$installer->startSetup();

$installer->run("
ALTER TABLE `{$this->getTable('stuntcoders_banner/banner')}` ADD `heading` VARCHAR(255) AFTER `category`;
ALTER TABLE `{$this->getTable('stuntcoders_banner/banner')}` ADD `button_text` VARCHAR(255) AFTER `heading`;
");

$installer->endSetup();
