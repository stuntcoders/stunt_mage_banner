<?php

class Stuntcoders_Banner_Model_Resource_Banner_Group extends Mage_Core_Model_Resource_Db_Abstract
{
    protected function _construct()
    {
        $this->_init('stuntcoders_banner/banner_group', 'id');
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
}
