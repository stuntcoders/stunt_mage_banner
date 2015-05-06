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
            return "";
        }
        return Mage::getBaseUrl('media') . $imagePath;
    }

    public function getBannersByGroupCode($code)
    {
        $bannerGroupModel = Mage::getModel('stuntcoders_banner/banner_group');
        $groupId = $bannerGroupModel->getIdByCode($code);

        return $bannerGroupModel->load($groupId)->getBanners();
    }
}
