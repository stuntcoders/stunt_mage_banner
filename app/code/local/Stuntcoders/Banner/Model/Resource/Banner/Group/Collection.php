<?php


class Stuntcoders_Banner_Model_Resource_Banner_Group_Collection extends Mage_Core_Model_Resource_Db_Collection_Abstract
{
    protected function _construct()
    {
        $this->_init('stuntcoders_banner/banner_group');
    }
}
