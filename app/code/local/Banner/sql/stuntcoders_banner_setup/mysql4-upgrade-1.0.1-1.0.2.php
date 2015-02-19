<?php
$installer = $this;

$installer->startSetup();

$installer->run("
ALTER TABLE `{$this->getTable('stuntcoders_banner/banner')}` DROP `width`;
ALTER TABLE `{$this->getTable('stuntcoders_banner/banner')}` DROP `height`;
ALTER TABLE `{$this->getTable('stuntcoders_banner/banner')}` DROP `display`;
ALTER TABLE `{$this->getTable('stuntcoders_banner/banner')}` DROP `category`;
ALTER TABLE `{$this->getTable('stuntcoders_banner/banner')}` DROP `button_text`;
");

$installer->endSetup();
