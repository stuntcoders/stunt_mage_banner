<?php


class Stuntcoders_Banner_Model_Resource_Banner_Collection extends Mage_Core_Model_Resource_Db_Collection_Abstract
{
    protected function _construct()
    {
        $this->_init('stuntcoders_banner/banner');
    }

    public function addBannerFilter($bannerId)
    {
        $this->getSelect()->where('main_table.id = ?', $bannerId);

        return $this;
    }

    public function addGroupFilter($groupId)
    {
        $this->getSelect()->where('main_table.group_id = ?', $groupId);

        return $this;
    }

    protected function _afterLoad()
    {
        $this->walk('afterLoad');

        return parent::_afterLoad();
    }
}
