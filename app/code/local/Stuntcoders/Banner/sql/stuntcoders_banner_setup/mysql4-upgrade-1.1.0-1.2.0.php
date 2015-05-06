<?php
$installer = $this;

$installer->startSetup();

$installer->run(
    "ALTER TABLE `{$this->getTable('stuntcoders_banner/banner')}`
    ADD `open_in_new_tab` smallint(6) NOT NULL DEFAULT 0 AFTER `heading`;"
);

$installer->endSetup();
