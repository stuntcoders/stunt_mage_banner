<?php
/** @var Mage_Core_Model_Resource_Setup $this */

$this->startSetup();

$table = $this->getConnection()
    ->newTable($this->getTable('stuntcoders_banner/banner'))
    ->addColumn('id', Varien_Db_Ddl_Table::TYPE_INTEGER, null, array(
        'identity'  => true,
        'unsigned'  => true,
        'nullable'  => false,
        'primary'   => true,
    ))->addColumn('group_id', Varien_Db_Ddl_Table::TYPE_INTEGER, null)
    ->addColumn('code', Varien_Db_Ddl_Table::TYPE_TEXT, 255, array())
    ->addColumn('url', Varien_Db_Ddl_Table::TYPE_TEXT, null, array())
    ->addColumn('title', Varien_Db_Ddl_Table::TYPE_TEXT, null, array())
    ->addColumn('content', Varien_Db_Ddl_Table::TYPE_TEXT, null, array())
    ->addColumn('sort_order', Varien_Db_Ddl_Table::TYPE_INTEGER, null)
    ->addColumn('open_in_new_tab', Varien_Db_Ddl_Table::TYPE_BOOLEAN, null)
    ->addColumn('image', Varien_Db_Ddl_Table::TYPE_TEXT, null, array());

$table->addIndex(
    $this->getIdxName('stuntcoders_banner/banner', array('code'), Varien_Db_Adapter_Interface::INDEX_TYPE_UNIQUE),
    array('code'),
    Varien_Db_Adapter_Interface::INDEX_TYPE_UNIQUE
);

$table->addForeignKey(
    $this->getFkName('stuntcoders_banner/banner', 'group_id', 'stuntcoders_banner/banner_group', 'id'),
    'group_id',
    'stuntcoders_banner/banner_group',
    'id',
    Varien_Db_Ddl_Table::ACTION_SET_NULL,
    Varien_Db_Ddl_Table::ACTION_CASCADE
);

$this->getConnection()->createTable($table);

$table = $this->getConnection()
    ->newTable($this->getTable('stuntcoders_banner/banner_group'))
    ->addColumn('id', Varien_Db_Ddl_Table::TYPE_INTEGER, null, array(
        'identity'  => true,
        'unsigned'  => true,
        'nullable'  => false,
        'primary'   => true,
    ))->addColumn('group_id', Varien_Db_Ddl_Table::TYPE_INTEGER, null)
    ->addColumn('code', Varien_Db_Ddl_Table::TYPE_TEXT, 255, array())
    ->addColumn('name', Varien_Db_Ddl_Table::TYPE_TEXT, null, array());

$table->addIndex(
    $this->getIdxName('stuntcoders_banner/banner_group', array('code'), Varien_Db_Adapter_Interface::INDEX_TYPE_UNIQUE),
    array('code'),
    Varien_Db_Adapter_Interface::INDEX_TYPE_UNIQUE
);

$this->getConnection()->createTable($table);

$this->endSetup();
