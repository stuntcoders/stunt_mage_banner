<?php

class Stuntcoders_Banner_Block_Banner_Group extends Mage_Core_Block_Template
{
    public function __construct()
    {
        $this->setTemplate('stuntcoders/banner/group.phtml');
    }

    public function getBanners()
    {
        if (!$this->hasLoadedBanners()) {
            $this->_loadBanners();
        }

        return $this->getLoadedBanners();
    }

    protected function _loadBanners()
    {
        $this->setLoadedBanners(array());
        if ($this->getId()) {
            $this->setLoadedBanners(
                Mage::getModel('stuntcoders_banner/banner_group')->load($this->getId())->getBanners()
            );
        } else if ($this->getCode()) {
            $this->setLoadedBanners(
                Mage::getModel('stuntcoders_banner/banner')->getBannersByGroupCode($this->getCode())
            );
        }

        return $this;
    }
}
