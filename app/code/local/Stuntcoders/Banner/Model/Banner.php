<?php

class Stuntcoders_Banner_Model_Banner extends Mage_Core_Model_Abstract
{
    protected function _construct()
    {
        $this->_init('stuntcoders_banner/banner');
    }

    public function getImage()
    {
        $imagePath = $this->getData('image');
        if (empty($imagePath)) {
            return '';
        }

        return Mage::getBaseUrl('media') . $imagePath;
    }

    public function getOpenInNewTab()
    {
        return (bool) $this->getData('open_in_new_tab');
    }

    public function getBannersByGroupCode($code)
    {
        $bannerGroupModel = Mage::getModel('stuntcoders_banner/banner_group');
        $groupId = $bannerGroupModel->getIdByCode($code);
        $banners = $bannerGroupModel->load($groupId)->getBanners();
        $bannerCollection = new Varien_Data_Collection();

        foreach ($banners as $banner) {
            $bannerCollection->addItem(Mage::getModel('stuntcoders_banner/banner')->load($banner['banner_id']));
        }

        return $bannerCollection;
    }
}
