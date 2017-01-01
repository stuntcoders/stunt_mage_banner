<?php
/** @var Mage_Core_Model_Resource_Setup $this */

$this->startSetup();

$this->getConnection()->dropIndex(
    $this->getTable('stuntcoders_banner'),
    $this->getIdxName('stuntcoders_banner/banner', array('code'), Varien_Db_Adapter_Interface::INDEX_TYPE_UNIQUE)
);

$table = $this->getConnection()
    ->newTable($this->getTable('stuntcoders_banner/store'))
    ->addColumn('banner_id', Varien_Db_Ddl_Table::TYPE_INTEGER, null, array(
        'nullable' => false,
        'primary' => true,
    ), 'Banner Id')
    ->addColumn('store_id', Varien_Db_Ddl_Table::TYPE_INTEGER, null, array(
        'unsigned' => true,
        'nullable' => false,
        'primary' => true,
    ), 'Store Id')
    ->addIndex($this->getIdxName('stuntcoders_banner/store', array('store_id')), array('store_id'));

$this->getConnection()->createTable($table);

$this->getConnection()->addForeignKey(
    $this->getFkName('stuntcoders_banner/store', 'banner_id', 'stuntcoders_banner', 'id'),
    $this->getTable('stuntcoders_banner/store'),
    'banner_id',
    $this->getTable('stuntcoders_banner'),
    'id'
);

$this->getConnection()->addForeignKey(
    $this->getFkName('stuntcoders_banner/store', 'store_id', 'core/store', 'store_id'),
    $this->getTable('stuntcoders_banner/store'),
    'store_id',
    $this->getTable('core/store'),
    'store_id'
);

$this->endSetup();
