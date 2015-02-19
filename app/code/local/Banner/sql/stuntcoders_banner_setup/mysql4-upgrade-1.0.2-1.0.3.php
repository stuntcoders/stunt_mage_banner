<?php
$installer = $this;

$installer->startSetup();

$installer->run("
ALTER TABLE `{$this->getTable('stuntcoders_banner/banner')}` ADD `text` VARCHAR(255) AFTER `url`;
");

$installer->endSetup();
