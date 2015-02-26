<?php

class Stuntcoders_Banner_Model_Mysql4_Banner_Group extends Mage_Core_Model_Mysql4_Abstract
{
    protected function _construct()
    {
        $this->_init('stuntcoders_banner/banner_group', 'group_id');
    }

    public function getIdByCode($code)
    {
        $adapter = $this->_getReadAdapter();

        $select = $adapter->select()
            ->from($this->getTable('stuntcoders_banner/banner_group'))
            ->where('code = :code');

        $bind = array(':code' => (string) $code);

        return $adapter->fetchOne($select, $bind);
    }

    public function loadBanners($id)
    {
        $select = $this->_getReadAdapter()->select()
            ->from($this->getTable('stuntcoders_banner/banner'))
            ->where('group_id = ?', $id)
            ->order('sort_order');

        return $this->_getReadAdapter()->fetchAll($select);
    }
}
