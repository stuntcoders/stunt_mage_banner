<?php

$installer = $this;

$installer->startSetup();

$installer->getConnection()->modifyColumn($installer->getTable('stuntcoders_banner/banner'), 'text', array(
    'nullable' => false,
    'type' => Varien_Db_Ddl_Table::TYPE_TEXT,
    'default' => '',
    'comment' => 'Banner Content',
))->modifyColumn($installer->getTable('stuntcoders_banner/banner'), 'heading', array(
    'nullable' => false,
    'type' => Varien_Db_Ddl_Table::TYPE_TEXT,
    'default' => '',
    'comment' => 'Banner Content',
));

$installer->endSetup();
