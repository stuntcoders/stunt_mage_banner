<?php


class Stuntcoders_Banner_Model_Mysql4_Banner_Collection extends Mage_Core_Model_Mysql4_Collection_Abstract
{
    protected function _construct()
    {
        $this->_init('stuntcoders_banner/banner');
    }

    public function addBannerFilter($banner)
    {
        $this->getSelect()->where('main_table.banner_id in (?)', $banner);
        return $this;
    }

    public function addCategoryFilter($category)
    {
        $this->getSelect()->where('main_table.category in (?)', $category);
        return $this;
    }
}
